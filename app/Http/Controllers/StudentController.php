<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return inertia('student/Index', [
            'groups' => StudentGroup::orderBy('name', 'asc')->get(),
        ]);
    }

    public function detail($id = 0)
    {
        $data = Student::with('group')->findOrFail($id);
        return inertia('student/Detail', [
            'data' => $data,
        ]);
    }

    public function data(Request $request)
    {
        $orderBy = $request->get('order_by', 'name');
        $orderType = $request->get('order_type', 'asc');
        $filter = $request->get('filter', []);

        $q = Student::with('group');
        $q->orderBy($orderBy, $orderType);

        if (!empty($filter['gender']) && $filter['gender'] != null) {
            $q->where('gender', '=', $filter['gender']);
        }

        if (!empty($filter['group_id']) && $filter['group_id'] != null) {
            $q->where('group_id', '=', $filter['group_id']);
        }

        if (!empty($filter['status']) && ($filter['status'] == 'active' || $filter['status'] == 'inactive')) {
            $q->where('active', '=', $filter['status'] == 'active' ? true : false);
        }

        if (!empty($filter['search'])) {
            $q->where(function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['search'] . '%');
            });
        }

        $students = $q->paginate($request->get('per_page', 10))->withQueryString();

        return response()->json($students);
    }

    public function duplicate($id)
    {
        $student = Student::findOrFail($id);
        $student->id = null;
        return $this->_editor($student);
    }

    public function editor($id = 0)
    {
        return $this->_editor($id ? Student::findOrFail($id) : new Student());
    }

    protected function _editor($student)
    {
        if (!$student->id) {
            $student->active = true;
            $student->created_at = null;
        }

        return inertia('student/Editor', [
            'data' => $student,
            'groups' => StudentGroup::orderBy('name', 'asc')->get(),
        ]);
    }

    public function save(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'phone' => 'required',
            'address' => 'required',
        ];
        $student = null;
        $message = '';
        $fields = ['name', 'gender', 'birth_date', 'phone', 'address', 'active', 'group_id'];
        if (!$request->id) {
            $request->validate($rules);
            $student = new Student();
            $message = 'Siswa baru telah dibuat.';
        } else {
            $request->validate($rules);
            $student = Student::findOrFail($request->id);
            $message = "Siswa {$student->name} telah diperbarui.";
        }

        $student->fill($request->only($fields));
        $student->save();

        return redirect(route('student.index'))->with('success', $message);
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'message' => "Siswa {$student->name} telah dihapus!"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;


class StudentGroupController extends Controller
{
    public function index()
    {
        return inertia('student-group/Index');
    }

    public function detail($id = 0)
    {
        return inertia('student-group/Detail', [
            'data' => StudentGroup::findOrFail($id),
        ]);
    }

    public function data(Request $request)
    {
        $orderBy = $request->get('order_by', 'name');
        $orderType = $request->get('order_type', 'asc');
        $filter = $request->get('filter', []);

        $q = StudentGroup::query();
        $q->orderBy($orderBy, $orderType);

        // if (!empty($filter['gender']) && $filter['gender'] != null) {
        //     $q->where('gender', '=', $filter['gender']);
        // }

        // if (!empty($filter['status']) && ($filter['status'] == 'active' || $filter['status'] == 'inactive')) {
        //     $q->where('active', '=', $filter['status'] == 'active' ? true : false);
        // }

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
        $group = StudentGroup::findOrFail($id);
        $group->id = null;
        return $this->_editor($group);
    }

    public function editor($id = 0)
    {
        return $this->_editor($id ? StudentGroup::findOrFail($id) : new StudentGroup());
    }

    protected function _editor($group)
    {
        if (!$group->id) {
            $group->active = true;
            $group->created_at = null;
        }

        return inertia('student-group/Editor', [
            'data' => $group,
        ]);
    }

    public function save(Request $request)
    {
        $rules = [];
        $group = null;
        $message = '';
        $fields = ['name', 'notes'];
        if (!$request->id) {
            $rules['name'] = "required|max:100|unique:student_groups,name,null,id";
            $request->validate($rules);
            $group = new StudentGroup();
            $message = 'Grup Siswa baru telah dibuat.';
        } else {
            $rules['name'] = "required|max:100|unique:student_groups,name,{$request->id},id";
            $request->validate($rules);
            $group = StudentGroup::findOrFail($request->id);
            $message = "Grup Siswa {$group->name} telah diperbarui.";
        }

        $group->fill($request->only($fields));
        $group->save();

        return redirect(route('student-group.index'))->with('success', $message);
    }

    public function delete($id)
    {
        $group = StudentGroup::findOrFail($id);
        $group->delete();

        return response()->json([
            'message' => "Grup Siswa {$group->name} telah dihapus!"
        ]);
    }
}

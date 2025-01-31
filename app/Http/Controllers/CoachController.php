<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coach;
use Illuminate\Http\Request;


class CoachController extends Controller
{
    public function index()
    {
        return inertia('coach/Index');
    }

    public function detail($id = 0)
    {
        return inertia('coach/Detail', [
            'data' => Coach::findOrFail($id),
        ]);
    }

    public function data(Request $request)
    {
        $orderBy = $request->get('order_by', 'name');
        $orderType = $request->get('order_type', 'asc');
        $filter = $request->get('filter', []);

        $q = Coach::query();
        $q->orderBy($orderBy, $orderType);

        if (!empty($filter['gender']) && $filter['gender'] != null) {
            $q->where('gender', '=', $filter['gender']);
        }

        if (!empty($filter['status']) && ($filter['status'] == 'active' || $filter['status'] == 'inactive')) {
            $q->where('active', '=', $filter['status'] == 'active' ? true : false);
        }

        if (!empty($filter['search'])) {
            $q->where(function ($query) use ($filter) {
                $query->where('name', 'like', '%' . $filter['search'] . '%');
            });
        }

        $coachs = $q->paginate($request->get('per_page', 10))->withQueryString();

        return response()->json($coachs);
    }

    public function duplicate($id)
    {
        $item = coach::findOrFail($id);
        $item->id = null;
        $item->created_at = null;
        return inertia('coach/Editor', [
            'data' => $item,
        ]);
    }

    public function editor($id = 0)
    {
        $coach = $id ? coach::findOrFail($id) : new coach();
        if (!$id) {
            $coach->active = true;
        }

        return inertia('coach/Editor', [
            'data' => $coach,
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
        $coach = null;
        $message = '';
        $fields = ['name', 'gender', 'birth_date', 'phone', 'address', 'active'];
        if (!$request->id) {
            $request->validate($rules);
            $coach = new Coach();
            $message = 'Siswa baru telah dibuat.';
        } else {
            $request->validate($rules);
            $coach = coach::findOrFail($request->id);
            $message = "Siswa {$coach->name} telah diperbarui.";
        }

        $coach->fill($request->only($fields));
        $coach->save();

        return redirect(route('coach.index'))->with('success', $message);
    }

    public function delete($id)
    {
        $coach = Coach::findOrFail($id);
        $coach->delete();

        return response()->json([
            'message' => "Siswa {$coach->name} telah dihapus!"
        ]);
    }
}

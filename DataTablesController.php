<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DataTablesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    return '
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-info viewUser">View</a>
                    <a href="#" class="btn btn-sm btn-primary userEdit">Edit</a>
                    <a href="#" class="btn btn-sm btn-warning userHapus">Delete</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users');
    }
    public function show($id)
    {
        $User = User::find($id);
        return response()->json($User);
    }
}

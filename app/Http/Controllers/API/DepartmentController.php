<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$d = Department::all(); //select * from departments
        // $d = Department::select('id','name')->orderBy('id','desc')->get();
        // $d = Department::find(2);
        // $d = Department::where('name','like', '%บ%')->get();
        // $d = Department::latest()->get();//sort desc created_at
        // $d = DB::select('select * from departments order by id desc');
        // $d_count = Department::count();
        // return response()->json([
        //     'total' => $d_count,
        //     'data' => $d
        // ], 200);

        // $d = Department::orderBy('id','desc')->with(['officers'])->get();
        // $d = Department::orderBy('id','desc')->with(['officers' => function($query) {
        //     $query->orderBy('salary','desc');
        // }])->get();

        //?page=2&per_page=5
        $per_page = request()->query('per_page');
        $page_size = $per_page == null ? 5 : $per_page;

        $d = Department::orderBy('id','desc')->with(['officers' => function($query) {
            $query->orderBy('salary','desc');
        }])->paginate($page_size);

        return response()->json($d, 200);
    }

    public function search() {
        $query = request()->query('name');
        $keyword = '%'.$query.'%';
        $d = Department::where('name', 'like', $keyword)->get();

        return response()->json([
            'data' => $d
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $d = new Department();
        // $d->name = $request->name;
        // $d->save();
        $d = Department::create(['name' => $request->name]);
        return response()->json([
            'message' => 'เพิ่มข้อมูลเรียบร้อย',
            'data' => $d
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d = Department::find($id);

        if ($d == null) {
            return response()->json([
                'errors' => [
                    'status_code' => 404,
                    'message' => 'ไม่พบข้อมูล'
                ]
            ], 404);
        }

        return response()->json([
            'data' => $d
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($id != $request->id) {
            return response()->json([
                'errors' => [
                    'status_code' => 400,
                    'message' => 'รหัสไม่ตรงกัน'
                ]
            ], 400);
        }

        $d = Department::find($id);
        $d->name = $request->name;
        $d->save();
        return response()->json([
            'message' => 'แก้ไขข้อมูลเรียบร้อย',
            'data' => $d
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Department::find($id);

        if ($d == null) {
            return response()->json([
                'errors' => [
                    'status_code' => 404,
                    'message' => 'ไม่พบข้อมูล'
                ]
            ], 404);
        }

        $d->delete();

        return response()->json([
            'message' => 'ลบข้อมูลเรียบร้อย'
        ], 200);
    }
}

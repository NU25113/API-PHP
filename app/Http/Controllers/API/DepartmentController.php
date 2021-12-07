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
        // $d = Department::all ();
         $d  = Department::select('id','name')->orderBy('id','desc') ->get(); //*เลือกคอลัมที่เพิ่มล่าสุดมาไว้ข้างบน เรียงจากน้อยไปมาก
        // $d = Department::find(2);//*ถ้าต้องการถ้าตำแหน่งจาก pk
        // $d = Department::where('name','like','%ผ%')->get();//*เลือกชื่อที่ขึ้นต้นว่า ผ
        // $d  = Department::select('id','name')->get();//*เลือกคือบางคอลัม
        // $d = Department::latest()-> get(); //ถ้าในคอลลัมมีคอลัมคลีเอตแอต มันจะ sort ที่vreated_at
        //  $d = DB::select('select * from department order by id desc ');
        $d_coun = Department::count();//
        return response()->json([
            'total' => $d_coun,
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
        $d = new Department();
        $d->name = $request->name;
        $d->save();
        return response()->json([
            'message' =>'เพิ่มข้อมูลเรียบร้อย'
        ],201);
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
        $d = Department::find($id);
        $d->name = $request->name;
        $d->save();
        return response()->json([
            'message' => 'แก้ไขข้อมูบเรียบร้อย',
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
        //
    }
}

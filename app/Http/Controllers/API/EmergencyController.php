<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Emergency;
use Illuminate\Support\Facades\DB;


class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $Em = Emergency::all ();
                // $Em  = Emergency::select('id')->orderBy('id','desc') ->get();
                //     'em_category',
                //     'em_type',
                //     'em_detail',
                //     'em_owner',
                //     'em_phon',
                //     'em_pic','em_lat','em_lng','em_created_at','em_status','em_notified','em_notifier','em_province','em_site',
                //      //*เลือกคอลัมที่เพิ่มล่าสุดมาไว้ข้างบน เรียงจากน้อยไปมาก
                // $d = Department::find(2);//*ถ้าต้องการถ้าตำแหน่งจาก pk
                // $d = Department::where('name','like','%ผ%')->get();//*เลือกชื่อที่ขึ้นต้นว่า ผ
                // $d  = Department::select('id','name')->get();//*เลือกคือบางคอลัม
                // $d = Department::latest()-> get(); //ถ้าในคอลลัมมีคอลัมคลีเอตแอต มันจะ sort ที่vreated_at
                //  $d = DB::select('select * from department order by id desc ');
                // $em_coun = Emergency::count();//
                // return response()->json([
                //     'total' => $em_coun,
                //     'data' => $Em
                // ], 200);
                return response()->json($Em, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

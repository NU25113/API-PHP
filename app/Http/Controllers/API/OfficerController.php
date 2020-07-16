<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Officer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $of = Officer::with(['department'])->get();
        $of = Officer::with(['department:id,name', 'user:id,email'])->get();

        return response()->json([
            'data' => $of
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
        try {
            DB::beginTransaction();

            $of = new Officer();
            $of->firstname = $request->firstname;
            $of->lastname = $request->lastname;
            $of->dob = $request->dob;
            $of->salary = $request->salary;
            $of->user_id = $request->user_id;
            $of->department_id = $request->department_id;

            $of->save();
            DB::commit();

            return response()->json([
                'message' => 'เพิ่มข้อมูลพนักงานเรียบร้อย'
            ], 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => 'เกิดข้อผิดพลาดในการเพิ่มข้อมูล',
                'system message' => $th->getMessage()
            ], 400);
        }
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

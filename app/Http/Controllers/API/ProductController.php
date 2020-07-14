<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = ['coke', 'pepsi', 'greentea'];
        return response()->json($product, 200);
    }

    public function search()
    {
        $name = request()->query('name');
        $status = request()->query('status');

        return response()->json([
            'name' => $name,
            'status' => $status
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
        //insert product
        // return $request->all();

        // $name = $request->input('name');
        // $price = $request->input('price');

        $name = $request->name;
        $price = $request->price;

        return response()->json([
            'status_code' => 201,
            'message' => 'เพิ่มข้อมูลเรียบร้อย',
            'product' => [
                'name' => $name,
                'price' => $price
            ]
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
        $name = 'Coke';
        $url =  request()->url(); //current url
        return response()->json([
            'id' => $id,
            'name' => $name,
            'url' => $url
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
            return 'รหัส id ไม่ตรงกัน';
        }

        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'delete: ' . $id;
    }


}

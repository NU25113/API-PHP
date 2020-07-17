<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    //post
    public function register(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3'
        ],[
            'name.required' => 'ป้อนข้อมูลชื่อด้วย',
            'email.required' => 'ป้อนข้อมูลอีเมล์ด้วย',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'email.unique' => 'มีผู้ใช้งานอีเมล์นี้ในระบบแล้ว',
            'password.required' => 'ป้อนข้อมูลรหัสผ่านด้วย',
            'password.min' => 'ป้อนข้อมูลรหัสผ่านอย่างน้อย 3 ตัวอักษร',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'message' => $validator->errors()
                ]
            ], 422);
        }

        //เพิ่มข้อมูล User ใหม่
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'ลงทะเบียนเรียบร้อยแล้ว'
        ], 201);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:3',
            'device_name' => 'required'
        ],[
            'email.required' => 'ป้อนข้อมูลอีเมล์ด้วย',
            'email.email' => 'รูปแบบอีเมล์ไม่ถูกต้อง',
            'password.required' => 'ป้อนข้อมูลรหัสผ่านด้วย',
            'password.min' => 'ป้อนข้อมูลรหัสผ่านอย่างน้อย 3 ตัวอักษร',
            'device_name.required' => 'ระบุข้อมูลอุปกรณ์ของ Client ด้วย',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'message' => $validator->errors()
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
                ]
            ], 401);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        $personal_access_token = PersonalAccessToken::findToken($token);

        return response()->json([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => $personal_access_token->created_at->addMinutes(config('sanctum.expiration'))
        ], 200);

    }

    //post
    public function logout(Request $request) {
        //หาค่าของคอลัมน์ id ของ token ปัจจุบันที่กำลังล็อกอินอยู่
        $id = $request->user()->currentAccessToken()->id;

        //ลบ record token user ที่กำลังล็อกอินอยู่ ในตารางฐานข้อมูล
        $request->user()->tokens()->where('id', $id)->delete();

        return response()->json([
            'message' => 'ออกจากระบบเรียบร้อย'
        ], 200);
    }

    //get
    public function me(Request $request) {

        $user = $request->user();
       // $of = Officer::where('user_id', $user->id)->first();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'fullname' => $user->officer->fullname, //$of->fullname
                'age' =>  $user->officer->age, //$of->age
                'dob' => $user->officer->dob   //$of->dob
            ]
        ], 200);
    }


    //PUT (ใน body ของ POSTMAN ต้องส่ง password ใหม่เข้ามา)
    public function updateprofile(Request $request) {
        //update password ใหม่

        //1. ให้ทำ validation password อย่างน้อย 3 ตัวอักษร และต้องกรอกเข้ามา
        $validator = Validator::make($request->all(),[
            'password' => 'required|min:3',
        ],[
            'password.required' => 'ป้อนข้อมูลรหัสผ่านด้วย',
            'password.min' => 'ป้อนข้อมูลรหัสผ่านอย่างน้อย 3 ตัวอักษร',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => [
                    'message' => $validator->errors()
                ]
            ], 422);
        }

        //2. อัปเดต password ใหม่ (Hash) find($id ของ user)
        // $request->user()->id

        $user_update = User::find($request->user()->id);
        $user_update->password = Hash::make($request->password);
        $user_update->save();

        //3. firstname and lastname update
        $of = Officer::where('user_id', $request->user()->id)->first();
        $of->firstname = $request->firstname;
        $of->lastname = $request->lastname;
        $of->save();

        //firstname and lastname update (relationshiops)
        // $of = new Officer();
        // $of->firstname = $request->firstname;
        // $of->lastname = $request->lastname;
        // $user_update->officer()->save($of);

        //3. return บอกว่า แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว 200 และควร return ข้อมูล user ล่าสุดออกไปด้วย
        return response()->json([
            'message' => 'แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว',
            'user' => $user_update
        ], 200);

    }


}

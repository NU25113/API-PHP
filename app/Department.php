<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';//ถ้าชื่อตารางไม่ตรงกัน ให้ระบุที่นี่ ชื่อตารางต้องเป็นพหูพจน์
    //protected $primaryKey = 'd_id'; //กรณี pk เป็นชื่ออื่น
    //protected $keyType = 'string'; //คอลัมน์ pk ชนิดข้อมูลเป็น varchar
    //public $incrementing = false; //pk ไม่ได้ auto_increment
    //public $timestamps = false;//ตารางเราไม่มีคอลัมน์ created_at/updated_at ใน table


}

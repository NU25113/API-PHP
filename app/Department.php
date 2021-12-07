<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    // ถ้าชื่อตารางไม่ตรงกัน ให้ระบุที่นี่

    // protected $primaryKey = 'd_id'; กรณีชื่อตารางไม่ตรงกัน ให้ระบุที่นี่
    // protected $Keytype = 'string'; //ชนิกคอลัม pk ชนิดข้อมูลเป็น varchar
    // public $incrementing = false; // pk ไม่ได้เป็น auto_increment
    // public $timestamps = false; // ตารางเราไม่มีคอลัม created_at/updated_at ใน tadle
}

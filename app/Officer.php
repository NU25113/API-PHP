<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $table = 'officers';

    //many to one
    public function department() {
        //fk (officers) ,  pk (departments)
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    //belongsTo (one to one)
    public function user() {
        //fk (officers) ,  pk (users)
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // protected $hidden = ['firstname','lastname'];

    //เพิ่ม getter ไปยัง json
    protected $appends = ['fullname','age', 'picture_url'];

    //Defining Accessors (getter)
    public function getFullnameAttribute() { //fullname
        return "$this->firstname $this->lastname";
    }

    public function getAgeAttribute() { //age
        return now()->diffInYears($this->dob);
    }

    public function getPictureUrlAttribute() { //picture_url
        return asset('storage/upload') . '/' . $this->picture;
    }

}

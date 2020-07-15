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
}

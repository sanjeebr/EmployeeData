<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['emp_id', 'first_name', 'last_name', 'created_by', 'updated_by'];
}

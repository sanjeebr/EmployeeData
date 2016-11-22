<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $table = 'stacks';
    protected $fillable = ['stack_id', 'employee_id', 'name'];
}

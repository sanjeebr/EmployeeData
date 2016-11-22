<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpSkill extends Model
{
    protected $table = 'emp_skills';
    protected $fillable = ['employee_id', 'skill_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    Protected $fillable = ['first_name', 'last_name', 'gender', 'position', 'about'];
    Protected $primaryKey = 'id';
}

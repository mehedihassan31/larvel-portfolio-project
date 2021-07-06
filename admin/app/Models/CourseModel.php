<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;
    protected $table='courses';
    protected $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public $timestamps=false;
}

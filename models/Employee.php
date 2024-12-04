<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $fillable = ['firstName', 'lastName', 'hireDate', 'comments', 'genderId', 'departmentId'];
    public $timestamps = false;
    
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'genderId', 'id');
    }

  
    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_rada', 
        'naziv_rada_en', 
        'zadatak_rada',
        'tip_studija',
        'nastavnik_id',
        'student_id'
    ];

    //funkcija koja stvara n-n vezu izmedu tasks i users za studente
    public function students()
    {
        return $this->belongsToMany(User::class, "task_user", "task_id", "student_id");
    }

    //funkcija za dohvacanje studenta
    public function getStudent()
    {
        if($this->student_id!=null)
            return User::find($this->student_id);
        return null;
    }
}

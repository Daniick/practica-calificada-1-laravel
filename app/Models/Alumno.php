<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'apellido', 'email']; //los campos que desees llenar en masa

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alumno_curso'); 
    }
}

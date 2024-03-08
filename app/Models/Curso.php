<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion']; // incluir los campos que desees llenar en masa

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_curso'); 
    }
}

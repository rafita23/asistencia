<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mienbro extends Model
{
    use HasFactory;

    protected $table = 'mienbros'; // Nombre de la tabla en la base de datos
    protected $fillable = ['nombre_completo', 'telefono', 'grado_id']; // Ajusta según tus columnas

    public function grado(){
        return $this->belongsTo(Grado::class,'grado_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'user1', 'user2', 'tipo', 'leido', 'fecha'
    ];

    // Relación muchos a uno con la tabla Usuario (para user1)
    public function emisor()
    {
        return $this->belongsTo(Usuario::class, 'user1', 'id');
    }

    // Relación muchos a uno con la tabla Usuario (para user2)
    public function receptor()
    {
        return $this->belongsTo(Usuario::class, 'user2', 'id');
    }
}

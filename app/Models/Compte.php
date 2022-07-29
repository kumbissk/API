<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    use HasFactory;

    protected $casts = [
        'roleUser' => \App\Enum\UserRoleEnum::class
    ];

    protected $fillable = [
        'email',
        'mot_de_passe',
        'dateOuverture',
        'role',
        'etat',
        'personne_id',
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }
}

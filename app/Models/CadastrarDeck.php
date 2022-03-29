<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadastrarDeck extends Model
{
    use HasFactory;
	protected $table = "cadastrar_deck";
	
	protected $fillable = [
        'name',
        'formato',
        'user_id',
    ];
	
}

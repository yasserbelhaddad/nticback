<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prsnadministrative extends Model
{
    use HasFactory;
    
    protected $table = 'prsnadministratives';

    protected $primaryKey = 'id';

    protected $fillable = ['FirstName','LastName','Email','Password'];
}

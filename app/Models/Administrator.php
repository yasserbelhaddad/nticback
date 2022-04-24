<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = 'administrators';

    protected $primaryKey = 'id';

    protected $fillable = ['FirstName','LastName','Email','Password'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $primaryKey = 'id';

    protected $fillable = ['FirstName','LastName','Email','PhoneNumber','Department','Grade','Status','State','Password'];

    public function Reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}

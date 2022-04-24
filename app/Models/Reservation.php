<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $primaryKey = 'id';

    public $fillable = ['ReservationDate' , 'Teacher_id' , 'Timing_id' , 'Room_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function timing()
    {
        return $this->belongsTo(Timing::class);
    }

    public function material()
    {
        return $this->hasMany(Material::class);
    }

}

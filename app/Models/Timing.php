<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{
    use HasFactory;

    protected $table = 'timings';

    protected $primaryKey = 'id';

    protected $fillable = ['StartTime','EndTime'];

    public function Reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
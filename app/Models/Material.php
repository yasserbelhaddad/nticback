<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';

    protected $primaryKey = 'id';

    public $fillable = ['State' , 'SerialNumber' , 'Property' , 'TypeMaterial' , 'Reservation_id'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}

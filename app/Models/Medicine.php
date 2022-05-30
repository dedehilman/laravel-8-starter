<?php

namespace App\Models;

use App\Traits\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory, BlameableTrait;

    protected $fillable = ['code', 'name', 'medicine_type_id', 'unit_id',];

    public function medicineType() {
        return $this->belongsTo(MedicineType::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function scopeWithAll($query) 
    {
        return $query->with(['medicineType','unit']);
    }
}

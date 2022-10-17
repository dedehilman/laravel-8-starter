<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BlameableTrait;

class StockReport extends Model
{
    use HasFactory, BlameableTrait;

    protected $fillable = [
        'code', 
        'file_path', 
        'message', 
        'runned_at', 
        'finished_at', 
        'status', 
        'num_of_downloaded',
        'period_id', 
        'clinic_id',
        'report_format',
    ];

    public function period() {
        return $this->belongsTo(Period::class);
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class);
    }

    public function scopeWithAll($query) 
    {
        return $query->with(['period','clinic']);
    }
}

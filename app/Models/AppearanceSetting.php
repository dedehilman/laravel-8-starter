<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BlameableTrait;

class AppearanceSetting extends Model
{
    use HasFactory, BlameableTrait;
}

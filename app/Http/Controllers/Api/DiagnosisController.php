<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends ApiController
{

    public function __construct()
    {
        $this->setDefaultMiddleware('diagnosis');
        $this->setModel('App\Models\Diagnosis');
    }
}

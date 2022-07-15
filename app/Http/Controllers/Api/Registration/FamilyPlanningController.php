<?php

namespace App\Http\Controllers\Api\Registration;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Models\FamilyPlanning;
use Carbon\Carbon;
use Lang;

class FamilyPlanningController extends ApiController
{

    public function __construct()
    {
        $this->setDefaultMiddleware('registration-family-planning');
        $this->setModel('App\Models\FamilyPlanning');
    }

    public function store(Request $request)
    {
        try {
            $count = FamilyPlanning::whereDate('transaction_date', Carbon::now()->isoFormat('YYYY-MM-DD'))->count();
            $request['transaction_no'] = 'KB-'.Carbon::now()->isoFormat('YYYYMMDD').'-'.str_pad(($count +1), 5, '0', STR_PAD_LEFT);

            $validateOnStore = $this->validateOnStore($request);
            if($validateOnStore) {
                return response()->json([
                    'status' => '400',
                    'message'=> $validateOnStore,
                    'data' => '',
                ]);
            }

            $data = $this->model::create($request->all());
            return response()->json([
                'status' => '200',
                'message'=> Lang::get("Data has been stored"),
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '500',
                'message'=> $th->getMessage(),
                'data' => '',
            ]);
        }        
    }
}

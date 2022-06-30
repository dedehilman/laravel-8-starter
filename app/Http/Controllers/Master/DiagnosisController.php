<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\AppCrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;
use Lang;

class DiagnosisController extends AppCrudController
{

    public function __construct()
    {
        $this->setDefaultMiddleware('diagnosis');
        $this->setDefaultView('master.diagnosis');
        $this->setModel('App\Models\Diagnosis');
    }

    public function store(Request $request)
    {
        try {
            $validateOnStore = $this->validateOnStore($request);
            if($validateOnStore) {
                return response()->json([
                    'status' => '400',
                    'data' => '',
                    'message'=> $validateOnStore
                ]);
            }

            DB::beginTransaction();
            $data = new Diagnosis();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->handling = $request->handling;
            $data->disease_id = $request->disease_id;
            $data->save();

            $data->syncSymptoms($request->symptoms);
            
            DB::commit();
            return response()->json([
                'status' => '200',
                'data' => '',
                'message'=> Lang::get("Data has been stored")
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'data' => '',
                'message'=> $th->getMessage()
            ]);
        }        
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->model::find($id);
            if(!$data) {
                return response()->json([
                    'status' => '400',
                    'data' => '',
                    'message'=> Lang::get("Data not found")
                ]);
            }

            $validateOnUpdate = $this->validateOnUpdate($request, $id);
            if($validateOnUpdate) {
                return response()->json([
                    'status' => '400',
                    'data' => '',
                    'message'=> $validateOnUpdate
                ]);
            }

            DB::beginTransaction();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->handling = $request->handling;
            $data->disease_id = $request->disease_id;
            $data->save();

            $data->syncSymptoms($request->symptoms);

            DB::commit();
            return response()->json([
                'status' => '200',
                'data' => '',
                'message'=> Lang::get("Data has been updated")
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => '500',
                'data' => '',
                'message'=> $th->getMessage()
            ]);
        }     
    }

    public function validateOnStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255|unique:diagnoses',
            'name' => 'required|max:255',
            'handling' => 'max:255',
            'disease_id' => 'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }
    }

    public function validateOnUpdate(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255|unique:diagnoses,code,'.$id,
            'name' => 'required|max:255',
            'handling' => 'max:255',
            'disease_id' => 'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }
    }
}


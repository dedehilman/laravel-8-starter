<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\AppCrudController;
use Illuminate\Support\Facades\Validator;

class CompanyGroupController extends AppCrudController
{

    public function __construct()
    {
        $this->setDefaultMiddleware('company-group');
        $this->setSelect('master.company-group.select');
        $this->setIndex('master.company-group.index');
        $this->setCreate('master.company-group.create');
        $this->setEdit('master.company-group.edit');
        $this->setView('master.company-group.view');
        $this->setModel('App\Models\CompanyGroup');
    }

    public function validateOnStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255|unique:company_groups',
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }
    }

    public function validateOnUpdate(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:255|unique:company_groups,code,'.$id,
            'name' => 'required|max:255',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }
    }
}

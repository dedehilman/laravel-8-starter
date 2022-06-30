@extends('layout', ['title' => Lang::get("Clinic"), 'subTitle' => Lang::get("View data clinic")])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">       
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Logo")}}</label>
                        <div class="col-md-9">
                            @if ($data->image)
                                <img src="{{ asset($data->image) }}" width="150" height="150">
                            @else
                                <img src="{{ asset('public/img/logo.png') }}" width="150" height="150">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Code")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->code}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Name")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->name}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Address")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->address}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Location")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->Location}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Phone")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->phone}}</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">{{__("Business Area")}}</label>
                        <div class="col-md-9 col-form-label">{{$data->estate->name ?? ''}}</div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{route('clinic.index')}}" class="btn btn-default"><i class="fas fa fa-undo"></i> {{__("Back")}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
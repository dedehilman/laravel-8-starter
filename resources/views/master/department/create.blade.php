@extends('layout', ['title' => Lang::get("Department"), 'subTitle' => Lang::get("Create data department")])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('department.store')}}" method="POST">
                @csrf
                
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
                            <label class="col-md-3 col-form-label required">{{__("Code")}}</label>
                            <div class="col-md-9">
                                <input type="text" name="code" class="form-control required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label required">{{__("Name")}}</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">{{__("Parent")}}</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="text" name="parent_name" id="parent_name" class="form-control" readonly>
                                    <input type="hidden" name="parent_id" id="parent_id">
                                    <div class="input-group-append">
                                        <span class="input-group-text show-modal-select" data-title="{{__('Department List')}}" data-url="{{route('department.select')}}" data-handler="onSelected"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{route('department.index')}}" class="btn btn-default"><i class="fas fa fa-undo"></i> {{__("Back")}}</a>
                        <button type="button" class="btn btn-primary" id="btn-store"><i class="fas fa fa-save"></i> {{__("Save")}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function onSelected(data) {
            $('#parent_id').val(data[0].id);
            $('#parent_name').val(data[0].code + ' ' + data[0].name);
        }
    </script>
@endsection
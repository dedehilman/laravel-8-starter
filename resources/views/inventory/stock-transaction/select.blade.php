<div class="row">
    <div class="col-md-12">
        <form id="formSelectSearch">
            @foreach ($parameters as $key => $value)
                <input type="hidden" name="{{$key}}" value="{{$value}}">                
            @endforeach
        </form>
        <table id="datatable-select" class="table table-bordered">
            <thead>
                <tr>
                    <th>@if(($select ?? 'single') == 'multiple')<input type='checkbox' name="select-all"/>@endif</th>
                    <th>{{ __("Transaction No") }}</th>
                    <th>{{ __("Transcation Date") }}</th>
                    <th>{{ __("Clinic") }}</th>
                    <th>{{ __("Transaction Type") }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<script>
    $('document').ready(function(){
        $('#datatable-select').DataTable({
            ajax:
            {
                url: "{{route('stock-transaction.datatable.select')}}",
                type: 'POST',
                data: function(data){
                    getDatatableSelectParameter(data);
                },
                error: function (xhr, error, thrown) {
                    
                }
            },
            searching: true,
            order: [[1, "asc"]],
            select: @if($select == 'multiple') 'multiple' @else 'single' @endif,
            columns: [
                {
                    width: "30px",
                    defaultContent: '',
                    sortable: false,
                    className: 'select-checkbox text-center',
                    render: function(data, type, row)
                    {
                        return '';
                    }
                }, {
                    data: 'transaction_no',
                    name: 'transaction_no',
                    defaultContent: '',
                }, {
                    data: 'transaction_date',
                    name: 'transaction_no',
                    defaultContent: '',
                }, {
                    data: 'clinic.code',
                    name: 'clinic_id',
                    defaultContent: '',
                    render: function(data, type, row)
                    {
                        return data + "<i class='ml-2 mr-2 fas fa-arrow-right'></i>" + row.new_clinic.code;
                    }
                }, {
                    data: 'transaction_type',
                    name: 'transaction_type',
                    defaultContent: '',
                }
            ],
            rowCallback: function(row, data) {
                if(Array.isArray(selectedIds) && selectedIds.includes(data.id)) {
                    $(row).addClass('selected');
                }
            }
        });

        $('#datatable-select').DataTable().on('select', function ( e, dt, type, indexes ) {
            var data = $('#datatable-select').DataTable().rows(indexes).data();
            if(Array.isArray(selectedIds) && !selectedIds.includes(data[0].id)) {
                selectedIds.push(data[0].id);
            }
        }).on('deselect', function ( e, dt, type, indexes ) {
            var data = $('#datatable-select').DataTable().rows(indexes).data();
            if(Array.isArray(selectedIds) && selectedIds.includes(data[0].id)) {
                var index = selectedIds.indexOf(data[0].id);
                selectedIds.splice(index, 1);
            }
        });
    });
</script>
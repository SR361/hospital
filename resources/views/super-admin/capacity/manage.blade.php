@extends('super-admin.layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-1">
                        <h2>{{$page}} ({{$units->LearningSpecialty->name}})</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Training</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 1 @endphp
                                @foreach($training as $row)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{$row->name}}</td>
                                        <td>
                                            @php
                                                $traineecapacity = App\Models\TraineeUnitsCapacity::where('units_id',$units->id)->where('training_id',$row->id)->first();
                                            @endphp
                                            <select onchange="changestatus({{$units->id}},{{$row->id}},this)" class="form-control" id="training-status" data-unitid="{{$units->id}}" data-trainingid="{{$row->id}}">
                                                <option value="">Select Option</option>
                                                <option @if(!is_null($traineecapacity)) @if($traineecapacity->status == '1') selected @endif @endif value="1">Yes</option>
                                                <option @if(!is_null($traineecapacity)) @if($traineecapacity->status == '0') selected @endif @endif value="0">No</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @php $index++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script')
  <script>
        function changestatus(unitid,trainingid,e){
            var status = e.value;
            $.ajax({
                url: "{{ route('super.admin.unit.capacity.manage.update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    unitid: unitid,
                    trainingid: trainingid,
                    status : e.value
                },
                success: function(response) {
                    if (response.success == true) {
                        Swal.fire({
                            toast : true,
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 4000
                        })
                    }
                }
            });
        }
  </script>
@endpush

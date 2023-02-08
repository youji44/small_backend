@extends('admin.layout')
{{-- Page title --}}
@section('title')
    Dashboard
@stop
{{-- page level styles --}}
@section('header_styles')
@stop

@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">User Details</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>DateTime</th>
                        <th>IP Address</th>
                        <th>ISP</th>
                        <th>Browser</th>
                        <th>Request Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach($data as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{date('Y-m-d H:i',strtotime($item->dateTime))}}</td>
                        <td>{{$item->ipAddress}}</td>
                        <td>{{$item->isp}}</td>
                        <td>{{$item->browsersDetails}}</td>
                        <td>
                            <form id="form-status-{{$item->id}}" hidden action="{{route('user.detail.update')}}" method="post">
                                @csrf
                                <input hidden name="id" value="{{$item->id}}">
                                <input hidden name="enable" id="enable-{{$item->id}}">
                            </form>
                            <select class="form-control" onchange="update(this.value,{{$item->id}})">
                                <option value="1" {{$item->enable==1?'selected':''}}>Pending</option>
                                <option value="2" {{$item->enable==2?'selected':''}}>Approved</option>
                                <option value="0" {{$item->enable==0?'selected':''}}>Cancelled</option>
                            </select>
                        </td>
                        <td>
                            <a href="{{route('user.detail.delete',$item->id)}}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i
                                        class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        function update(value,id) {
            $("#enable-"+id).val(value);
            $("#form-status-"+id).submit();
        }
    </script>
@endsection
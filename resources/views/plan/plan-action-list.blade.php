@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plan Data List</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Form Validation</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">   
                @if(Session::has('error'))
                                    <div class="alert alert-danger alert-block">
                                        <strong>{{ Session::get('error') }}</strong>
                                    </div>
                    @endif
                    @if(Session::has('success'))
                                    <div class="alert alert-success alert-block">
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                @endif    
                <div class="row">  
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>วันที่</th>
                                    <th>รายละเอียด</th>
                                    <th>ผู้บันทึก</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plan as $item)
                                    <tr>
                                        <td>{{$item->plan_date}}</td>
                                        <td>{{$item->plan_remark}}</td>
                                        <td>{{$item->person_at}}</td>
                                        <td>
                                            <a href="{{route('plan-action.edit',$item->id)}}" class="btn btn-info btn-sm">อัพเดท</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</div>         
@endsection
@push('scriptjs')
<script>
</script>
@endpush
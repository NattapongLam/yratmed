@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona History Edit</h4>
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
                <form class="custom-validation" action="{{ route('history.update',$emp->id) }}" method="POST" enctype="multipart/form-data" validate>
                @csrf
                @method('PUT') 
                <div class="row">                    
                    <div class="col-3">
                        <input type="date" class="form-control" name="history_date" value="{{$emp->history_date}}" readonly>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" name="personal_name" value="{{$emp->personal_name}} ประเภท : {{$emp->personal_type}} ({{$emp->personal_sub}})" readonly>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="status_id" required>
                            <option value="{{$emp->status_id}}">{{$emp->status_name}}</option>
                            @foreach($sta as $stas)
                            <option value="{{ $stas->id }}">{{ $stas->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">อาการสำคัญ</label>
                        <textarea class="form-control" rows="3" name="serious_lllness" id="serious_lllness" readonly>{{$emp->serious_lllness}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">ประวัติการเจ็บป่วยปัจจุบัน</label>
                        <textarea class="form-control" rows="3" name="serious_lnjury" id="serious_lnjury" readonly>{{$emp->serious_lnjury}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การตรวจร่างกาย</label>
                        <textarea class="form-control" rows="3" name="previous_surgery" id="previous_surgery" readonly>{{$emp->previous_surgery}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การวินิจฉัย</label>
                        <textarea class="form-control" name="diagnosis" id="diagnosis" readonly>{{$emp->diagnosis}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การรักษา</label>
                        <textarea class="form-control" name="treatment" id="treatment" readonly>{{$emp->treatment}}</textarea>
                    </div>
                </div><hr>
                <div class="row">
                    <h4 class="card-title">
                        ติดตาม
                    </h4>
                    <div class="col-12">
                        <textarea class="form-control" rows="3" name="remark"></textarea>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body"> 
                <h4 class="card-title" style="color: red">
                    ผลติดตาม
                </h4>
                <div class="table-responsive">
                <table class="table table-bordered border-primary mb-0 text-center">
                    <thead class="table-light">
                        <tr>
                            <th>วันที่ติดตาม</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($log as $logs)
                        <tr>
                            <td>{{$logs->created_at}}</td>
                            <td>{{$logs->remark}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
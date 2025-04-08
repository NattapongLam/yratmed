@extends('layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Physical Data Create</h4>
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
                <form class="custom-validation" action="{{ route('physical.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                <div class="row">
                    <div class="col-3">
                        <input type="date" class="form-control" name="physical_date" value="{{old('physical_date',date('Y-m-d'))}}" required>
                    </div>
                    <div class="col-9">
                        <select class="form-select" name="personal_id" id="personalSelect" required>
                            <option value="">Persona List</option>
                            @foreach($emp as $emps)
                            <option value="{{ $emps->id }}">ชื่อ - นามสกุล : {{ $emps->personal_name }} ประเภท : {{ $emps->personal_type }} กลุ่ม : {{ $emps->personal_sub }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">การวินิจฉัยทางกายภาพบำบัด</label>
                        <textarea class="form-control" name="physical_diagnosis" id="physical_diagnosis" rows="5" required></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">การรักษาทางกายภาพบำบัด</label>
                        <textarea class="form-control" name="physical_treatment" id="physical_treatment" rows="5" required></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">ผลการรักษา</label>
                        <textarea class="form-control" name="physical_results" id="physical_results" rows="5" required></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">หมายเหตุ ข้อจำกัดหรืออุปสรรค</label>
                        <textarea class="form-control" name="physical_remark" id="physical_remark" rows="5" required></textarea>
                    </div>
                </div>
                <br>
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
@endsection
@push('scriptjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('#personalSelect').select2();
});
</script>
@endpush
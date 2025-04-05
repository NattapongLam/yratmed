@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Data Create</h4>
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
                <form class="custom-validation" action="{{ route('personal.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">ชื่อ - นามสกุล</label>
                        <input class="form-control" name="personal_name" id="personal_name">
                    </div>
                    <div class="col-4">
                        <label class="form-label">เพศ</label>
                        <select class="form-select" name="personal_sex" id="personal_sex">
                            <option value="">กรุณาเลือก</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">ประเภท</label>
                        <select class="form-select" name="personal_type" id="personal_type">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($typ as $item)
                            <option value="{{$item->type_name}}">{{$item->type_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">หน่วยย่อย</label>
                        <select class="form-select" name="personal_sub" id="personal_sub">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($sub as $item)
                            <option value="{{$item->sub_name}}">{{$item->sub_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">วันเกิด</label>
                        <input class="form-control" type="date" name="personal_birthday" id="personal_birthday">
                    </div>
                    <div class="col-4">
                        <label class="form-label">อายุ</label>
                        <input class="form-control" type="text" placeholder="ปี-เดือน-วัน" name="personal_age" id="personal_age">
                    </div>
                    <div class="col-4">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input class="form-control" type="text" name="personal_tel" id="personal_tel">
                    </div>
                    <div class="col-4">
                        <label class="form-label">ที่อยู่</label>
                        <input class="form-control" type="text" name="personal_address" id="personal_address">
                    </div>
                    <div class="col-4">
                        <label class="form-label">รูปภาพ</label>
                        <div class="input-group">
                            <input type="file" class="form-control" autocomplete="off"  id="inputGroupFile02" name="avatar" accept="image/*">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">ข้อมูลอ้างอิง</label>
                        <input class="form-control" type="text" name="personal_underlying" id="personal_underlying">
                    </div>
                    <div class="col-12">
                        <label class="form-label">ข้อมูลแพทย์ปัจจุบัน</label>
                        <textarea class="form-control" rows="3" name="personal_currentmed" id="personal_currentmed"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">โรคภูมิแพ้</label>
                        <input class="form-control" type="text" name="personal_allergy" id="personal_allergy">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Serious Illness</label>
                        <textarea class="form-control"  rows="3" name="serious_lllness" id="serious_lllness"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Serious Injury</label>
                        <textarea class="form-control" rows="3" name="serious_lnjury" id="serious_lnjury"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Previous Surgery</label>
                        <textarea class="form-control"  rows="3" name="previous_surgery" id="previous_surgery"></textarea>
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
<script>
</script>
@endpush
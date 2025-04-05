@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Lab Create</h4>
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
                <form class="custom-validation" action="{{ route('lab.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf                   
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">วันที่</label>
                        <input class="form-control" type="date" name="lap_date" id="lap_date" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">หมายเหตุ</label>
                        <textarea class="form-control" name="lap_remark" id="lap_remark"></textarea>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" style="border-collapse: collapse">
                            <thead>
                                @foreach ($emp as $key => $item)
                                @php
                                $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                $now = \Carbon\Carbon::now();
                                $diffYears = $birthDate->diffInYears($now);
                                $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                @endphp
                                    <tr>
                                        <th><img width="70px" src="{{ asset($item->personal_img)}}"></th>
                                        <th colspan="3">
                                            {{$key+1}}. ชื่อ - นามสกุล  {{$item->personal_name}} อายุ {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                            <input type="hidden" name="personal_id[]" value="{{ $item->id }}">
                                            <input type="hidden" name="personal_name[]" value="{{ $item->personal_name }}">
                                            <input type="hidden" name="personal_age[]" value="{{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน">
                                        </th>
                                        <th colspan="4">
                                           หมายเหตุ <textarea class="form-control" name="remark[]" id="remark"></textarea>
                                        </th>
                                    </tr>
                                    <tr style="background-color: #CCFFFF">
                                        <td>BH (cm.) <input class="form-control" name="bh[]" value="{{old('bh',0)}}"></td>
                                        <td>BW (kg.) <input class="form-control" name="bw[]" value="{{old('bw',0)}}"></td>
                                        <td>BMI (kg./m2) <input class="form-control" name="bmi[]" value="{{old('bmi',0)}}"></td>
                                        <td>RBC (3.8-5.3*M) <input class="form-control" name="rbc[]" value="{{old('rbc',0)}}"></td>
                                        <td>Hb (12-16 g/dL) <input class="form-control" name="hb[]" value="{{old('hb',0)}}"></td>
                                        <td>Hct (36-47%) <input class="form-control" name="hct[]" value="{{old('hct',0)}}"></td>
                                        <td>MCV (80-100) fL <input class="form-control" name="mvc[]" value="{{old('mvc',0)}}"></td>
                                        <td>MCH (27-32) pg <input class="form-control" name="mch[]" value="{{old('mch',0)}}"></td>
                                       
                                    </tr>
                                    <tr style="background-color: #FFCCCC">                                      
                                        <td>MCHC (32-36) g/dL <input class="form-control" name="mchc[]" value="{{old('mchc',0)}}"></td>
                                        <td>RDW (10-16.5) % <input class="form-control" name="rdw[]" value="{{old('rdw',0)}}"></td>
                                        <td>WBC (4,000-10,000) <input class="form-control" name="wbc[]" value="{{old('wbc',0)}}"></td>
                                        <td>PLT (140-400K) <input class="form-control" name="plt[]" value="{{old('plt',0)}}"></td>
                                        <td>Ferritin (13-150 ng/mL) <input class="form-control" name="ferritin[]" value="{{old('ferritin',0)}}"></td>
                                        <td>CPK (29 - 168 U/L) <input class="form-control" name="cpk[]" value="{{old('cpk',0)}}"></td>
                                        <td>Blood Sugar (70-140 mg/dL) <input class="form-control" name="bloodsugar[]" value="{{old('bloodsugar',0)}}"></td>
                                        <td>BUN (7-20 mg%) <input class="form-control" name="bun[]" value="{{old('bun',0)}}"></td>
                                    </tr>
                                    <tr style="background-color: #F2FFCC">                                       
                                        <td>Cr (0.5-0.9 mg/dL) <input class="form-control" name="cr[]" value="{{old('cr',0)}}"></td>
                                        <td>GFR (70-120)<input class="form-control" name="gf[]" value="{{old('gf',0)}}"></td>
                                        <td>AST (0-40 U/L)<input class="form-control" name="ast[]" value="{{old('ast',0)}}"></td>
                                        <td>ALT (0-41 U/L)<input class="form-control" name="alt[]" value="{{old('alt',0)}}"></td>
                                        <td>ALP (0-115 U/L)<input class="form-control" name="alp[]" value="{{old('alp',0)}}"></td>
                                        <td>Albumin (3.5-5 g/dL)<input class="form-control" name="albumin[]" value="{{old('albumin',0)}}"></td>
                                        <td>Sp. Gravity (1.001-1.030)<input class="form-control" name="sp[]" value="{{old('sp',0)}}"></td>
                                        <td>pH (5.0-7.0)<input class="form-control" name="ph[]" value="{{old('ph',0)}}"></td>
                                        
                                    </tr>
                                    <tr style="background-color: #FFCCFF">
                                        <td>Prot (Neg)<input class="form-control" name="prot[]"></td>
                                        <td>Glucose (Neg)<input class="form-control" name="glucose[]"></td>
                                        <td>Ketone (Neg)<input class="form-control" name="ketone[]"></td>
                                        <td>WBC (0-5)<input class="form-control" name="wb[]"></td>
                                        <td>RBC (0-2)<input class="form-control" name="rb[]"></td>
                                        <td>Epith (0-5)<input class="form-control" name="epith[]"></td>
                                        <td>Bac (-)<input class="form-control" name="bac[]"></td>
                                        <td>Mucous (-)<input class="form-control" name="mucous[]"></td>
                                    </tr>
                                @endforeach
                            </thead>
                    </table>
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
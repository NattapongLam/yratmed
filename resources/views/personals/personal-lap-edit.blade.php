@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Lab Edit</h4>
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
                <form class="custom-validation" action="{{ route('lab.update',$hd->id) }}" method="POST" enctype="multipart/form-data" validate>
                @csrf     
                @method('PUT')              
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">วันที่</label>
                        <input class="form-control" type="date" name="lap_date" id="lap_date" value="{{$hd->lap_date}}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">หมายเหตุ</label>
                        <textarea class="form-control" name="lap_remark" id="lap_remark">{{$hd->lap_remark}}</textarea>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" style="border-collapse: collapse">
                            <thead>
                                @foreach ($dt as $key => $item)
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
                                            {{$key+1}}. ชื่อ - นามสกุล  {{$item->personal_name}} อายุ {{ $item->personal_age }} 
                                            <input type="hidden" name="sub_id[]" value="{{ $item->id }}">                                           
                                        </th>
                                        <th colspan="4">
                                           หมายเหตุ <textarea class="form-control" name="remark[]" id="remark"></textarea>
                                        </th>
                                    </tr>
                                    <tr style="background-color: #CCFFFF">
                                        <td>BH (cm.) <input class="form-control" name="bh[]" value="{{$item->bh}}"></td>
                                        <td>BW (kg.) <input class="form-control" name="bw[]" value="{{$item->bw}}"></td>
                                        <td>BMI (kg./m2) <input class="form-control" name="bmi[]" value="{{$item->bmi}}"></td>
                                        <td>RBC (3.8-5.3*M) <input class="form-control" name="rbc[]" value="{{$item->rbc}}"></td>
                                        <td>Hb (12-16 g/dL) <input class="form-control" name="hb[]" value="{{$item->hb}}"></td>
                                        <td>Hct (36-47%) <input class="form-control" name="hct[]" value="{{$item->hct}}"></td>
                                        <td>MCV (80-100) fL <input class="form-control" name="mvc[]" value="{{$item->mvc}}"></td>
                                        <td>MCH (27-32) pg <input class="form-control" name="mch[]" value="{{$item->mch}}"></td>
                                       
                                    </tr>
                                    <tr style="background-color: #FFCCCC">                                      
                                        <td>MCHC (32-36) g/dL <input class="form-control" name="mchc[]" value="{{$item->mchc}}"></td>
                                        <td>RDW (10-16.5) % <input class="form-control" name="rdw[]" value="{{$item->rdw}}"></td>
                                        <td>WBC (4,000-10,000) <input class="form-control" name="wbc[]" value="{{$item->wbc}}"></td>
                                        <td>PLT (140-400K) <input class="form-control" name="plt[]" value="{{$item->plt}}"></td>
                                        <td>Ferritin (13-150 ng/mL) <input class="form-control" name="ferritin[]" value="{{$item->ferritin}}"></td>
                                        <td>CPK (29 - 168 U/L) <input class="form-control" name="cpk[]" value="{{$item->cpk}}"></td>
                                        <td>Blood Sugar (70-140 mg/dL) <input class="form-control" name="bloodsugar[]" value="{{$item->bloodsugar}}"></td>
                                        <td>BUN (7-20 mg%) <input class="form-control" name="bun[]" value="{{$item->bun}}"></td>
                                    </tr>
                                    <tr style="background-color: #F2FFCC">                                       
                                        <td>Cr (0.5-0.9 mg/dL) <input class="form-control" name="cr[]" value="{{$item->cr}}"></td>
                                        <td>GFR (70-120)<input class="form-control" name="gf[]" value="{{$item->gf}}"></td>
                                        <td>AST (0-40 U/L)<input class="form-control" name="ast[]" value="{{$item->ast}}"></td>
                                        <td>ALT (0-41 U/L)<input class="form-control" name="alt[]" value="{{$item->alt}}"></td>
                                        <td>ALP (0-115 U/L)<input class="form-control" name="alp[]" value="{{$item->alp}}"></td>
                                        <td>Albumin (3.5-5 g/dL)<input class="form-control" name="albumin[]" value="{{$item->albumin}}"></td>
                                        <td>Sp. Gravity (1.001-1.030)<input class="form-control" name="sp[]" value="{{$item->sp}}"></td>
                                        <td>pH (5.0-7.0)<input class="form-control" name="ph[]" value="{{$item->ph}}"></td>
                                        
                                    </tr>
                                    <tr style="background-color: #FFCCFF">
                                        <td>Prot (Neg)<input class="form-control" name="prot[]" value="{{$item->prot}}"></td>
                                        <td>Glucose (Neg)<input class="form-control" name="glucose[]" value="{{$item->glucose}}"></td>
                                        <td>Ketone (Neg)<input class="form-control" name="ketone[]" value="{{$item->ketone}}"></td>
                                        <td>WBC (0-5)<input class="form-control" name="wb[]" value="{{$item->wb}}"></td>
                                        <td>RBC (0-2)<input class="form-control" name="rb[]" value="{{$item->rb}}"></td>
                                        <td>Epith (0-5)<input class="form-control" name="epith[]" value="{{$item->epith}}"></td>
                                        <td>Bac (-)<input class="form-control" name="bac[]" value="{{$item->bac}}"></td>
                                        <td>Mucous (-)<input class="form-control" name="mucous[]" value="{{$item->mucous}}"></td>
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
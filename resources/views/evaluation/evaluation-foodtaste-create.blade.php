@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">แบบประเมินและแสดงความคิดเห็นด้านการจัดอาหาร</h4>
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
                <form class="custom-validation" action="{{ route('foodtaste.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf 
                <div class="row">
                    <div class="col-6">
                        <h5>วันที่ประเมิน</h5>
                        <input type="date" class="form-control" name="foodtaste_date" id="validationCustom04" required>
                    </div>
                    <div class="col-6">
                        <h5>มื้ออาหาร</h5>
                        <select class="form-select" name="foodtaste_type" required>
                            <option value="">กรุณาเลือก</option>
                            <option value="มื้อหลัก(เช้า)">มื้อหลัก(เช้า)</option>
                            <option value="มื้อหลัก(กลางวัน)">มื้อหลัก(กลางวัน)</option>
                            <option value="มื้อหลัก(เย็น)">มื้อหลัก(เย็น)</option>
                            <option value="มื้อว่าง(เช้า)">มื้อว่าง(เช้า)</option>
                            <option value="มื้อว่าง(บ่าย)">มื้อว่าง(บ่าย)</option>
                            <option value="มื้อว่าง(ก่อนนอน)">มื้อว่าง(ก่อนนอน)</option>
                        </select>
                    </div>
                    <hr>
                    <div class="col-12">
                        <h5>ข้อจำกัดเรื่องอาหาร</h5>
                    </div>
                    <div class="col-3">
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheckcolor1"  name="dietarycheck1">
                            <label class="form-check-label" for="formCheckcolor1">
                                แพ้อาหาร ระบุ 
                            </label>
                        </div>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" name="dietaryremark1">
                    </div>
                    <hr>
                    <div class="col-3">
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheckcolor1" name="dietarycheck2">
                            <label class="form-check-label" for="formCheckcolor1">
                                ข้อห้ามทางศาสนาหรือความเชื่อ ระบุ
                            </label>
                        </div>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" name="dietaryremark2">
                    </div>
                    <hr>
                    <div class="col-3">
                        <div class="form-check form-check-primary mb-3">
                            <input class="form-check-input" type="checkbox" id="formCheckcolor1" name="dietarycheck3">
                            <label class="form-check-label" for="formCheckcolor1">
                                อื่น ๆ ระบุ 
                            </label>
                        </div>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control" name="dietaryremark3">
                    </div>
                </div>
                <hr>
                <div class="row">                 
                    <div class="col-12">
                        <h5 style="color: red">เขียนข้อเสนอแนะประเด็นนั้น ๆ กรณีให้คะแนนระดับไม่ดี (๒) และต้องปรัปรุง (๑)</h5>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>ประเด็น</th>
                                    <th>ประเมิน</th>
                                    <th>ข้อเสนอแนะ/ถ้าไม่ดีหรือต้องปรับปรุง โปรดเสนอแนะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>
                                            {{$item->no}}.{{$item->name}}
                                            <input type="hidden" name="foodtaste_no[]" value="{{$item->no}}">
                                            <input type="hidden" name="foodtaste_name[]" value="{{$item->name}}">
                                        </td>
                                        <td style="width: 10%">
                                            <select class="form-select" name="foodtaste_qty[]" id="validationCustom04" required>
                                                <option value="0">เลือก</option>
                                                <option value="5">ดีมาก</option>
                                                <option value="4">ดี</option>
                                                <option value="3">พอใช้</option>
                                                <option value="2">ไม่ดี</option>
                                                <option value="1">ต้องปรับปรุง</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="foodtaste_remark[]" id="validationCustom04" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>เสนอแนะรายการอาหารที่อยากรับประทานในมื้อต่อ ๆ ไป</h5>
                        <textarea class="form-control" name="remark"></textarea>
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
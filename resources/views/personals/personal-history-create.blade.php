@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona OPD Create</h4>
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
                <form class="custom-validation" action="{{ route('history.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                <div class="row">
                    <div class="col-3">
                        <input type="date" class="form-control" name="history_date" value="{{old('history_date',date('Y-m-d'))}}" required>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="personal_id" id="personalSelect" required>
                            <option value="">Persona List</option>
                            @foreach($emp as $emps)
                            <option value="{{ $emps->id }}">ชื่อ - นามสกุล : {{ $emps->personal_name }} ประเภท : {{ $emps->personal_type }} กลุ่ม : {{ $emps->personal_sub }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="status_id" required>
                            <option value="">Status</option>
                            @foreach($sta as $stas)
                            <option value="{{ $stas->id }}">{{ $stas->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <h4 class="card-title">สัญญาณชีพ</h4>
                    </div>
                    <div class="col-3">
                        <label class="form-label">อุณหภูมิกาย (องศาเซลเซียส)</label>
                        <input class="form-control" name="temperature" id="temperature">                       
                    </div>
                    <div class="col-3">
                        <label class="form-label">ชีพจร (ครั้ง/นาที)</label>
                        <input class="form-control" name="pulse" id="pulse">                       
                    </div>
                    <div class="col-3">
                        <label class="form-label">หายใจ (ครั้ง/นาที)</label>
                        <input class="form-control" name="breathe" id="breathe">                       
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <label class="form-label">ความดันโลหิต</label>
                        <input class="form-control" name="pressure" id="pressure">
                    </div>
                    <div class="col-3">
                        <label class="form-label">มม.ปรอท</label>
                        <input class="form-control" name="mercury" id="mercury">
                    </div>
                    <div class="col-3">
                        <label class="form-label">ระดับความปวด (คะแนน)</label>
                        <input class="form-control" name="pain" id="pain">
                    </div>
                    <div class="col-12">
                        <label class="form-label">อาการสำคัญ</label>
                        <textarea class="form-control" name="serious_lllness" id="serious_lllness"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">ประวัติการเจ็บป่วยปัจจุบัน</label>
                        <textarea class="form-control" name="serious_lnjury" id="serious_lnjury"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การตรวจร่างกาย</label>
                        <textarea class="form-control" name="previous_surgery" id="previous_surgery"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การวินิจฉัย</label>
                        <textarea class="form-control" name="diagnosis" id="diagnosis"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">การรักษา</label>
                        <textarea class="form-control" name="treatment" id="treatment"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="mt-4">
                        <h5 class="font-size-14 mb-4">ลักษณะ</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nature" id="formRadios1" checked="">
                                    <label class="form-check-label" for="formRadios1">
                                        บาดเจ็บ
                                    </label>
                                </div>                               
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="nature" id="formRadios2">
                                    <label class="form-check-label" for="formRadios2">
                                        ป่วย
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="mt-4">
                        <h5 class="font-size-14 mb-4">ระดับความรุนแรง</h5>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="severity" id="formRadios1" checked="">
                                    <label class="form-check-label" for="formRadios1">
                                        รับบริการทางการแพทย์
                                    </label>
                                </div>                               
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="severity" id="formRadios2">
                                    <label class="form-check-label" for="formRadios2">
                                       ขาดซ้อม/ไม่พร้อมแข่ง
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="severity" id="formRadios3">
                                    <label class="form-check-label" for="formRadios3">
                                       เจ็บป่วยรุนแรง
                                    </label>
                                </div>
                            </div>
                        </div>
                        
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
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body"> 
                <div class="table-responsive">
                    <table class="table table-bordered border-primary mb-0 text-center">
                        <thead class="table-light">
                        <tr>
                            <th>สถานะ</th>
                            <th>วันที่</th>
                            <th>อาการสำคัญ</th>
                            <th>ประวัติการเจ็บป่วยปัจจุบัน</th>
                            <th>การตรวจร่างกาย</th>
                            <th>ผู้บันทึก</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="historyList">
                        <tr><td colspan="6">กรุณาเลือกบุคคล</td></tr>
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
   document.getElementById("personalSelect").addEventListener("change", function () {
    let personalId = this.value;
    if (!personalId) return;
    fetch(`/personal-history/${personalId}`)
        .then(response => response.json())
        .then(data => {
            let historyList = document.getElementById("historyList");
            historyList.innerHTML = ""; // เคลียร์ข้อมูลเก่า

            if (data.length > 0) {
                data.forEach(item => {
                    let row = `<tr>
                        <td>${item.status_name}</td>
                        <td>${item.history_date}</td>
                        <td>${item.serious_lllness || "-"}</td>
                        <td>${item.serious_lnjury || "-"}</td>
                        <td>${item.previous_surgery || "-"}</td>
                        <td>${item.person_at}</td>
                        <td>
                            <a href="/history/${item.id}/edit" class="btn btn-sm btn-warning">อัพเดท</a>
                        </td>
                    </tr>`;
                    historyList.innerHTML += row;
                });
            } else {
                historyList.innerHTML = `<tr><td colspan="6">ไม่มีข้อมูล</td></tr>`;
            }
        })
        .catch(error => console.error("Error:", error));
});
</script>
@endpush
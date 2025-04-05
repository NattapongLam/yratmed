@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">สุขภาพจิต</h4>
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
            <div class="card-body" style="background-color: #e6e6ff">
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
                <form class="custom-validation" action="{{ route('health.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf        
                    <div class="row">
                        <center>
                            <h5 style="color: red;">
                                แบบประเมินความเครียดกรมสุขภาพจิต (ST - 5)<br>
                                คำชี้แจง ประเมินตนเองโดยให้คะแนน 0–3 ที่ตรงกับความรู้สึกของท่าน<br>
                                คะแนน 0	หมายถึง	แทบไม่มี / คะแนน 1 หมายถึง	เป็นบางครั้ง / คะแนน 2	หมายถึง		บ่อยครั้ง/คะแนน 3 หมายถึง เป็นประจำ
                            </h5>
                        </center>                      
                    </div>
                <div class="row">
                    <div class="col-12">
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4">คำถามที่ 1 มีปัญหาการนอน นอนไม่หลับ หรือนอนมาก</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1" id="formRadios1" value="0" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            แทบไม่มี
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1" id="formRadios2" value="1" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เป็นบางครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1" id="formRadios3" value="2" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            บ่อยครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1" id="formRadios4" value="3" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เป็นประจำ
                                        </label>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4">คำถามที่ 2 มีสมาธิน้อยลง</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2" id="formRadios1" value="0" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            แทบไม่มี
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2" id="formRadios2" value="1" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เป็นบางครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2" id="formRadios3" value="2" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            บ่อยครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2" id="formRadios4" value="3" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เป็นประจำ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4">คำถามที่ 3 หงุดหงิด/กระวนกระวาย/ว้าวุ่นใจ</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3" id="formRadios1" value="0" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            แทบไม่มี
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3" id="formRadios2" value="1" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เป็นบางครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3" id="formRadios3" value="2" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            บ่อยครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3" id="formRadios4" value="3" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เป็นประจำ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4">คำถามที่ 4 รู้สึกเบื่อ เซ็ง</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4" id="formRadios1" value="0" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            แทบไม่มี
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4" id="formRadios2" value="1" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เป็นบางครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4" id="formRadios3" value="2" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            บ่อยครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4" id="formRadios4" value="3" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เป็นประจำ
                                        </label>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14 mb-4">คำถามที่ 5 ไม่อยากพบปะผู้คน</h5>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score5" id="formRadios1" value="0" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            แทบไม่มี
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score5" id="formRadios2" value="1" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เป็นบางครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score5" id="formRadios3" value="2" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            บ่อยครั้ง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score5" id="formRadios4" value="3" onchange="calculateTotal()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เป็นประจำ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <label>คะแนนรวม:</label>
                        <input type="text" id="totalScoreInput" name="total" class="form-control" readonly required>
                    </div>
                </div>
                <div class="row">
                    <label class="form-label">หมายเหตุ</label>
                    <textarea class="form-control" name="remark"></textarea>
                </div>
                <br>   
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">บันทึก</button>                   
                    </div>
                </div>
                </form>
                <div class="row">
                    <center>
                        <h5 style="color: red;">
                            การแปลผล<br>
        คะแนน		0-4		เครียดน้อย
        คะแนน		5-7		เครียดปานกลาง
        คะแนน		8-9		เครียดมาก
        คะแนน		10-15		เครียดมากที่สุด<br>
        หมายเหตุ ระดับความเครียดมากขึ้นไป ถือว่ามีความเสี่ยง
    
                        </h5>
                    </center>                 
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@push('scriptjs')
<script>
function calculateTotal() {
    let total = 0;
    // ค้นหาทุก radio ที่ถูกเลือกและรวมค่า
    document.querySelectorAll('input[type="radio"]:checked').forEach((radio) => {
        total += parseInt(radio.value); // แปลงค่าเป็นตัวเลขและบวกเข้ากับ total
    });
    // แสดงผลรวมใน input
    document.getElementById('totalScoreInput').value = total;
}
</script>
@endpush
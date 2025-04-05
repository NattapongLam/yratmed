@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">OSTRC</h4>
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
                <form class="custom-validation" action="{{ route('ostrc.store') }}" method="POST" enctype="multipart/form-data" validate>
                    @csrf  
                <div class="row">
                    <label class="form-label">หมายเหตุ</label>
                    <textarea class="form-control" name="remark"></textarea>
                </div>
                <hr>
                <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#archive1" role="tab" aria-selected="true">
                            1.ปัญหาข้อหลัง
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive2" role="tab" aria-selected="false" tabindex="-1">
                            2.ปัญหาข้อไหล่
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive3" role="tab" aria-selected="false" tabindex="-1">
                            3.ปัญหาข้อศอก
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive4" role="tab" aria-selected="false" tabindex="-1">
                            4.ปัญหาข้อมือ
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive5" role="tab" aria-selected="false" tabindex="-1">
                            5.ปัญหาข้อสะโพก
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive6" role="tab" aria-selected="false" tabindex="-1">
                            6.ปัญหาข้อเข่า
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive7" role="tab" aria-selected="false" tabindex="-1">
                            7.ปัญหาข้อเท้า
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-4">
                    <div class="tab-pane active show" id="archive1" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อหลังของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุดสำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อหลัง" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติ อื่นๆ ที่ข้อหลังข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อหลังของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_1" id="formRadios1" value="0" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อหลัง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_1" id="formRadios2" value="8" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อหลัง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_1" id="formRadios3" value="17" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อหลัง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_1" id="formRadios4" value="25" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหาข้อหลัง
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อหลังของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_2" id="formRadios1" value="0" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_2" id="formRadios2" value="6" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_2" id="formRadios3" value="13" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_2" id="formRadios4" value="19" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_2" id="formRadios5" value="25" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อหลังของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_3" id="formRadios1" value="0" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_3" id="formRadios2" value="6" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_3" id="formRadios3" value="13" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_3" id="formRadios4" value="19" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_3" id="formRadios5" value="25" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อหลังของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_4" id="formRadios1" value="0" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_4" id="formRadios2" value="8" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_4" id="formRadios3" value="17" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score1_4" id="formRadios4" value="25" onchange="calculateTotal1()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput1" name="score1" class="form-control" readonly required>
                            </div>                                                                                
                        </div>
                    </div>
                    <div class="tab-pane" id="archive2" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อไหล่ของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุด สำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อไหล่" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติ อื่นๆ ที่ข้อไหล่ข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อไหล่ของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_1" id="formRadios1" value="0" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อไหล่
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_1" id="formRadios2" value="8" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อไหล่
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_1" id="formRadios3" value="17" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อไหล่
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_1" id="formRadios4" value="25" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหาข้อไหล่
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อไหล่ของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_2" id="formRadios1" value="0" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_2" id="formRadios2" value="6" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_2" id="formRadios3" value="13" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_2" id="formRadios4" value="19" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_2" id="formRadios5" value="25" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อไหล่ของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_3" id="formRadios1" value="0" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_3" id="formRadios2" value="6" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_3" id="formRadios3" value="13" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_3" id="formRadios4" value="19" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_3" id="formRadios5" value="25" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อไหล่ของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_4" id="formRadios1" value="0" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_4" id="formRadios2" value="8" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_4" id="formRadios3" value="17" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score2_4" id="formRadios4" value="25" onchange="calculateTotal2()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput2" name="score2" class="form-control" readonly required>
                            </div> 
                        </div>
                    </div>
                    <div class="tab-pane" id="archive3" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อศอกของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุด สำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อศอก" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติ อื่นๆ ที่ข้อศอกข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อศอกของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_1" id="formRadios1" value="0" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อศอก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_1" id="formRadios2" value="8" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อศอก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_1" id="formRadios3" value="17" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อศอก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_1" id="formRadios4" value="25" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหา
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อศอกของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_2" id="formRadios1" value="0" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_2" id="formRadios2" value="6" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_2" id="formRadios3" value="13" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_2" id="formRadios4" value="19" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_2" id="formRadios5" value="25" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อศอกของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_3" id="formRadios1" value="0" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_3" id="formRadios2" value="6" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_3" id="formRadios3" value="13" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_3" id="formRadios4" value="19" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_3" id="formRadios5" value="25" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อศอกของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_4" id="formRadios1" value="0" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_4" id="formRadios2" value="8" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_4" id="formRadios3" value="17" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score3_4" id="formRadios4" value="25" onchange="calculateTotal3()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput3" name="score3" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="archive4" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อมือของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุด สำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อมือ" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติ อื่นๆ ที่ข้อมือข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อมือของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_1" id="formRadios1" value="0" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อมือ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_1" id="formRadios2" value="8" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อมือ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_1" id="formRadios3" value="17" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อมือ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_1" id="formRadios4" value="25" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหา
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อมือของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_2" id="formRadios1" value="0" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_2" id="formRadios2" value="6" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_2" id="formRadios3" value="13" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_2" id="formRadios4" value="19" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_2" id="formRadios5" value="25" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อมือของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_3" id="formRadios1" value="0" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_3" id="formRadios2" value="6" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_3" id="formRadios3" value="13" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_3" id="formRadios4" value="19" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_3" id="formRadios5" value="25" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อมือของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_4" id="formRadios1" value="0" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_4" id="formRadios2" value="8" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_4" id="formRadios3" value="17" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score4_4" id="formRadios4" value="25" onchange="calculateTotal4()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput4" name="score4" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="archive5" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อสะโพกของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุดสำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อสะโพก" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติอื่นๆ ที่ข้อสะโพกข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อสะโพกของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_1" id="formRadios1" value="0" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios1">
                                        เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อสะโพก
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_1" id="formRadios2" value="8" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios2">
                                        เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อสะโพก
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_1" id="formRadios3" value="17" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios3">
                                        เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อสะโพก
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_1" id="formRadios4" value="25" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios4">
                                        ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหาข้อสะโพก
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อสะโพกของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_2" id="formRadios1" value="0" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios1">
                                        ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_2" id="formRadios2" value="6" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios2">
                                        การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_2" id="formRadios3" value="13" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios3">
                                        การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_2" id="formRadios4" value="19" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios4">
                                        การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_2" id="formRadios5" value="25" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios5">
                                        ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อสะโพกของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_3" id="formRadios1" value="0" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios1">
                                        ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_3" id="formRadios2" value="6" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios2">
                                        ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_3" id="formRadios3" value="13" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios3">
                                        ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_3" id="formRadios4" value="19" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios4">
                                        ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_3" id="formRadios5" value="25" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios5">
                                        ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อสะโพกของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_4" id="formRadios1" value="0" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios1">
                                        ไม่เจ็บเลย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_4" id="formRadios2" value="8" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios2">
                                        เจ็บเล็กน้อย
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_4" id="formRadios3" value="17" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios3">
                                        เจ็บพอประมาณ
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="score5_4" id="formRadios4" value="25" onchange="calculateTotal5()" required>
                                    <label class="form-check-label" for="formRadios4">
                                        เจ็บมาก
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <label>คะแนนรวม:</label>
                            <input type="text" id="totalScoreInput5" name="score5" class="form-control" readonly required>
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane" id="archive6" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อเข่าของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุดสำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อเข่า" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติอื่นๆ ที่ข้อเข่าข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อเข่าของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_1" id="formRadios1" value="0" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อเข่า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_1" id="formRadios2" value="8" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อเข่า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_1" id="formRadios3" value="17" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อเข่า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_1" id="formRadios4" value="25" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหาข้อเข่า
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อเข่าของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_2" id="formRadios1" value="0" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_2" id="formRadios2" value="6" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_2" id="formRadios3" value="13" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_2" id="formRadios4" value="19" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_2" id="formRadios5" value="25" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อเข่าของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_3" id="formRadios1" value="0" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_3" id="formRadios2" value="6" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_3" id="formRadios3" value="13" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_3" id="formRadios4" value="19" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_3" id="formRadios5" value="25" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อเข่าของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_4" id="formRadios1" value="0" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_4" id="formRadios2" value="8" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_4" id="formRadios3" value="17" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score6_4" id="formRadios4" value="25" onchange="calculateTotal6()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput6" name="score6" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="archive7" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5>กรุณาตอบคำถามทุกข้อ ไม่ว่าข้อเท้าของท่านจะมีปัญหาหรือไม่มีปัญหาก็ตาม โดยเลือกตัวเลือกที่เหมาะสมที่สุดสำหรับท่าน ถ้าหากท่านไม่แน่ใจให้พยายามตอบให้ตรงกับสภาพการณ์ของท่านมากที่สุด</h5>
                                <br>
                                <h5>นิยาม "ปัญหาข้อเท้า" หมายถึง อาการเจ็บปวด ตึงบวม ตึงขัด ความไม่มั่นคงหรือหลวม ข้อขัดหรืออาการผิดปกติอื่นๆ ที่ข้อเท้าข้างใดข้างหนึ่งหรือทั้งสองข้าง</h5>
                                <br>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 1 ใน 7 วันที่ผ่านมา ปัญหาข้อเท้าของท่านทำให้การเข้าร่วมฝึกซ้อมหรือแข่งขันกีฬามีปัญหาหรือไม่</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_1" id="formRadios1" value="0" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            เข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เต็มที่ โดยไม่มีปัญหาข้อเท้า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_1" id="formRadios2" value="8" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้เต็มที่ แต่มีปัญหาข้อเท้า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_1" id="formRadios3" value="17" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เข้าร่วมการฝึกข้อมหรือแข่งกีฬาได้ไม่เต็มที่ เพราะมีปัญหาข้อเท้า
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_1" id="formRadios4" value="25" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งกีฬาได้เลย เพราะมีปัญหาข้อเท้า
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 2 ใน 7 วันที่ผ่านมา ปัญหาข้อเท้าของท่านส่งผลกระทบการฝึกซ้อมหรือแข่งขันมากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_2" id="formRadios1" value="0" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อการฝึกซ้อมหรือแข่งขันเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_2" id="formRadios2" value="6" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            การฝึกซ้อมหรือแข่งขันลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_2" id="formRadios3" value="13" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            การฝึกซ้อมหรือแข่งขันลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_2" id="formRadios4" value="19" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            การฝึกซ้อมหรือแข่งขันลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_2" id="formRadios5" value="25" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมการฝึกซ้อมหรือแข่งขันได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 3 ใน 7 วันที่ผ่านมา ปัญหาข้อเท้าของท่านส่งผลกระทบต่อความสามารถในการเล่นกีฬามากน้อยเพียงใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_3" id="formRadios1" value="0" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่ส่งผลกระทบต่อความสามรถในการเล่นกีฬาเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_3" id="formRadios2" value="6" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            ความสามารถในการเล่นกีฬาลดลงเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_3" id="formRadios3" value="13" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            ความสามารถในการเล่นกีฬาลดลงปานกลาง
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_3" id="formRadios4" value="19" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            ความสามารถในการเล่นกีฬาลดลงอย่างมาก
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_3" id="formRadios5" value="25" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios5">
                                            ไม่สามารถเข้าร่วมความสามารถในการเล่นกีฬาได้เลย
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-4">คำถามที่ 4 ใน 7 วันที่ผ่านมา อาการเจ็บปวดของข้อเท้าของท่านซึ่งเป็นผลมาจากการเข้าร่วมแข่งขันหรือฝึกซ้อม กีฬาอยู่ในระดับใด</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_4" id="formRadios1" value="0" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios1">
                                            ไม่เจ็บเลย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_4" id="formRadios2" value="8" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios2">
                                            เจ็บเล็กน้อย
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_4" id="formRadios3" value="17" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios3">
                                            เจ็บพอประมาณ
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="score7_4" id="formRadios4" value="25" onchange="calculateTotal7()" required>
                                        <label class="form-check-label" for="formRadios4">
                                            เจ็บมาก
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mt-3">
                                <label>คะแนนรวม:</label>
                                <input type="text" id="totalScoreInput7" name="score7" class="form-control" readonly required>
                            </div>
                        </div>
                    </div>
                </div>
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
function calculateTotal1() {
    let total = 0;
    document.querySelectorAll('input[name^="score1_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput1').value = total;
}
function calculateTotal2() {
    let total = 0;
    document.querySelectorAll('input[name^="score2_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput2').value = total;
}
function calculateTotal3() {
    let total = 0;
    document.querySelectorAll('input[name^="score3_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput3').value = total;
}
function calculateTotal4() {
    let total = 0;
    document.querySelectorAll('input[name^="score4_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput4').value = total;
}
function calculateTotal5() {
    let total = 0;
    document.querySelectorAll('input[name^="score5_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput5').value = total;
}
function calculateTotal6() {
    let total = 0;
    document.querySelectorAll('input[name^="score6_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput6').value = total;
}
function calculateTotal7() {
    let total = 0;
    document.querySelectorAll('input[name^="score7_"]:checked').forEach((input) => {
        total += parseInt(input.value);
    });
    document.getElementById('totalScoreInput7').value = total;
}
</script>
@endpush
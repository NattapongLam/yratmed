@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Data Edit</h4>
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
                <form class="custom-validation" action="{{ route('personal.update',$emp->id) }}" method="POST" enctype="multipart/form-data" validate>
                @csrf     
                @method('PUT')   
                <div class="row">
                    <div class="col-4">
                        <label class="form-label">ชื่อ - นามสกุล</label>
                        <input class="form-control" name="personal_name" id="personal_name" value="{{$emp->personal_name}}">
                    </div>
                    <div class="col-4">
                        <label class="form-label">เพศ</label>
                        <select class="form-select" name="personal_sex" id="personal_sex">
                            <option value="{{$emp->personal_sex}}">{{$emp->personal_sex}}</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">ประเภท</label>
                        <select class="form-select" name="personal_type" id="personal_type">
                            <option value="{{$emp->personal_type}}">{{$emp->personal_type}}</option>
                            @foreach ($typ as $item)
                            <option value="{{$item->type_name}}">{{$item->type_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">หน่วยย่อย</label>
                        <select class="form-select" name="personal_sub" id="personal_sub">
                            <option value="{{$emp->personal_sub}}">{{$emp->personal_sub}}</option>
                            @foreach ($sub as $item)
                            <option value="{{$item->sub_name}}">{{$item->sub_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">วันเกิด</label>
                        <input class="form-control" type="date" name="personal_birthday" id="personal_birthday" value="{{$emp->personal_birthday}}">
                    </div>
                    <div class="col-4">
                        @php
                        $birthDate = \Carbon\Carbon::parse($emp->personal_birthday);
                        $now = \Carbon\Carbon::now();
                        $diffYears = $birthDate->diffInYears($now);
                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                        @endphp
                        <label class="form-label">อายุ</label>
                        <input class="form-control" type="text" placeholder="ปี-เดือน-วัน" name="personal_age" id="personal_age" value="{{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน">
                    </div>
                    <div class="col-4">
                        <label class="form-label">เบอร์ติดต่อ</label>
                        <input class="form-control" type="text" name="personal_tel" id="personal_tel" value="{{$emp->personal_tel}}">
                    </div>
                    <div class="col-4">
                        <label class="form-label">ที่อยู่</label>
                        <input class="form-control" type="text" name="personal_address" id="personal_address" value="{{$emp->personal_address}}">
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
                        <input class="form-control" type="text" name="personal_underlying" id="personal_underlying" value="{{$emp->personal_underlying}}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">ข้อมูลแพทย์ปัจจุบัน</label>
                        <textarea class="form-control" rows="3" name="personal_currentmed" id="personal_currentmed">{{$emp->personal_currentmed}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">โรคภูมิแพ้</label>
                        <input class="form-control" type="text" name="personal_allergy" id="personal_allergy" value="{{$emp->personal_allergy}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Serious Illness</label>
                        <textarea class="form-control"  rows="3" name="serious_lllness" id="serious_lllness">{{$emp->serious_lllness}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Serious Injury</label>
                        <textarea class="form-control" rows="3" name="serious_lnjury" id="serious_lnjury">{{$emp->serious_lnjury}}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Previous Surgery</label>
                        <textarea class="form-control"  rows="3" name="previous_surgery" id="previous_surgery">{{$emp->previous_surgery}}</textarea>
                    </div>
                    <hr>
                    <div class="col-6">
                        <div class="square-switch">
                            @if($emp->personal_flag == 1)
                            <input type="checkbox" id="square-switch1" switch="none" name="flag" value="true" checked/>
                            @else
                            <input type="checkbox" id="square-switch1" switch="none" name="flag"/>
                            @endif
                            <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                        </div>
                    </div>
                    <div class="col-6">
                        <img width="100px" src="{{ asset($emp->personal_img)}}">
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
                <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#archive1" role="tab" aria-selected="true">
                            OPD
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive2" role="tab" aria-selected="false" tabindex="-1">
                            OSTRC  
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive3" role="tab" aria-selected="false" tabindex="-1">
                            Lab
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive4" role="tab" aria-selected="false" tabindex="-1">
                            สุขภาพจิต
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-4">
                    <div class="tab-pane active show" id="archive1" role="tabpanel">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0 text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>วันที่</th>
                                            <th>อาการสำคัญ</th>
                                            <th>ประวัติการเจ็บป่วยปัจจุบัน</th>
                                            <th>การตรวจร่างกาย</th>
                                            <th>การวินิจฉัย</th>
                                            <th>การรักษา</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($history as $item)
                                            <tr>
                                                <td>{{Carbon\Carbon::parse($item->history_date)->format('d-m-Y')}}</td>
                                                <td>{{ $item->serious_lllness}}</td>
                                                <td>{{ $item->serious_lnjury}}</td>
                                                <td>{{ $item->previous_surgery}}</td>
                                                <td>{{ $item->diagnosis}}</td>
                                                <td>{{ $item->treatment}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                <tbody>
                                  
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="archive2" role="tabpanel">
                        <div class="row">
                            <div class="table-responsive">
                                @php
                                // จัดกลุ่มข้อมูลตามวัน (รูปแบบ d/m/Y)
                                $groupedData = $joint->groupBy(function($item) {
                                    return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                });                          
                                // สร้างตัวแปรสำหรับเก็บคะแนนรวมแต่ละวัน
                                $totalScores = [];
                                $allJointScores = [];
                                @endphp
                            
                            <table class="table table-bordered border-primary text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>รายละเอียด</th>
                                        @foreach ($groupedData as $date => $items)
                                            <th>{{ $date }}</th>
                                        @endforeach
                                        {{-- <th>รวม</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($joint->groupBy('joint_name') as $jointName => $items)
                                        <tr>
                                            <td>{{ $jointName }}</td>
                                            @php $sumRow = 0; @endphp
                                            @foreach ($groupedData as $date => $dateItems)
                                                @php
                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
                                                    $sumRow += $score;
                                                    $totalScores[$date] = ($totalScores[$date] ?? 0) + $score;
                            
                                                    // บันทึกค่าคะแนนแต่ละประเภท
                                                    $allJointScores[$jointName][$date] = $score;
                                                @endphp
                                                <td>
                                                    @if ($score <= 24)
                                                    <span class="badge bg-success"> {{ $score }}</span>
                                                @elseif ($score <= 49) 
                                                    <span class="badge bg-warning"> {{ $score }}</span>
                                                @else
                                                    <span class="badge bg-danger"> {{ $score }}</span>
                                                @endif                                                   
                                                </td>
                                            @endforeach
                                            {{-- <td><strong>{{ $sumRow }}</strong></td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tfoot class="table-light">
                                    <tr>
                                        <td><strong>รวม</strong></td>
                                        @foreach ($groupedData as $date => $items)
                                            <td><strong>{{ $totalScores[$date] }}</strong></td>
                                        @endforeach
                                        <td><strong>{{ array_sum($totalScores) }}</strong></td>
                                    </tr>
                                </tfoot> --}}
                            </table>
                        </div>
                        <!-- กราฟ Line Chart -->
                        <canvas id="scoreChart"></canvas>
                        <h4 class="card-title" style="color: red">
                            เฝ้ารหัสผลประเมิน
                        </h4>
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>วันที่</th>
                                    <th>รายละเอียด</th>
                                    <th>หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subs as $item)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                        <td>{{$item->sub_name}} คำถามที่ {{$item->sub_no}}</td>
                                        <td>{{$item->sub_remark}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="archive3" role="tabpanel">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>BH (cm.)</th>
                                        <th>BW (kg.)</th>
                                        <th>BMI (kg./m2)</th>
                                        <th>RBC (3.8-5.3*M)</th>
                                        <th>Hb (12-16 g/dL)</th>
                                        <th>Hct (36-47%)</th>
                                        <th>MCV (80-100) fL</th>
                                        <th>MCH (27-32) pg</th>
                                        <th>MCHC (32-36) g/dL</th>
                                        <th>RDW (10-16.5) %</th>
                                        <th>WBC (4,000-10,000)</th>
                                        <th>PLT (4,000-10,000)</th>
                                        <th>ferritin (13-150 ng/mL)</th>
                                        <th>CPK (29 - 168 U/L)</th>
                                        <th>Blood Sugar (70-140 mg/dL)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($labs as $item)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($item->lap_date)->format('d-m-Y')}}</td>
                                        <td>{{$item->bh}}</td>
                                        <td>{{$item->bw}}</td>
                                        <td>{{$item->bmi}}</td>
                                        <td>{{$item->rbc}}</td>
                                        <td>{{$item->hb}}</td>
                                        <td>{{$item->hct}}</td>
                                        <td>{{$item->mvc}}</td>
                                        <td>{{$item->mch}}</td>
                                        <td>{{$item->mchc}}</td>
                                        <td>{{$item->rdw}}</td>
                                        <td>{{$item->wbc}}</td>
                                        <td>{{$item->plt}}</td>
                                        <td>{{$item->ferritin}}</td>
                                        <td>{{$item->cpk}}</td>
                                        <td>{{$item->bloodsugar}}</td>
                                    </tr>
                                    @endforeach                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="archive4" role="tabpanel">
                    <table class="table table-bordered border-primary text-center">
                        <thead class="table-light">
                            <tr>
                                <th>วันที่ประเมิน</th>
                                <th>ผลประเมิน</th>
                                <th>หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($healt as $item)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i')}}</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->remark}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                        // เตรียมข้อมูลสำหรับ Bar Chart
                        $labels = $healt->pluck('created_at')->map(function($date) {
                            return Carbon\Carbon::parse($date)->format('d-m-Y H:i');
                        });
                        $data = $healt->pluck('total');
                    @endphp
                    <canvas id="barChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>    
</div>  
@endsection
@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
      document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('scoreChart').getContext('2d');

        // กำหนดข้อมูลวัน (labels)
        const labels = {!! json_encode(array_keys($totalScores)) !!};

        // กำหนดข้อมูลคะแนนของแต่ละประเภท
        const jointScores = {!! json_encode($allJointScores) !!};

        const datasets = Object.keys(jointScores).map(jointName => {
            return {
                label: jointName,
                data: labels.map(date => jointScores[jointName][date] ?? 0),
                borderColor: getRandomColor(),
                fill: false,
            };
        });

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'วันที่'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'คะแนน'
                        },
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                        stepSize: 25,
                        color: '#FF0000'  // สีของตัวเลขแกน Y (ตัวอย่าง: สีแดง)
                        },
                        grid: {
                        color: '#CCCCCC'  // สีของเส้น grid (ตัวอย่าง: สีเทา)
                        }
                    }
                }
            }
        });

        function getRandomColor() {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`;
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('barChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!}, // วันที่ประเมิน
            datasets: [{
                label: 'ผลประเมิน',
                data: {!! json_encode($data) !!}, // ผลประเมิน (Total)
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // สีของแท่งกราฟ
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 15,
                    ticks: {
                        stepSize: 5
                    }
                }
            }
        }
    });
});
</script>
@endpush
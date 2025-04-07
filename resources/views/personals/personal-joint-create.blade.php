@extends('layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Severity Score OSTRC</h4>
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
                <form class="custom-validation" action="{{ route('joint.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                <div class="row">
                    <div class="col-6">
                        <select class="form-select" name="personal_id" id="personalSelect" required>
                            <option value="">เลือกบุคคล</option>
                            @foreach($emp as $emps)
                            <option value="{{ $emps->id }}">ชื่อ - นามสกุล : {{ $emps->personal_name }} ประเภท : {{ $emps->personal_type }} กลุ่ม : {{ $emps->personal_sub }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>รายละเอียด</th>
                                    <th>คะแนน</th>
                                    <th>หมายเหตุ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($joint as $item)
                                    <tr>
                                        <td>
                                            {{ $item->joint_name }}
                                            <input type="hidden" name="joint_id[]" value="{{ $item->id }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control joint-score" name="joint_score[]" value="{{old('joint_score',0)}}" required>
                                        </td>     
                                        <td>
                                            <input type="text" class="form-control" name="joint_remark[]">
                                        </td>                             
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <hr>
                        <h5 style="color: red">คะแนนรวม: <span id="totalScore">0</span></h5>
                        <br>
                        <button type="submit" class="btn btn-primary">บันทึก</button>                        
                    </div> 
                    <div class="col-6">
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr id="dateHeader">
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody id="scoreTable">
                                <tr>
                                    <td colspan="99">กรุณาเลือกบุคคล</td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                                <tr id="totalRow">
                                    <th>รวม</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
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
            <div class="card-body text-center">   
                <canvas id="scoreChart"></canvas>
            </div>
        </div>
    </div>
</div>         
@endsection
@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('#personalSelect').select2();
});
    document.addEventListener("DOMContentLoaded", function () {
        const inputs = document.querySelectorAll(".joint-score");
        const totalScoreSpan = document.getElementById("totalScore");

        function updateTotalScore() {
            let total = 0;
            inputs.forEach(input => {
                total += Number(input.value) || 0; // ถ้าค่าว่างให้เป็น 0
            });
            totalScoreSpan.textContent = total; // อัปเดตคะแนนรวม
        }

        inputs.forEach(input => {
            input.addEventListener("input", updateTotalScore);
        });
    });
    document.getElementById("personalSelect").addEventListener("change", function () {
        let personalId = this.value;
        if (!personalId) return;

        fetch(`/personal-joint/${personalId}`)
        .then(response => response.json())
        .then(data => {
            let dateHeader = document.getElementById("dateHeader");
            let scoreTable = document.getElementById("scoreTable");
            let totalRow = document.getElementById("totalRow");

            // เคลียร์ตารางก่อน
            dateHeader.innerHTML = "<th>รายละเอียด</th>";
            scoreTable.innerHTML = "";
            totalRow.innerHTML = "<th>รวม</th>";

            if (data.length > 0) {
                // ✅ แปลงวันที่เป็น "วัน/เดือน/ปี"
                let uniqueDates = [...new Set(data.map(item => 
                    new Date(item.created_at).toLocaleDateString("th-TH", {
                        year: "numeric", month: "2-digit", day: "2-digit"
                    })
                ))];

                uniqueDates.forEach(date => {
                    let th = document.createElement("th");
                    th.textContent = date;
                    dateHeader.appendChild(th);

                    let thTotal = document.createElement("th");
                    thTotal.setAttribute("id", `total-${date}`);
                    thTotal.textContent = "0"; // ค่าเริ่มต้นเป็น 0
                    totalRow.appendChild(thTotal);
                });

                // เพิ่มข้อมูลคะแนน
                let jointNames = [...new Set(data.map(item => item.joint_name))];
                let totals = {}; // เก็บผลรวมคะแนนแต่ละวัน

                jointNames.forEach(joint => {
                    let tr = document.createElement("tr");
                    let tdName = document.createElement("td");
                    tdName.textContent = joint;
                    tr.appendChild(tdName);

                    uniqueDates.forEach(date => {
                        let tdScore = document.createElement("td");
                        let score = data.find(item => 
                            item.joint_name === joint && 
                            new Date(item.created_at).toLocaleDateString("th-TH", {
                                year: "numeric", month: "2-digit", day: "2-digit"
                            }) === date
                        )?.score || 0;

                        tdScore.textContent = score;
                        tr.appendChild(tdScore);

                        // ✅ คำนวณผลรวมของแต่ละวัน
                        totals[date] = (totals[date] || 0) + parseInt(score);
                    });

                    scoreTable.appendChild(tr);
                });

                // ✅ ใส่ค่าผลรวมลงใน <tfoot>
                uniqueDates.forEach(date => {
                    document.getElementById(`total-${date}`).textContent = totals[date] || 0;
                });
            } else {
                scoreTable.innerHTML = "<tr><td colspan='99'>ไม่มีข้อมูล</td></tr>";
            }
        })
        .catch(error => console.error("Error:", error));
    });
    document.getElementById("personalSelect").addEventListener("change", function () {
    let personalId = this.value;
    if (!personalId) return;

    fetch(`/personal-joint/${personalId}`)
        .then(response => response.json())
        .then(data => {
            let uniqueDates = [...new Set(data.map(item => 
                new Date(item.created_at).toLocaleDateString("th-TH", {
                    year: "numeric", month: "2-digit", day: "2-digit"
                })
            ))];

            let totals = {}; // เก็บผลรวมคะแนนแต่ละวัน
            uniqueDates.forEach(date => totals[date] = 0);

            data.forEach(item => {
                let date = new Date(item.created_at).toLocaleDateString("th-TH", {
                    year: "numeric", month: "2-digit", day: "2-digit"
                });
                totals[date] += parseInt(item.score);
            });

            let chartData = {
                labels: uniqueDates,
                datasets: [{
                    label: "คะแนนรวมต่อวัน",
                    data: uniqueDates.map(date => totals[date]),
                    borderColor: "blue",
                    backgroundColor: "rgba(0, 0, 255, 0.1)",
                    borderWidth: 2,
                    tension: 0.2
                }]
            };

            updateChart(chartData);
        })
        .catch(error => console.error("Error:", error));
});

let scoreChart;
function updateChart(chartData) {
    let ctx = document.getElementById("scoreChart").getContext("2d");
    if (scoreChart) scoreChart.destroy(); // ลบกราฟเก่า
    
    scoreChart = new Chart(ctx, {
        type: "line",
        data: chartData,
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: {
                x: { title: { display: true, text: "วันที่" } },
                y: { title: { display: true, text: "คะแนน" }, beginAtZero: true }
            }
        }
    });
}
</script>
@endpush
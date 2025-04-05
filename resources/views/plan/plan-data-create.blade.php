@extends('layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plan Data Create</h4>
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
                <form class="custom-validation" action="{{ route('plan.store') }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                <div class="row">
                    <div class="col-2">
                        <label class="form-label">Date</label>
                        <input class="form-control" type="date" name="plan_date" id="plan_date" value="{{old('plan_date',date('Y-m-d'))}}" required><br>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                    <div class="col-10">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="plan_remark" id="plan_remark" rows="3" required></textarea>
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
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>        
@endsection
@push('scriptjs')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales/th.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let calendarEl = document.getElementById("calendar");
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        locale: "th",
        events: "/api/get-plans", // ดึงข้อมูลจาก API
        eventDidMount: function (info) {
            let tooltip = new bootstrap.Tooltip(info.el, {
                title: `<b>สถานะ:</b> ${info.event.title}<br><b>รายละเอียด:</b> ${info.event.extendedProps.remark}`,
                html: true,
                placement: "top"
            });
        },
        eventClick: function (info) {
            window.location.href = info.event.url; // ลิงก์ไปหน้าแก้ไข
        }
    });
    calendar.render();
});
</script>
@endpush

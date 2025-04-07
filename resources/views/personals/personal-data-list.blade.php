@extends('layouts.main')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Data List</h4>
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
                <h4 class="card-title">
                    <a href="{{ route('personal.create')}}">
                    Created
                    </a>
                </h4><hr>
                <div class="row">
                    <div class="table-responsive">
                        <table id="empTable" class="table table-bordered border-primary mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>เพศ</th>
                                <th>ประเภท</th>
                                <th>หน่วยย่อย</th>
                                <th>แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($emp as $item)
                                <tr>
                                    <td><img width="70px" src="{{ asset($item->personal_img)}}"></td>
                                    <td>
                                        @php
                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                        $now = \Carbon\Carbon::now();
                                        $diffYears = $birthDate->diffInYears($now);
                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                        @endphp
                                        {{$item->personal_name}}<br>
                                        วันเกิด : {{Carbon\Carbon::parse($item->personal_birthday)->format('d-m-Y')}}<br>
                                        อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                    </td>
                                    <td>{{$item->personal_sex }}</td>
                                    <td>{{$item->personal_type }}</td>
                                    <td>
                                        {{$item->personal_sub }}<br>
                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}<br>
                                        (ID:{{$item->id }})
                                    </td>
                                    <td>
                                        <a href="{{route('personal.edit',$item->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>                          
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>         
@endsection
@push('scriptjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
      $(document).ready(function () {
        $('#empTable').DataTable({
            language: {
                "search": "ค้นหา:",
                "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
            }
        });
    });
</script>
@endpush
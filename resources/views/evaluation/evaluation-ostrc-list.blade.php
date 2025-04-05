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
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('ostrc.create')}}">
                    ทำแบบประเมิน
                    </a>
                </h4><hr>   
                <div class="table-responsive">
                    <table class="table table-bordered border-primary mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>วันที่</th>
                                <th>หมายเหตุ</th>
                                <th>ข้อหลัง</th>
                                <th>ข้อไหล่</th>
                                <th>ข้อศอก</th>
                                <th>ข้อมือ</th>
                                <th>ข้อสะโพก</th>
                                <th>ข้อเข่า</th>
                                <th>ข้อเท้า</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                        <td>{{$item->remark}}</td>
                                        <td>{{$item->score1}}</td>
                                        <td>{{$item->score2}}</td>
                                        <td>{{$item->score3}}</td>
                                        <td>{{$item->score4}}</td>
                                        <td>{{$item->score5}}</td>
                                        <td>{{$item->score6}}</td>
                                        <td>{{$item->score7}}</td>
                                    </tr>
                                @endforeach
                            </tr>
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
</script>
@endpush
@extends('layouts.main')
@section('content')
<style>
    .chart-container {
        width: 80%;
        margin: 30px auto;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Severity Score OSTRC</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
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
                <ul class="nav nav-tabs nav-tabs-custom justify-content-center pt-2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#archive1" role="tab" aria-selected="true">
                            Optimist ชาย
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive2" role="tab" aria-selected="false" tabindex="-1">
                            Optimist หญิง
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive3" role="tab" aria-selected="false" tabindex="-1">
                            ILCA 4 ชาย
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive4" role="tab" aria-selected="false" tabindex="-1">
                            ILCA 4 หญิง
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive5" role="tab" aria-selected="false" tabindex="-1">
                            ILCA 6
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive6" role="tab" aria-selected="false" tabindex="-1">
                            ILCA 7
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#archive7" role="tab" aria-selected="false" tabindex="-1">
                            470
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-4">
                    <div class="tab-pane active show" id="archive1" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท Optimist ชาย</h2>
                        @foreach($emp1 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart1-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp1 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive2" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท Optimist หญิง</h2>
                        @foreach($emp2 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart2-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp2 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive3" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท ILCA 4 ชาย</h2>
                        @foreach($emp3 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart3-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp3 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive4" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท ILCA 4 หญิง</h2>
                        @foreach($emp4 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart4-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp4 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive5" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท ILCA 6</h2>
                        @foreach($emp5 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart5-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp5 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive6" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท ILCA 7</h2>
                        @foreach($emp6 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart6-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp6 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="tab-pane" id="archive7" role="tabpanel">
                        <h2 style="text-align: center;">กราฟแยกตามประเภท 470</h2>
                        @foreach($emp7 as $item)
                        @php
                          // หาข้อมูลกราฟสำหรับ personal_id นี้จากตัวแปร $charts
                          $chart = collect($charts)->firstWhere('personalId', $item->id);
                        @endphp                   
                        @if($chart)
                          <div class="chart-container">
                            <img src="{{ asset($item->personal_img)}}" alt="" width="70px">
                            <h5>{{ $item->name }} ({{ $item->personal_name }}/{{$item->personal_sub}} {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}})</h5>
                            <canvas id="chart7-{{ $item->id }}" width="400" height="200"></canvas>
                          </div>
                        @endif
                        @endforeach
                        <div class="row">      
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap align-middle mb-0">
                                            <tbody>
                                                @foreach ($emp7 as $item)
                                                    @php
                                                        $birthDate = \Carbon\Carbon::parse($item->personal_birthday);
                                                        $now = \Carbon\Carbon::now();
                                                        $diffYears = $birthDate->diffInYears($now);
                                                        $diffMonths = $birthDate->copy()->addYears($diffYears)->diffInMonths($now);
                                                        $diffDays = $birthDate->copy()->addYears($diffYears)->addMonths($diffMonths)->diffInDays($now);
                                            
                                                        // กรองเฉพาะข้อมูลของบุคคลนี้
                                                        $personalJoint = $joint->where('personal_id', $item->id);
                                            
                                                        // จัดกลุ่มข้อมูลตามวัน
                                                        $groupedData = $personalJoint->groupBy(function($item) {
                                                            return \Carbon\Carbon::parse($item->created_at)->format('d/m/Y');
                                                        });                                       
                                                        $allJointScores = [];  
                                                    @endphp                                   
                                                    <tr>
                                                        <td>
                                                            <div class="avatar-group">
                                                                <div class="avatar-group-item">
                                                                    <a href="{{route('personal.edit',$item->id)}}" class="d-inline-block">
                                                                        <img src="{{ asset($item->personal_img)}}" alt="" class="rounded-circle avatar-xs">
                                                                    </a>
                                                                </div>                                                
                                                            </div>
                                                            <h5 class="text-truncate font-size-14 m-0">
                                                                <a href="{{route('personal.edit',$item->id)}}" class="text-dark">
                                                                    {{$item->personal_name}}<br>
                                                                    อายุ : {{ $diffYears }} ปี {{ $diffMonths }} เดือน {{ $diffDays }} วัน
                                                                </a>
                                                            </h5>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                @if ($item->personal_sub == "ตัวจริง")
                                                                    <span class="badge rounded-pill badge-soft-danger font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @else
                                                                    <span class="badge rounded-pill badge-soft-success font-size-11">
                                                                        {{$item->personal_sub}}<br>
                                                                        {{Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i')}}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>                                          
                                                    @if ($personalJoint->isNotEmpty())
                                                    <tr>
                                                        <td colspan="2">
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
                                                                    @foreach ($personalJoint->groupBy('joint_name') as $jointName => $items)
                                                                        <tr>
                                                                            <td>{{ $jointName }}</td>
                                                                            @foreach ($groupedData as $date => $dateItems)
                                                                                @php
                                                                                    $score = $dateItems->where('joint_name', $jointName)->sum('score');
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
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                      
                        </div>
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
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp1)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart1-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp2)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart2-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp3)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart3-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp4)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart4-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp5)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart5-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp6)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart6-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
  document.addEventListener('DOMContentLoaded', function(){
    // สำหรับแต่ละกราฟที่มีอยู่ใน charts
    @foreach($charts as $chart)
      // ตรวจสอบว่ากราฟที่ได้ตรงกับ personal_id ที่อยู่ใน emp1 หรือไม่
      @if(collect($emp7)->pluck('id')->contains($chart['personalId']))
        var ctx{{ $chart['personalId'] }} = document.getElementById('chart7-{{ $chart['personalId'] }}').getContext('2d');
        new Chart(ctx{{ $chart['personalId'] }}, {
          type: 'line',
          data: {
            labels: {!! json_encode($chart['labels']) !!},
            datasets: {!! json_encode($chart['datasets']) !!}
          },
          options: {
            responsive: true,
            plugins: {
              legend: { position: 'top' }
            },
            scales: { 
              y: { 
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
      @endif
    @endforeach
  });
</script>
@endpush
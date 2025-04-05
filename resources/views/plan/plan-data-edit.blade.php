@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plan Data Edit</h4>
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
                <h4 class="card-title" style="color: red">Plan</h4>
                <form class="custom-validation" action="{{ route('plan.update',$plan->id) }}" method="POST" enctype="multipart/form-data" validate>
                @csrf       
                @method('PUT') 
                <div class="row">
                    <div class="col-2">
                        <label class="form-label">Date</label>
                        <input class="form-control" type="date" name="plan_date" id="plan_date" value="{{$plan->plan_date}}" required><br>
                        <div class="square-switch">
                            @if($plan->flag == 1)
                            <input type="checkbox" id="square-switch1" switch="none" name="flag" value="true" checked/>
                            @else
                            <input type="checkbox" id="square-switch1" switch="none" name="flag"/>
                            @endif
                            <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                    <div class="col-10">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="plan_remark" id="plan_remark" rows="5" required>{{$plan->plan_remark}}</textarea>
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
                <h4 class="card-title" style="color: red">Do</h4>
                @foreach ($subdo as $item)
                <div class="row">
                    <div class="col-12">
                        <h5>{{Carbon\Carbon::parse($item->sub_date)->format('d-m-Y H:i')}} ({{$item->plan_type}}) / {{$item->person_at}}</h5><br>
                        <h5>{{$item->sub_remark }}</h5>
                    </div>                   
                </div>
                @endforeach
                <hr>
                <div class="row">
                    <div class="col-12">
                    <a href="{{route('plan-do.edit',$plan->id)}}" class="btn btn-info">อัพเดท</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body"> 
                <h4 class="card-title" style="color: red">Check</h4>
                @foreach ($subcheck as $item)
                <div class="row">
                    <div class="col-12">
                        <h5>{{Carbon\Carbon::parse($item->sub_date)->format('d-m-Y H:i')}} ({{$item->plan_type}}) / {{$item->person_at}}</h5><br>
                        <h5>{{$item->sub_remark }}</h5>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="row">
                    <div class="col-12">
                    <a href="{{route('plan-check.edit',$plan->id)}}" class="btn btn-info">อัพเดท</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body"> 
                <h4 class="card-title" style="color: red">Action</h4>
                @foreach ($subaction as $item)
                <div class="row">
                    <div class="col-12">
                        <h5>{{Carbon\Carbon::parse($item->sub_date)->format('d-m-Y H:i')}} ({{$item->plan_type}}) / {{$item->person_at}}</h5><br>
                        <h5>{{$item->sub_remark }}</h5>
                    </div>
                </div>
                @endforeach
                <hr>
                <div class="row">
                    <div class="col-12">
                    <a href="{{route('plan-action.edit',$plan->id)}}" class="btn btn-info">อัพเดท</a>
                    </div>
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

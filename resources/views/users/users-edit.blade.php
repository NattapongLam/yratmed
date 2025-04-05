@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Users</h4>
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
                <form class="custom-validation" action="{{ route('permissions.update',$emp->id) }}" method="POST" enctype="multipart/form-data" validate>
                    @csrf     
                    @method('PUT')   
                <div class="row">       
                    <div class="col-4">
                        <label class="form-label">Fullname</label>
                        <input class="form-control" name="name" type="text" value="{{$emp->name}}" readonly>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Email</label>
                        <input class="form-control" name="email" type="email" value="{{$emp->email}}" readonly>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" id="role">
                            <option value="">กรุณาเลือก</option>
                            @foreach ($roles as $item)
                            <option value="{{$item->name}}" @if($emp->hasRole($item->name)) selected @endif>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    @foreach ($permissions as $key => $item)
                    <div class="col-3">
                        <div class="form-group">
                            <div class="form-check form-check-primary mb-3">
                                <input class="form-check-input" type="checkbox" id="formCheck{{$item->id}}" value="{{$item->name}}" name="permission[{{$item->$key}}]"  @if($emp->hasPermissionTo($item->name)) checked @endif>
                                <label class="form-check-label" for="formCheck{{$item->id}}">
                                    {{$item->name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>         
@endsection
@push('scriptjs')
@endpush
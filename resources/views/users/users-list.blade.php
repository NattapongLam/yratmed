@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Users List</h4>
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
                <div class="row">       
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Email</th>
                                    <th>Fullname</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emp as $item)
                                    <tr>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <a href="{{route('permissions.edit',$item->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
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
@endpush
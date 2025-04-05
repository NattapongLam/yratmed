@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Type List</h4>
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
                    <div class="col-6">
                        <form action="{{ route('types.update',$type->id) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <label class="form-label">ชื่อประเภท</label>
                        <input class="form-control" name="type_name" value="{{$type->type_name}}"><br>
                        <div class="square-switch">
                            @if($type->flag == 1)
                            <input type="checkbox" id="square-switch1" switch="none" name="flag" value="true" checked/>
                            @else
                            <input type="checkbox" id="square-switch1" switch="none" name="flag"/>
                            @endif
                            <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>   
                    <div class="col-6">
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>สถานะ</th>
                                    <th>ชื่อประเภท</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $item)
                                    <tr>
                                        <td>
                                            @if($item->flag == 1)
                                                <span class="badge bg-success">ใช้งาน</span>
                                            @else
                                                <span class="badge bg-danger">ยกเลิก</span>
                                             @endif                                           
                                        </td>   
                                        <td>{{$item->type_name}}</td>  
                                        <td>    
                                            <a href="{{ route('types.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>         
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
</div>         
@endsection
@push('scriptjs')
@endpush
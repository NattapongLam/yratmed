@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Persona Sub List</h4>
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
                        <form class="custom-validation" action="{{ route('subs.store') }}" method="POST" enctype="multipart/form-data" validate>
                        @csrf
                        <label class="form-label">ชื่อกลุ่มย่อย</label>
                        <input class="form-control" name="sub_name"><br>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                        </form>
                    </div>   
                    <div class="col-6">
                        <div class="table-responsive">
                        <table class="table table-bordered border-primary mb-0 text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>สถานะ</th>
                                    <th>ชื่อกลุ่มย่อย</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub as $item)
                                    <tr>
                                        <td>
                                            @if($item->flag == 1)
                                                <span class="badge bg-success">ใช้งาน</span>
                                            @else
                                                <span class="badge bg-danger">ยกเลิก</span>
                                             @endif                                           
                                        </td>   
                                        <td>{{$item->sub_name}}</td>  
                                        <td>    
                                            <a href="{{ route('subs.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>         
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
@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Plan Do Update</h4>
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
                <form class="custom-validation" action="{{ route('plan-do.store') }}" method="POST" enctype="multipart/form-data" validate>
                    @csrf   
                <div class="row">  
                    <div class="col-3">
                       <input type="date" class="form-control" value="{{$plan->plan_date}}" readonly>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" value="{{$plan->person_at}}" readonly>
                    </div>
                    <div class="col-3">
                        <input type="datetime-local" class="form-control" name="sub_date" id="sub_date" required>
                        <input type="hidden" name="plan_id" value="{{$plan->id}}">
                        <input type="hidden" name="plan_sub" value="Do">
                    </div> 
                    <div class="col-3">
                        <label class="form-label">การดำเนินการ</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="plan_type" id="inlineRadio1" value="Onsite">
                            <label class="form-check-label" for="inlineRadio1">Onsite</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="plan_type" id="inlineRadio2" value="Online">
                            <label class="form-check-label" for="inlineRadio2">Online</label>
                        </div>                                                          
                    </div>                                                       
                </div><br>
                <div class="row">
                    <div class="col-12">
                        <textarea class="form-control" rows="5" readonly>{{$plan->plan_remark}}</textarea>
                    </div><hr>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered border-primary mb-0 text-center">
                                <thead class="table-light">
                                    <tr></tr>
                                        <th>วัน - เวลา</th>
                                        <th>รายละเอียด</th>
                                        <th>ผู้บันทึก</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub as $item)
                                        <tr>
                                            <td>{{Carbon\Carbon::parse($item->sub_date)->format('d-m-Y H:i')}} ({{$item->plan_type}})</td>
                                            <td>{{$item->sub_remark}}</td>
                                            <td>{{$item->person_at}} ({{$item->plan_sub}})</td>
                                            <td>
                                                <a href="#" class="btn btn-danger delete-btn" data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>                                         
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>
                <div class="row">                    
                    <div class="col-12">
                        <label class="form-label">รายละเอียด</label>
                        <textarea class="form-control" rows="5" name="sub_remark" id="sub_remark" required></textarea>
                    </div>  
                </div><hr>
                <div class="row">                    
                    <button type="submit" class="btn btn-primary">บันทึก</button> 
                </div>
                </form>
            </div>
        </div>
    </div>
</div>         
@endsection
@push('scriptjs')
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            let itemId = this.getAttribute('data-id');
            if (confirm("คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?")) {
                fetch(`/plan-do/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("ลบข้อมูลสำเร็จ!");
                        location.reload(); // รีเฟรชหน้าเว็บ
                    } else {
                        alert("เกิดข้อผิดพลาด: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
</script>
@endpush
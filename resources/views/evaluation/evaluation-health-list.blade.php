@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">สุขภาพจิต</h4>
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
                    <a href="{{ route('health.create')}}">
                    ทำแบบประเมิน
                    </a>
                </h4>
                <hr>  
                <div class="row">
                    <center>
                        <h5 style="color: red">
                            คำแนะนำ<br>
                            1. เครียดน้อย เป็นความเครียดในชีวิตประจำวัน ซึ่งแต่ละคนสามารถปรับตัวได้เองไม่เกิดปัญหาสุขภาพของตนเอง และท่านยังสามารถช่วยดูแลบุคคลอื่น ๆ ในครอบครัวและชุมชนได้ด้วย<br>
                            2. เครียดปานกลาง ในภาวะวิกฤตหรือภัยพิบัติบุคคลต้องเตรียมพร้อมในการจัดการกับปัญหาต่าง ๆ จนทำให้เกิดความเครียดเพิ่มขึ้นในระดับปานกลาง ซึ่งยังถือว่าเป็นปกติเพราะทำให้เกิดความกระตือรือร้นในการเผชิญปัญหา<br>
                            3. เครียดมาก ในภาวะวิกฤตหรือภัยพิบัติต่าง ๆ อาจทำให้เกิดการตอบสนองที่รุนแรงขึ้นชั่วคราว ซึ่งมักจะลดมาเป็นปกติหลังเหตุการณ์ อย่างไรก็ตามท่านควรมีการจัดการกับความเครียด ดังต่อไปนี้<br>
                            •	การฝึกการหายใจคลายเครียด<br>
                            •	การพูดคุยกับคนใกล้ชิด การสวดมนต์ไหว้พระ การช่วยเหลือผู้อื่นที่ประสบปัญหาจะช่วยให้ความเครียดลดลง<br>
                            •	การมีความหวังว่า เราจะฝ่าฟันอุปสรรคหรือปัญหาครั้งนี้ไปได้และมองเห็นด้านบวก เช่น อย่างน้อยก็ยังรักษาชีวิตไว้ได้ มีคนเห็นใจและมีการช่วยเหลือจากฝ่ายต่าง ๆ<br>
                            •	มองข้ามความขัดแย้งเก่า ๆ ในอดีตและรวมตัวกันช่วยให้ชุมชนผ่านวิกฤตไปได้<br>
                            •	ภายใน 2 สัปดาห์ ท่านควรไปพบแพทย์เพื่อประเมินซ้ำว่าความเครียดลดลงหรือไม่ เพราะความเครียดที่มากและต่อเนื่องอาจนำไปสู่โรควิตกกังวล ภาวะซึมเศร้า และเสี่ยงต่อการฆ่าตัวตายได้ ซึ่งจะต้องได้รับการรักษาจากแพทย์<br>
                            4. เครียดมากที่สุด เป็นความเครียดที่รุนแรงซึ่งส่งผลกระทบต่อภาวะร่างกาย ทำให้อ่อนแอ เจ็บป่วยง่าย   และต่อภาวะจิตใจจนอาจทำให้เกิดโรควิตกกังวล ภาวะซึมเศร้า และเสี่ยงต่อการฆ่าตัวตายจะต้องได้รับการรักษาจากแพทย์ทันที และได้รับการดูแลต่อเนื่องไปอีก 3-6 เดือน<br>
                            อ้างอิง ประเมินความเครียด (ST-5) ของกรมสุขภาพจิต กระทรวงสาธารณสุข จำนวน  5 ข้อ
                        </h5>
                    </center>
                    
                </div><hr> 
                <div class="table-responsive">
                    <table class="table table-bordered border-primary mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>วันที่</th>
                                <th>หมายเหตุ</th>
                                <th>คะแนน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($list as $item)
                                    <tr>
                                        <td>{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</td>
                                        <td>{{$item->remark}}</td>
                                        <td>
                                            @if ($item->total >= 5 && $item->total <= 7)
                                            <span class="badge bg-success">{{$item->total}}</span>
                                            @else
                                            <span class="badge bg-danger">{{$item->total}}</span>
                                            @endif
                                           
                                        </td>
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
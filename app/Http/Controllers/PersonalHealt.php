<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalDataList;
use Illuminate\Support\Facades\DB;

class PersonalHealt extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp1 = PersonalDataList::where('personal_type','Optimist ชาย')->orderby('personal_sub','desc')->get();
        $emp2 = PersonalDataList::where('personal_type','Optimist หญิง')->orderby('personal_sub','desc')->get();
        $emp3 = PersonalDataList::where('personal_type','ILCA 4 ชาย')->orderby('personal_sub','desc')->get();
        $emp4 = PersonalDataList::where('personal_type','ILCA 4 หญิง')->orderby('personal_sub','desc')->get();
        $emp5 = PersonalDataList::where('personal_type','ILCA 6')->orderby('personal_sub','desc')->get();
        $emp6 = PersonalDataList::where('personal_type','ILCA 7')->orderby('personal_sub','desc')->get();
        $emp7 = PersonalDataList::where('personal_type','470')->orderby('personal_sub','desc')->get();
        $personalIds = collect([$emp1, $emp2, $emp3, $emp4, $emp5, $emp6, $emp7])->flatten()->pluck('id')->toArray();
        $healt = DB::table('data_health_hds')
        ->leftjoin('personal_data_lists','data_health_hds.personal_id','=','personal_data_lists.id')
        ->select('data_health_hds.*','personal_data_lists.personal_name')
        ->whereIn('personal_id', $personalIds)
        ->where('flag', true)
        ->get();
        $personalGroups = $healt->groupBy('personal_id');
        $charts = [];
        foreach ($personalGroups as $personalId => $personalItems) {
            // สร้าง labels สำหรับแต่ละ personal โดยใช้ created_at แปลงเป็นวันที่ (Y-m-d)
            $labels = $personalItems->pluck('created_at')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('Y-m-d');
                })
                ->unique()
                ->sort()
                ->values() // รีอินเด็กซ์ array
                ->toArray();

            // แยกข้อมูลภายในแต่ละ personal ตาม joint_name
            $healtGroups = $personalItems->groupBy('personal_name');
            $datasets = [];
            foreach ($healtGroups as $healtName => $items) {
                $scores = [];
                // สำหรับแต่ละวันที่ใน labels หา score ที่ตรงกัน (โดยเทียบเฉพาะวันที่)
                foreach ($labels as $label) {
                    $scoreItem = $items->filter(function ($item) use ($label) {
                        return Carbon::parse($item->created_at)->format('Y-m-d') === $label;
                    })->first();
                    $scores[] = $scoreItem ? $scoreItem->total : 0;
                }
                $datasets[] = [
                    'label' => $healtName,
                    'data' => $scores,
                    'borderColor' => '#' . substr(md5(rand()), 0, 6),
                    'fill' => false,
                ];
            }
            // สร้างข้อมูลกราฟสำหรับแต่ละ personal_id
            $charts[] = [
                'personalId' => $personalId,
                'labels'     => $labels,
                'datasets'   => $datasets,
            ];
        }
        return view('psychology.psychology-datelist',compact('emp1','emp2','emp3','emp4','emp5','emp6','emp7','healt','charts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

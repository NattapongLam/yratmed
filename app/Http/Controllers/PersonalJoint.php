<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DataJointsList;
use App\Models\PersonalDataList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalJoint extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $joint = DB::table('personal_joints_lists')
        ->whereIn('personal_id', $personalIds)
        ->where('flag', true)
        ->get();
         // แบ่งข้อมูลตาม personal_id
        $personalGroups = $joint->groupBy('personal_id');
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
            $jointGroups = $personalItems->groupBy('joint_name');
            $datasets = [];
            foreach ($jointGroups as $jointName => $items) {
                $scores = [];
                // สำหรับแต่ละวันที่ใน labels หา score ที่ตรงกัน (โดยเทียบเฉพาะวันที่)
                foreach ($labels as $label) {
                    $scoreItem = $items->filter(function ($item) use ($label) {
                        return Carbon::parse($item->created_at)->format('Y-m-d') === $label;
                    })->first();
                    $scores[] = $scoreItem ? $scoreItem->score : 0;
                }
                $datasets[] = [
                    'label' => $jointName,
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
        return view('report.report-joint',compact('emp1','emp2','emp3','emp4','emp5','emp6','emp7','joint','charts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = PersonalDataList::get();
        $joint = DataJointsList::get();
        $list = DB::table('personal_joints_lists')->get();
        return view('personals.personal-joint-create',compact('emp','joint','list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->joint_id as $key => $value) {
                $joint = DB::table('data_joints_lists')->where('id',$value)->first();               
                $data = [
                    'personal_id' => $request->personal_id,
                    'joint_name' => $joint->joint_name,
                    'score' => $request->joint_score[$key],
                    'flag' => true,
                    'remark' => $request->joint_remark[$key],
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                DB::table('personal_joints_lists')->insert($data);
            }
            DB::commit();
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            dd($message);
            return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
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
    public function getPersonalJoint($id)
    {
        $history = DB::table('personal_joints_lists')->where('personal_id', $id)->get();
        return response()->json($history);
    }
}

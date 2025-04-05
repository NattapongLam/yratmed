<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\HistoryStatus;
use App\Models\HistoryLogDate;
use App\Models\PersonalDataList;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalHistoryList;
use Illuminate\Support\Facades\Auth;

class PersonalHistory extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = PersonalDataList::get();
        $sta = HistoryStatus::get();
        return view('personals.personal-history-create',compact('emp','sta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'serious_lllness' => $request->serious_lllness,
            'serious_lnjury' => $request->serious_lnjury,
            'previous_surgery' => $request->previous_surgery,
            'personal_id' => $request->personal_id,
            'history_date' => $request->history_date,
            'status_id' => $request->status_id,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'temperature' => $request->temperature,
            'pulse' => $request->pulse,
            'breathe' => $request->breathe,
            'pressure' => $request->pressure,
            'mercury' => $request->mercury,
            'pain' => $request->pain,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'nature' => $request->nature,
            'severity' => $request->severity,
        ];
        try {
            DB::beginTransaction();
            DB::table('personal_history_lists')->insert($data);
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
        $emp = PersonalHistoryList::leftjoin('history_statuses','personal_history_lists.status_id','history_statuses.id')
        ->leftjoin('personal_data_lists','personal_history_lists.personal_id','personal_data_lists.id')
        ->select('personal_history_lists.*','personal_data_lists.personal_name','personal_data_lists.personal_type','personal_data_lists.personal_sub','history_statuses.status_name','history_statuses.id as status_id')
        ->where('personal_history_lists.id', $id)->first();
        $sta = HistoryStatus::get();
        $log = HistoryLogDate::where('history_id', $id)->get();
        return view('personals.personal-history-edit',compact('emp','sta','log'));
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
        $data = [
            'remark' => $request->remark,
            'history_id' => $id,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            DB::table('personal_history_lists')
            ->where('id', $id)
            ->update([
                'status_id' => $request->status_id,
                'created_at' => Carbon::now()
            ]);
            DB::table('history_log_dates')->insert($data);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getHistory($id)
    {
        $history = PersonalHistoryList::leftjoin('history_statuses','personal_history_lists.status_id','history_statuses.id')
        ->where('personal_id', $id)->get();
        return response()->json($history);
    }
}

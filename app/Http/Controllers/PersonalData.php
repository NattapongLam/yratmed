<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PersonalSubList;
use App\Models\PersonalDataList;
use App\Models\PersonalTypeList;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalHistoryList;
use Illuminate\Support\Facades\Auth;

class PersonalData extends Controller
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
        $emp = PersonalDataList::where('personal_flag',true)->orderby('id','asc')->get();
        return view('personals.personal-data-list',compact('emp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typ = PersonalTypeList::where('flag',true)->get();
        $sub = PersonalSubList::where('flag',true)->get();
        return view('personals.personal-data-create',compact('typ','sub'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'personal_name' => 'required|unique:personal_data_lists,personal_name',
        ]);
        $data = [
            'personal_name' => $request->personal_name,
            'personal_sex' => $request->personal_sex,
            'personal_type' => $request->personal_type,
            'personal_sub' => $request->personal_sub,
            'personal_birthday' => $request->personal_birthday,
            'personal_age' => $request->personal_age,
            'personal_underlying' => $request->personal_underlying,
            'personal_currentmed' => $request->personal_currentmed,
            'personal_allergy'=> $request->personal_allergy,
            'personal_tel' => $request->personal_tel,
            'personal_address' => $request->personal_address,
            'personal_flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'serious_lllness' => $request->serious_lllness,
            'serious_lnjury' => $request->serious_lnjury,
            'previous_surgery' => $request->previous_surgery,
        ];
        if ($request->hasFile('avatar')) {
            $data['personal_img'] = $request->file('avatar')->storeAs('assets/images/users', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('avatar')->extension());
        }
        try {
            DB::beginTransaction();
            DB::table('personal_data_lists')->insert($data);
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
        $emp = PersonalDataList::where('id',$id)->first();
        $typ = PersonalTypeList::where('flag',true)->get();
        $sub = PersonalSubList::where('flag',true)->get();
        $history = PersonalHistoryList::leftjoin('history_statuses','personal_history_lists.status_id','history_statuses.id')
        ->where('personal_id', $id)
        ->where('flag',true)
        ->orderby('history_date','desc')
        ->get();
        $joint = DB::table('personal_joints_lists')->where('personal_id', $id)->where('flag',true)->get();
        $subs = DB::table('dataostrc_hds')
        ->leftjoin('dataostrc_dts','dataostrc_hds.id','=','dataostrc_dts.dataostrc_id')
        ->where('dataostrc_hds.flag',true)
        ->where('dataostrc_dts.sub_remark','เฝ้าระวัง')
        ->where('dataostrc_hds.person_at',$emp->personal_email)
        ->orderby('dataostrc_hds.created_at','desc')
        ->get();
        $labs = DB::table('personal_lap_hds')
        ->leftjoin('personal_lap_lists','personal_lap_hds.id','=','personal_lap_lists.lap_id')
        ->where('personal_lap_hds.flag',true)
        ->where('personal_lap_lists.personal_id',$id)
        ->orderby('personal_lap_hds.lap_date','desc')
        ->get();
        $healt = DB::table('data_health_hds')
        ->where('personal_id', $id)
        ->where('flag', true)
        ->orderby('created_at','asc')
        ->get();
        return view('personals.personal-data-edit',compact('typ','sub','emp','joint','history','subs','labs','healt'));
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
        $flag = $request->flag;

        if ($flag == 'on' || $flag == 'true') {
            $flag = true;
        } else {
            $flag = false;
        }
        $data = [
            'personal_sex' => $request->personal_sex,
            'personal_type' => $request->personal_type,
            'personal_sub' => $request->personal_sub,
            'personal_birthday' => $request->personal_birthday,
            'personal_age' => $request->personal_age,
            'personal_underlying' => $request->personal_underlying,
            'personal_currentmed' => $request->personal_currentmed,
            'personal_allergy'=> $request->personal_allergy,
            'personal_tel' => $request->personal_tel,
            'personal_address' => $request->personal_address,
            'personal_flag' => $flag ,
            'person_at' => Auth::user()->name,
            'updated_at' => Carbon::now(),
            'serious_lllness' => $request->serious_lllness,
            'serious_lnjury' => $request->serious_lnjury,
            'previous_surgery' => $request->previous_surgery,
        ];
        if ($request->hasFile('avatar')) {
            $data['personal_img'] = $request->file('avatar')->storeAs('assets/images/users', "IMG_" . carbon::now()->format('Ymdhis') . "_" . Str::random(5) . "." . $request->file('avatar')->extension());
        }
        try {
            DB::beginTransaction();
            DB::table('personal_data_lists')->where('id',$id)->update($data);
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
}

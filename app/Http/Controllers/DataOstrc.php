<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataostrcHd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataOstrc extends Controller
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
        $list = DataostrcHd::where('flag',true)->where('person_at',Auth::user()->email)->get();
        return view('evaluation.evaluation-ostrc-list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluation.evaluation-ostrc-create');
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
            'score1' => 'required',
            'score2' => 'required',
            'score3' => 'required',
            'score4' => 'required',
            'score5' => 'required',
            'score6' => 'required',
            'score7' => 'required',
        ]);
        $data = [
            'remark' => $request->remark,
            'score1' => $request->score1,
            'score2' => $request->score2,
            'score3' => $request->score3,
            'score4' => $request->score4,
            'score5' => $request->score5,
            'score6' => $request->score6,
            'score7' => $request->score7,
            'flag' => true,
            'person_at' => Auth::user()->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        try {
            DB::beginTransaction();
            $insertHD = DataostrcHd::create($data);
            $joint = DB::table('data_joints_lists')->orderby('id','asc')->get();
            $personal = DB::table('personal_data_lists')->where('personal_email',Auth::user()->email)->first();
            foreach ($joint as $key => $value) {
                if($value->id == 1){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score1,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 2){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score2,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 3){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score3,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 4){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score4,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 5){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score5,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 6){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score6,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }elseif($value->id == 7){
                    $hd = DB::table('personal_joints_lists')->insert([
                        'joint_name' => $value->joint_name,
                        'score' => $request->score7,
                        'flag' => true,
                        'person_at' => Auth::user()->name,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'personal_id' => $personal->id
                    ]);
                }                
            }
            $sub = DB::table('data_joint_subs')->orderby('id','asc')->get();
            foreach ($sub as $key => $value) {
                if($value->id == 1){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score1_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 2){
                    if($request->score1_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score1_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 3){
                    if($request->score1_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score1_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 4){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score1_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 5){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score2_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 6){
                    if($request->score2_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score2_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 7){
                    if($request->score2_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score2_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 8){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score2_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 9){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score3_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 10){
                    if($request->score3_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score3_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 11){
                    if($request->score3_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score3_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 12){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score3_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 13){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score4_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 14){
                    if($request->score4_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score4_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 15){
                    if($request->score4_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score4_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 16){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score4_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 17){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score5_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 18){
                    if($request->score5_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score5_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 19){
                    if($request->score5_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score5_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 20){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score5_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 21){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score6_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 22){
                    if($request->score6_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score6_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 23){
                    if($request->score6_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score6_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 24){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score6_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 25){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score7_1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 26){
                    if($request->score7_2 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score7_2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 27){
                    if($request->score7_3 <= 13){
                        $remark = 'เฝ้าระวัง';
                    }else{
                        $remark = '';
                    }
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score7_3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                        'sub_remark' => $remark
                    ]);
                }elseif($value->id == 28){
                    $hd = DB::table('dataostrc_dts')->insert([
                        'dataostrc_id' => $insertHD->id,
                        'sub_no' => $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score7_4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
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
}

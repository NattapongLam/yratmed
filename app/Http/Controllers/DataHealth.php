<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataHealthHd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataHealth extends Controller
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
        $list = DataHealthHd::where('flag',true)->where('person_at',Auth::user()->email)->get();
        return view('evaluation.evaluation-health-list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluation.evaluation-health-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personal = DB::table('personal_data_lists')->where('personal_email',Auth::user()->email)->first();
        $data = [
            'remark' => $request->remark,
            'total' => $request->total,
            'flag' => true,
            'person_at' => Auth::user()->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'personal_id' => $personal->id
        ];
        try {
            DB::beginTransaction();
            $insertHD = DataHealthHd::create($data);
            $list = DB::table('data_health_lists')->get();
            foreach ($list as $key => $value) {
                if($value->id == 1){
                    $hd = DB::table('data_health_dts')->insert([
                        'health_id' => $insertHD->id,
                        'sub_no'=> $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 2){
                    $hd = DB::table('data_health_dts')->insert([
                        'health_id' => $insertHD->id,
                        'sub_no'=> $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score2,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 3){
                    $hd = DB::table('data_health_dts')->insert([
                        'health_id' => $insertHD->id,
                        'sub_no'=> $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score3,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 4){
                    $hd = DB::table('data_health_dts')->insert([
                        'health_id' => $insertHD->id,
                        'sub_no'=> $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score4,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }elseif($value->id == 5){
                    $hd = DB::table('data_health_dts')->insert([
                        'health_id' => $insertHD->id,
                        'sub_no'=> $value->no,
                        'sub_name' => $value->name,
                        'sub_qty' => $request->score5,
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

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DataFoodTasteHd;
use App\Models\DataFoodTasteLIst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataFoodtaste extends Controller
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
        $list = DataFoodTasteHd::where('flag',true)->where('person_at',Auth::user()->email)->get();
        return view('evaluation.evaluation-foodtaste-list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = DataFoodTasteLIst::get();
        return view('evaluation.evaluation-foodtaste-create',compact('list'));
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
        if($request->dietarycheck1){
            $check1 = true;
        }else{
            $check1 = false;
        }
        if($request->dietarycheck2){
            $check2 = true;
        }else{
            $check2 = false;
        }
        if($request->dietarycheck3){
            $check3 = true;
        }else{
            $check3 = false;
        }
        $data = [
            'remark' => $request->remark,
            'flag' => true,
            'person_at' => Auth::user()->email,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'personal_id' => $personal->id,
            'dietarycheck1' => $check1,
            'dietarycheck2' => $check2,
            'dietarycheck3' => $check3,
            'dietaryremark1' => $request->dietaryremark1,
            'dietaryremark2' => $request->dietaryremark2,
            'dietaryremark3' => $request->dietaryremark3,
            'foodtaste_date' => $request->foodtaste_date,
            'foodtaste_type' => $request->foodtaste_type,
        ];
        try {
            DB::beginTransaction();
            $insertHD = DataFoodTasteHd::create($data);
            foreach ($request->foodtaste_no as $key => $value) {
                $hd = DB::table('data_food_taste_dts')->insert([
                    'foodtaste_id' => $insertHD->id,
                    'foodtaste_no'=> $value,
                    'foodtaste_name' => $request->foodtaste_name[$key],
                    'foodtaste_qty' => $request->foodtaste_qty[$key],
                    'foodtaste_remark' => $request->foodtaste_remark[$key],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
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

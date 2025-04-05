<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlanDoDate extends Controller
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
        $plan = DB::table('plan_data_lists')
        ->where('plan_data_lists.flag',true)
        ->where('plan_data_lists.status_id',1)
        ->get();
        return view('plan.plan-do-list',compact('plan'));
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
        $data = [
            'sub_date' => $request->sub_date,
            'sub_remark' => $request->sub_remark,
            'plan_type' => $request->plan_type,
            'plan_sub' => $request->plan_sub,
            'plan_id' => $request->plan_id,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            DB::table('plan_sub_lists')->insert($data);
            $ck = DB::table('plan_data_lists')->where('plan_data_lists.id',$request->plan_id)->first();
            if($ck->status_id == 1){
                $up = DB::table('plan_data_lists')
                ->where('plan_data_lists.id',$request->plan_id)
                ->update(['status_id' => 2]);
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
        $plan = DB::table('plan_data_lists')
        ->where('plan_data_lists.id',$id)
        ->first();
        $sub = DB::table('plan_sub_lists')
        ->where('plan_id',$id)
        ->where('flag',true)
        ->orderBy('sub_date','asc')
        ->get();
        return view('plan.plan-do-update',compact('plan','sub'));
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
        try {
            DB::table('plan_sub_lists')->where('id', $id)->delete();
            return response()->json(['success' => true, 'message' => 'ลบข้อมูลสำเร็จ']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlanData extends Controller
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
        return view('plan.plan-data-create');
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
            'plan_date' => $request->plan_date,
            'plan_remark' => $request->plan_remark,
            'status_id' => 1,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            DB::table('plan_data_lists')->insert($data);
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
        $plan = DB::table('plan_data_lists')->where('id',$id)->first();
        $subdo = DB::table('plan_sub_lists')
        ->where('plan_id',$id)
        ->where('flag',true)
        ->where('plan_sub','Do')
        ->get();
        $subcheck = DB::table('plan_sub_lists')
        ->where('plan_id',$id)
        ->where('flag',true)
        ->where('plan_sub','Check')
        ->get();
        $subaction = DB::table('plan_sub_lists')
        ->where('plan_id',$id)
        ->where('flag',true)
        ->where('plan_sub','Action')
        ->get();
        return view('plan.plan-data-edit',compact('plan','subdo','subcheck','subaction'));
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
            'plan_date' => $request->plan_date,
            'plan_remark' => $request->plan_remark,
            'status_id' => 1,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            DB::table('plan_data_lists')->where('id',$id)->update($data);
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
    public function getPlans()
    {
        $plans = DB::table('plan_data_lists')
        ->leftJoin('plan_statuses', 'plan_data_lists.status_id', '=', 'plan_statuses.id')
        ->select('plan_data_lists.id', 'plan_statuses.status_name', 'plan_data_lists.plan_date', 'plan_data_lists.plan_remark','plan_data_lists.person_at')
        ->where('plan_data_lists.flag', true)
        ->get();

        return response()->json($plans->map(function ($plan) {
            return [
                'id'    => $plan->id,
                'title' => "(".$plan->status_name.")". " - " . $plan->person_at, 
                'start' => $plan->plan_date,
                'url'   => route('plan.edit', $plan->id),
                'remark' => $plan->plan_remark,
            ];
        }));
    }
}

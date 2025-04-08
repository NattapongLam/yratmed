<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DataPhysicalList;
use App\Models\PersonalDataList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataPhysical extends Controller
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
        $list = DataPhysicalList::where('flag',true)
        ->leftjoin('personal_data_lists','data_physical_lists.personal_id','=','personal_data_lists.id')
        ->select('data_physical_lists.*','personal_data_lists.personal_img','personal_data_lists.personal_birthday','personal_data_lists.personal_name','personal_data_lists.personal_sex','personal_data_lists.personal_type','personal_data_lists.personal_sub')
        ->get();
        return view('physical.physical-list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = PersonalDataList::get();
        return view('physical.physical-create',compact('emp'));
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
            'personal_id' => $request->personal_id,
            'person_at' => Auth::user()->name,
            'flag' => true,
            'physical_date' => $request->physical_date,
            'physical_diagnosis' => $request->physical_diagnosis,
            'physical_treatment' => $request->physical_treatment,            
            'physical_results' => $request-> physical_results,
            'physical_remark' => $request->physical_remark,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),         
        ];
        try {
            DB::beginTransaction();
            DB::table('data_physical_lists')->insert($data);
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
        $list = DataPhysicalList::where('flag',true)
        ->leftjoin('personal_data_lists','data_physical_lists.personal_id','=','personal_data_lists.id')
        ->select('data_physical_lists.*','personal_data_lists.personal_img','personal_data_lists.personal_birthday','personal_data_lists.personal_name','personal_data_lists.personal_sex','personal_data_lists.personal_type','personal_data_lists.personal_sub')
        ->first();
        return view('physical.physical-edit',compact('list'));
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
            'physical_date' => $request->physical_date,
            'physical_diagnosis' => $request->physical_diagnosis,
            'physical_treatment' => $request->physical_treatment,            
            'physical_results' => $request-> physical_results,
            'physical_remark' => $request->physical_remark,
            'updated_at' => Carbon::now(),         
        ];
        try {
            DB::beginTransaction();
            DB::table('data_physical_lists')->where('id',$id)->update($data);
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
    public function cancel($id)
    {
        $item = DataPhysicalList::where('id',$id)->update(['flag' => false]);
        return redirect()->back()->with('success', 'ยกเลิกรายการเรียบร้อยแล้ว');
    }
}

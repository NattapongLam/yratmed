<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalLapHd;
use App\Models\PersonalLapList;
use App\Models\PersonalDataList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalLab extends Controller
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
        $lap = PersonalLapHd::where('flag',true)->get();
        return view('personals.personal-lap-list',compact('lap'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp = PersonalDataList::where('personal_flag',true)->orderby('id','asc')->get();
        return view('personals.personal-lap-create',compact('emp'));
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
            'lap_date' => $request->lap_date,
            'lap_remark' => $request->lap_remark ,
            'flag' => true,
            'person_at' => Auth::user()->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            $insertHD = PersonalLapHd::create($data);
            foreach ($request->personal_id as $key => $value) {
                $dt[] = [
                    'personal_name' => $request->personal_name[$key],
                    'personal_age' => $request->personal_age[$key],
                    'bh' => $request->bh[$key],
                    'bw' => $request->bw[$key],
                    'bmi' => $request->bmi[$key],
                    'rbc' => $request->rbc[$key],
                    'hb' => $request->hb[$key],
                    'hct' => $request->hct[$key],
                    'mvc' => $request->mvc[$key],
                    'mch' => $request->mch[$key],
                    'mchc' => $request->mchc[$key],
                    'rdw' => $request->rdw[$key],
                    'wbc' => $request->wbc[$key],
                    'plt' => $request->plt[$key],
                    'ferritin' => $request->ferritin[$key],
                    'cpk' => $request->cpk[$key],
                    'bloodsugar' => $request->bloodsugar[$key],
                    'bun' => $request->bun[$key],
                    'cr' => $request->cr[$key],
                    'gf' => $request->gf[$key],
                    'ast' => $request->ast[$key],
                    'alt' => $request->alt[$key],
                    'alp' => $request->alp[$key],
                    'albumin' => $request->albumin[$key],
                    'sp' => $request->sp[$key],
                    'ph' => $request->ph[$key],
                    'prot' => $request->prot[$key],
                    'glucose' => $request->glucose[$key],
                    'ketone' => $request->ketone[$key],
                    'wb' => $request->wb[$key],
                    'rb' => $request->rb[$key],
                    'epith' => $request->epith[$key],
                    'bac' => $request->bac[$key],
                    'mucous' => $request->mucous[$key],
                    'flag' => true,
                    'person_at' => Auth::user()->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'personal_id' => $value,
                    'remark' => $request->remark[$key],
                    'lap_id' => $insertHD->id
                ];                
            }
            $insertDT = PersonalLapList::insert($dt);
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
        $hd = PersonalLapHd::where('id',$id)->first();    
        $dt = PersonalLapList::leftjoin('personal_data_lists','personal_id','=','personal_data_lists.id')
        ->select('personal_data_lists.personal_img','personal_lap_lists.*')
        ->where('lap_id',$id)
        ->where('flag',true)->get();
        return view('personals.personal-lap-edit',compact('hd','dt'));
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
            'lap_remark' => $request->lap_remark,
            'person_at' => Auth::user()->name,
            'updated_at' => Carbon::now()
        ];
        try {
            DB::beginTransaction();
            $updateHD = PersonalLapHd::where('id',$id)->update($data);
            foreach ($request->sub_id as $key => $value) {
                $updateDT = PersonalLapList::where('id',$value)->update([
                    'bh' => $request->bh[$key],
                    'bw' => $request->bw[$key],
                    'bmi' => $request->bmi[$key],
                    'rbc' => $request->rbc[$key],
                    'hb' => $request->hb[$key],
                    'hct' => $request->hct[$key],
                    'mvc' => $request->mvc[$key],
                    'mch' => $request->mch[$key],
                    'mchc' => $request->mchc[$key],
                    'rdw' => $request->rdw[$key],
                    'wbc' => $request->wbc[$key],
                    'plt' => $request->plt[$key],
                    'ferritin' => $request->ferritin[$key],
                    'cpk' => $request->cpk[$key],
                    'bloodsugar' => $request->bloodsugar[$key],
                    'bun' => $request->bun[$key],
                    'cr' => $request->cr[$key],
                    'gf' => $request->gf[$key],
                    'ast' => $request->ast[$key],
                    'alt' => $request->alt[$key],
                    'alp' => $request->alp[$key],
                    'albumin' => $request->albumin[$key],
                    'sp' => $request->sp[$key],
                    'ph' => $request->ph[$key],
                    'prot' => $request->prot[$key],
                    'glucose' => $request->glucose[$key],
                    'ketone' => $request->ketone[$key],
                    'wb' => $request->wb[$key],
                    'rb' => $request->rb[$key],
                    'epith' => $request->epith[$key],
                    'bac' => $request->bac[$key],
                    'mucous' => $request->mucous[$key],
                    'flag' => true,
                    'person_at' => Auth::user()->name,
                    'updated_at' => Carbon::now(),
                    'remark' => $request->remark[$key],
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

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalSubList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $sub = PersonalSubList::get();
        return view('personals.personal-sub-create',compact('sub'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_name' => 'required|unique:personal_sub_lists,sub_name',
        ]);
        try {
            DB::beginTransaction();
            $data = [
                'sub_name' => $request->sub_name,
                'flag' => true,
                'person_at' => Auth::user()->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('personal_sub_lists')->insert($data);
            DB::commit();
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            dd($message);
            return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
    }
    public function edit($id)
    {
        $sub = PersonalSubList::where('id',$id)->first();
        $subs = PersonalSubList::get();
        return view('personals.personal-sub-edit',compact('sub','subs'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_name' => 'required|unique:personal_sub_lists,sub_name,'.$id,
        ]);
        $flag = $request->flag;

        if ($flag == 'on' || $flag == 'true') {
            $flag = true;
        }else{
            $flag = false;
        }

        try {
            DB::beginTransaction();
            $data = [
                'sub_name' => $request->sub_name,
                'flag' => $flag,
                'person_at' => Auth::user()->name,
                'updated_at' => Carbon::now()
            ];
            DB::table('personal_sub_lists')->where('id',$id)->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        }catch(\Exception $e){
            DB::rollBack();
            $message = $e->getMessage();
            dd($message);
            return redirect()->back()->with('error', 'บันทึกข้อมูลไม่สำเร็จ');
        }
    }
}

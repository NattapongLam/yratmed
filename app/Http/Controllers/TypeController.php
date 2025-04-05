<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalTypeList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $type = PersonalTypeList::get();
        return view('personals.personal-type-create',compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:personal_type_lists,type_name',
        ]);
        try {
            DB::beginTransaction();
            $data = [
                'type_name' => $request->type_name,
                'flag' => true,
                'person_at' => Auth::user()->name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('personal_type_lists')->insert($data);
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
        $type = PersonalTypeList::where('id',$id)->first();
        $types = PersonalTypeList::get();
        return view('personals.personal-type-edit',compact('type','types'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|unique:personal_type_lists,type_name,'.$id,
        ]);
        $flag = $request->flag;

        if ($flag == 'on' || $flag == 'true') {
            $flag = true;
        } else {
            $flag = false;
        }
        try {
            DB::beginTransaction();
            $data = [
                'type_name' => $request->type_name,
                'person_at' => Auth::user()->name,
                'flag' => $flag,
                'updated_at' => Carbon::now()
            ];
            DB::table('personal_type_lists')->where('id',$id)->update($data);
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

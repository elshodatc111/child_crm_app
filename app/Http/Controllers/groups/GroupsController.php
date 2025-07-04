<?php

namespace App\Http\Controllers\groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupsTarbiyachi;
use App\Models\GroupChild;
use App\Models\DamKunlar;
use App\Models\Child;
use App\Models\ChildDavomad;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\EditGroupRequest;

class GroupsController extends Controller{
    public function index(){
        $Groups = Group::where('status','true')->get();
        $Group = [];
        foreach ($Groups as $key => $value) {
            $Group[$key]['id'] = $value->id;
            $Group[$key]['name'] = $value->group_name;
            $Group[$key]['price_month'] = $value->price_month;
            $Group[$key]['price_day'] = $value->price_day;
            $Group[$key]['child'] = count(GroupChild::where('group_id',$value->id)->where('status','true')->get());
        }
        return view('groups.index',compact('Group'));
    }
    public function arxiv_index(){
        $Groups = Group::where('status','false')->get();
        $Group = [];
        foreach ($Groups as $key => $value) {
            $Group[$key]['id'] = $value->id;
            $Group[$key]['name'] = $value->group_name;
            $Group[$key]['price_month'] = $value->price_month;
            $Group[$key]['price_day'] = $value->price_day;
        }
        return view('groups.arxiv_index',compact('Group'));
    }
    public function new_index(){
        $Katta = User::where('type','tarbiyachi')->get();
        $katta = [];
        foreach ($Katta as $key => $value) {
            $id = $value->id;
            $check = GroupsTarbiyachi::where('user_id',$id)->where('status',1)->get();
            if(count($check)==0){
                $katta[$key]['id'] = $id;
                $katta[$key]['name'] = $value->fio;
            }
        }
        $Kichik = User::where('type','kichik_tarbiyachi')->get();
        $kichik = [];
        foreach ($Kichik as $key => $value) {
            $id = $value->id;
            $check = GroupsTarbiyachi::where('user_id',$id)->where('status',1)->get();
            if(count($check)==0){
                $kichik[$key]['id'] = $id;
                $kichik[$key]['name'] = $value->fio;
            }
        }
        return view('groups.new_index',compact('katta','kichik'));
    }
    public function create_group(StoreGroupRequest $request){
        $data = $request->validated();
        $Group = Group::create([
            'group_name' => $request->group_name,
            'price_month' => $request->price_month,
            'price_day' => $request->price_day,
            'status' => 'true',
            'group_type' => $request->group_type,
            'user_id' => auth()->user()->id,
        ]);
        GroupsTarbiyachi::create([
            'group_id' => $Group->id,
            'user_id' => $request->user_id1,
            'start_time' => date("Y-m-d"),
            'type' => 'tarbiyachi',
            'status' => 1,
        ]);
        GroupsTarbiyachi::create([
            'group_id' => $Group->id,
            'user_id' => $request->user_id2,
            'start_time' => date("Y-m-d"),
            'type' => 'yordamchi',
            'status' => 1,
        ]);
        return redirect()->route('groups_show',$Group->id);
    }
    protected function group_about($id){
        $Group = Group::find($id);
        $tarbiyachi = GroupsTarbiyachi::where('groups_tarbiyachis.group_id',$id)
            ->join('users','users.id','groups_tarbiyachis.user_id')
            ->where('users.type','tarbiyachi')
            ->where('groups_tarbiyachis.status',1)
            ->where('users.status','active')
            ->first();
        $yordamchi = GroupsTarbiyachi::where('groups_tarbiyachis.group_id',$id)
            ->join('users','users.id','groups_tarbiyachis.user_id')
            ->where('users.type','kichik_tarbiyachi')
            ->where('users.status','active')
            ->where('groups_tarbiyachis.status',1)
            ->first();
        return [
            'group_id' => $id,
            'group_name' => $Group->group_name,
            'price_month' => $Group->price_month,
            'price_day' => $Group->price_day,
            'status' => $Group->status,
            'group_type' => $Group->group_type,
            'meneger' => User::find($Group->user_id)->fio,
            'created_at' => $Group->created_at,
            'tarbiyachi_id' => $tarbiyachi['id'],
            'tarbiyachi' => $tarbiyachi['fio'],
            'yordamchi_id' => $yordamchi['id'],
            'yordamchi' => $yordamchi['fio'],
        ];
    }
    protected function group_tarbiyachi($user_id){
        $User = User::where('id', '!=', $user_id)
            ->where('status', 'active')
            ->where('type', 'tarbiyachi')
            ->get();
        $res = [];
        foreach ($User as $key => $value) {
            $faolGuruhlar = GroupsTarbiyachi::where('user_id', $value->id)->where('status', 1)->first();
            if (!$faolGuruhlar) {
                $res[$key]['user_id'] = $value->id;
                $res[$key]['user_name'] = $value->fio;
            }
        }
        return $res;
    }
    protected function group_yordamchi($user_id){
        $User = User::where('id', '!=', $user_id)
            ->where('status', 'active')
            ->where('type', 'kichik_tarbiyachi')
            ->get();
        $res = [];
        foreach ($User as $key => $value) {
            $faolGuruhlar = GroupsTarbiyachi::where('user_id', $value->id)
                ->where('status', 1)
                ->count();
            if ($faolGuruhlar == 0) {
                $res[$key]['user_id'] = $value->id;
                $res[$key]['user_name'] = $value->fio;
            }
        }
        return $res;
    }
    protected function ishKunlar($group_id){
        $Group = Group::find($group_id);
        if($Group['group_type']=='besh'){
            $number = 5;
        }else{
            $number = 6;
        }
        $year = date('Y');
        $month = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $hafta_kunlari = [
            1 => 'Dushanba',
            2 => 'Seshanba',
            3 => 'Chorshanba',
            4 => 'Payshanba',
            5 => 'Juma',
            6 => 'Shanba',
            7 => 'Yakshanba',
        ];
        $ruxsat_kunlar = range(1, $number);
        $dam_olish_kunlari = DamKunlar::whereMonth('data', $month)
            ->whereYear('data', $year)
            ->pluck('data')
            ->toArray();
        $ish_kunlari = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
            $weekday_number = date('N', strtotime($date));
            if (in_array($weekday_number, $ruxsat_kunlar) && !in_array($date, $dam_olish_kunlari)) {
                $ish_kunlari[] = [
                    'sanasi' => $date,
                    'hafta_kuni' => $hafta_kunlari[$weekday_number],
                ];
            }
        }
        return $ish_kunlari;
    }
    protected function childrenGroups($id){
        $GroupChild = GroupChild::where('group_id',$id)->where('status','true')->get();
        $child = [];
        foreach ($GroupChild as $key => $value) {
            $child[$key]['child_id'] = $value->child_id;
            $child[$key]['child_name'] = Child::find($value->child_id)->name;
            $child[$key]['paymart_type'] = $value->paymart_type;
        }
        return $child;
    }
    public function groups_show($id){
        $about = $this->group_about($id);
        $tarbiyachilar = $this->group_tarbiyachi($about['tarbiyachi_id']);
        $yordamchilar = $this->group_yordamchi($about['yordamchi_id']);
        $ishKunlar = $this->ishKunlar($id);
        $ishKunlarSoni = count($this->ishKunlar($id));
        $children = $this->childrenGroups($id);
        return view('groups.index_show', compact('id','about','tarbiyachilar','yordamchilar','ishKunlar','ishKunlarSoni','children'));
    }
    public function group_update(EditGroupRequest $request){
        $data = $request->validated();
        $Group = Group::find($data['id']);
        $Group['group_name'] = $data['group_name'];
        $Group['price_month'] = $data['price_month'];
        $Group['price_day'] = $data['price_day'];
        $Group['status'] = $data['status'];
        $Group->save();
        return redirect()->back()->with('success', 'Guruh malumotlari yangilandi!');
    }
    public function groups_updates_tarbiyachi(Request $request){
        $guruh_id = $request->id;
        $user_id = $request->user_id;
        $GroupsTarbiyachi = GroupsTarbiyachi::where('group_id',$guruh_id)->where('type','tarbiyachi')->where('status',1)->first();
        $GroupsTarbiyachi->status = false;
        $GroupsTarbiyachi->end_time = date("Y-m-d");
        $GroupsTarbiyachi->save();
        GroupsTarbiyachi::create([
            'group_id' => $guruh_id,
            'user_id' => $user_id,
            'start_time' => date("Y-m-d"),
            'type' => 'tarbiyachi',
            'status' => true,
        ]);
        return redirect()->back()->with('success', 'Guruh tarbiyachisi yangilandi!');
    }
    public function groups_updates_yordamchi(Request $request){
        $guruh_id = $request->id;
        $user_id = $request->user_id;
        $GroupsTarbiyachi = GroupsTarbiyachi::where('group_id',$guruh_id)->where('type','yordamchi')->where('status',1)->first();
        $GroupsTarbiyachi->status = false;
        $GroupsTarbiyachi->end_time = date("Y-m-d");
        $GroupsTarbiyachi->save();
        GroupsTarbiyachi::create([
            'group_id' => $guruh_id,
            'user_id' => $user_id,
            'start_time' => date("Y-m-d"),
            'type' => 'yordamchi',
            'status' => true,
        ]);
        return redirect()->back()->with('success', 'Guruh yordamchisi yangilandi!');
    }
    public function groups_show_child($id){
        return view('groups.index_show_child', compact('id'));
    }
    public function groups_show_davomad($id){
        return view('groups.index_show_davomad', compact('id'));
    }
    public function groups_show_history($id){
        return view('groups.index_show_history', compact('id'));
    }
}

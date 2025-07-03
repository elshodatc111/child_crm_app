<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\User;
use App\Models\Group;
use App\Models\Child;
use App\Models\Kassa;
use App\Models\GroupChild;
use App\Models\ChildComment;
use App\Models\ChildParent;
use App\Models\PaymartChild;
use App\Http\Requests\StorePaymentRequest;

class CildController extends Controller{

    public function index(Request $request){
        $query = Child::where('children.status', 'active')
            ->join('group_children', 'group_children.child_id', '=', 'children.id')
            ->where('group_children.status', 'true')
            ->join('groups', 'group_children.group_id', '=', 'groups.id');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('children.name', 'like', '%' . $search . '%')
                ->orWhere('groups.group_name', 'like', '%' . $search . '%');
            });
        }
        $children = $query->select(
            'children.id',
            'children.name',
            'children.birthday',
            'groups.group_name',
            'children.balans'
        )->paginate(10);
        return view('child.index', compact('children'));
    }

    protected function child_about($id){
        $GroupChild = Child::find($id);
        $child = [];
        $child['name'] = $GroupChild->name;
        $child['addres'] = $GroupChild->address;
        $child['tkun'] = $GroupChild->birthday;
        $child['phone1'] = $GroupChild->phone1;
        $child['phone2'] = $GroupChild->phone2;
        $child['balans'] = $GroupChild->balans;
        $child['description'] = $GroupChild->description;
        $child['status'] = $GroupChild->status;
        $child['created_at'] = $GroupChild->created_at;
        $child['meneger'] = User::find($GroupChild->end_manager_id)->fio;
        $child['group'] = Group::find(GroupChild::where('child_id',$GroupChild->id)->first()->group_id)->group_name;
        return $child;
    }

    protected function childParents($id){
        $ChildParent = ChildParent::where('child_id',$id)->select('id','name','phone')->get();
        return $ChildParent;
    }

    protected function ChildComment($id){
        $ChildComment = ChildComment::where('child_id',$id)->get();
        $commit = [];
        foreach ($ChildComment as $key => $value) {
            $commit[$key]['id'] = $value->id;
            $commit[$key]['description'] = $value->description;
            $commit[$key]['user'] = User::find($value->user_id)->fio;
            $commit[$key]['created_at'] = $value->created_at;
        }
        return $commit;
    }

    public function show($id){
        $child = $this->child_about($id);
        $parent = $this->childParents($id);
        $commit = $this->ChildComment($id);
        $kassa = Kassa::first();
        return view('child.active.show',compact('id','child','parent','commit','kassa'));
    }

    public function child_update(Request $request){
        $Child = Child::find($request->id);
        $Child->name = $request->name;
        $Child->address = $request->address;
        $Child->birthday = $request->birthday;
        $Child->phone1 = $request->phone1;
        $Child->phone2 = $request->phone2;
        $Child->description = $request->description;
        $Child->status = $request->status;
        $Child->save();
        return redirect()->back()->with('success', 'O\'zgarishlar saqlandi!');
    }

    public function child_new_qarindosh(Request $request){
        ChildParent::create([
            'child_id' => $request->child_id,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        return redirect()->back()->with('success', 'Yangi qarindosh qo\'shildi!');
    }

    public function child_new_eslatma(Request $request){
        ChildComment::create([
            'child_id' => $request->child_id,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->back()->with('success', 'Eslatma saqlandi!');
    }

    protected function create_paymart_table($request){
        $child_id = $request['child_id'];
        $types = $request['type']; // naqt , plastik , qaytar_naqt , qaytar_plastik , chegirm']a
        $amount = $request['amount'];
        $child_parent_id = intval($request['child_parent_id']);
        $description = $request['description'];
        if($types == 'naqt' OR $types == 'plastik'){
            $type = $types;
            $status = 'tulov';
        }elseif($types == 'qaytar_naqt'){
            $type = 'naqt';
            $status = 'qaytar';
        }elseif($types == 'qaytar_plastik'){
            $type = 'plastik';
            $status = 'qaytar';
        }else{
            $type = 'chegirma';
            $status = 'chegirma';
        }
        PaymartChild::create([
            'child_id'=> $child_id,
            'child_parent_id'=> $child_parent_id,
            'amount'=> $amount,
            'type'=> $type,
            'description'=> $description,
            'status'=> $status,
            'user_id'=> auth()->user()->id,
        ]);
        return true;
    }

    protected function inkrementKassa($type,$status,$amount){
        $Kassa = Kassa::first();
        if($status=='tulov'){
            if($type=='naqt'){
                $Kassa->naqt = $Kassa->naqt + $amount;
            }else{
                $Kassa->plastik = $Kassa->plastik + $amount;
            }
        }else{
            if($type=='naqt'){
                $Kassa->naqt = $Kassa->naqt - $amount;
            }else{
                $Kassa->plastik = $Kassa->plastik - $amount;
            }
        }
        $Kassa->save();
        return true;
    }

    public function paymart_update_balans($request){
        $Child = Child::find($request['child_id']);
        if($request['type'] == 'naqt' OR $request['type'] == 'plastik'){
            $Child->balans = $Child->balans + $request['amount'];
            $this->inkrementKassa($request['type'],'tulov',$request['amount']);
        }elseif($request['type'] == 'qaytar_naqt' OR $request['type'] == 'qaytar_plastik'){
            $Child->balans = $Child->balans - $request['amount'];
            $typing = $request['type'] == 'qaytar_naqt'?'naqt':'plastik';
            $this->inkrementKassa($typing,'qaytar',$request['amount']);
        }else{
            $Child->balans = $Child->balans + $request['amount'];
        }
        $Child->save();
        return true;
    }

    protected function checkKassa($type,$amount){
        $Kassa = Kassa::first();
        $naqt = $Kassa->naqt;
        $plastik = $Kassa->plastik;
        if($type == 'qaytar_naqt' AND $naqt>=$amount){
            return false;
        }elseif($type == 'qaytar_plastik' AND $plastik>=$amount){
            return false;
        }else{
            return true;
        }
    }

    public function create_paymarts(StorePaymentRequest $request){
        $validates = $request->validated();
        if($validates['type'] == 'qaytar_naqt' OR $validates['type'] == 'qaytar_plastik'){
            if($this->checkKassa($validates['type'],$validates['amount'])){
                return redirect()->back()->with('error', 'Qaytarish uchun kassada mablag\' yetarli emas.');
            }
        }
        $create_paymart_table = $this->create_paymart_table($validates);
        $paymart_update_balans = $this->paymart_update_balans($validates);
        return redirect()->back()->with('success', 'To\'lov qabul qilindi!');
    }

    public function child_delete_qarindosh(Request $request){
        $ChildParent = ChildParent::find($request->id)->delete();
        return redirect()->back()->with('success', 'Yangi qarindosh o\'chirildi!');
    }

    public function show_group($id){
        return view('child.active.group_show',compact('id'));
    }

    public function show_davomad($id){
        return view('child.active.davomad_show',compact('id'));
    }

    public function show_paymart($id){
        return view('child.active.paymart_show',compact('id'));
    }
}

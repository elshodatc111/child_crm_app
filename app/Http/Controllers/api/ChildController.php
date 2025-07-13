<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Group, Child, Kassa, GroupChild, ChildComment, ChildParent, PaymartChild, ChildDavomad, BalansHistory};
use Illuminate\Support\Facades\DB;

class ChildController extends Controller{
    // Barcha aktiv bolalar
    public function index(){
        $query = Child::where('children.status', 'active')
            ->join('group_children', 'group_children.child_id', '=', 'children.id')
            ->where('group_children.status', 'true')
            ->join('groups', 'group_children.group_id', '=', 'groups.id')->select(
            'children.id',
            'children.name',
            'children.birthday',
            'groups.group_name',
            'children.balans'
        )->get();

        return response()->json([
            'success' => true,
            'children' => $query,
            'message' => "Aktiv bolalar",
        ], 200);
    }
    // Barcha qarzdor bolalar
    public function debet(){
        $children = Child::where('balans', '<', 0)
            ->select('id', 'name', 'birthday', 'balans')
            ->get();

        return response()->json([
            'success' => true,
            'children' => $children,
            'message' => "Qarzdor bolalar",
        ], 200);
    }
    // Bola haqida
    public function show($id){
        $child = Child::with([
            'manager:id,fio',
            'groupChild.group:id,group_name',
            'childParents:id,child_id,name,phone',
            'comments.user:id,fio'
        ])->find($id);

        if (!$child) {
            return response()->json([
                'success' => false,
                'message' => "Bola topilmadi.",
            ], 404);
        }

        $about = [
            'name' => $child->name,
            'addres' => $child->address,
            'tkun' => $child->birthday,
            'phone1' => $child->phone1,
            'phone2' => $child->phone2,
            'balans' => $child->balans,
            'description' => $child->description,
            'status' => $child->status,
            'created_at' => $child->created_at->format('Y-m-d H:i:s'),
            'meneger' => optional($child->manager)->fio,
            'group' => optional(optional($child->groupChild)->group)->group_name ?? '',
        ];

        $parents = $child->childParents;
        $comments = $child->comments->map(function ($item) {
            return [
                'id' => $item->id,
                'description' => $item->description,
                'user' => optional($item->user)->fio,
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'about' => $about,
            'parents' => $parents,
            'comments' => $comments,
            'message' => "Bola haqida ma'lumot.",
        ], 200);
    }
    // Bola to'lovlari
    public function paymart($id){
        $PaymartChild = PaymartChild::where('child_id',$id)->get();
        $paymart = [];
        foreach ($PaymartChild as $key => $value) {
            $paymart[$key]['type'] = $value->type;
            $paymart[$key]['amount'] = $value->amount;
            $paymart[$key]['status'] = $value->status;
            $paymart[$key]['about'] = $value->description;
            $paymart[$key]['qarindosh'] = ChildParent::find($value->child_parent_id)->name;
            $paymart[$key]['vaqt'] = $value->created_at;
            $paymart[$key]['meneger'] = User::find($value->user_id)->fio;
        }

        return response()->json([
            'success' => true,
            'payments' => $paymart,
            'message' => "Bola to‘lovlari",
        ], 200);
    }
    // Guruhlar tarixi
    public function groups($id){
        $groups = GroupChild::with(['group:id,group_name', 'startManager:id,fio', 'endManager:id,fio'])
            ->where('child_id', $id)
            ->latest('start_time')
            ->get()
            ->map(fn($item) => [
                'group_id' => $item->group_id,
                'group_name' => optional($item->group)->group_name,
                'start_time' => $item->start_time,
                'end_time' => $item->end_time ?? '',
                'start_comment' => $item->start_comment,
                'end_comment' => $item->end_comment ?? '',
                'paymart_type' => $item->paymart_type,
                'status' => $item->status,
                'start_manager' => optional($item->startManager)->fio,
                'end_manager' => optional($item->endManager)->fio ?? '',
            ]);

        return response()->json([
            'success' => true,
            'groups' => $groups,
            'message' => "Bola guruhlar tarixi",
        ], 200);
    }
    // Davomad tarixi
    public function davomad($id){
        $child = Child::find($id);
        if (!$child) {
            return response()->json(['success' => false, 'message' => "Bola topilmadi"], 404);
        }

        $records = ChildDavomad::with(['group:id,group_name', 'user:id,fio'])
            ->where('child_id', $id)
            ->latest('id')
            ->get()
            ->map(fn($item) => [
                'guruh' => optional($item->group)->group_name,
                'data' => $item->data,
                'amount' => $item->amount,
                'status' => $item->status,
                'meneger' => optional($item->user)->fio,
                'created_at' => $item->created_at->format('Y-m-d H:i:s'),
            ]);

        return response()->json([
            'success' => true,
            'attendance' => $records,
            'message' => "Davomad tarixi",
        ], 200);
    }
    // Yangi qarindosh
    public function create_qarindosh(Request $request){
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
        ], [
            'child_id.required' => 'Bola ID kiritilishi shart.',
            'child_id.exists' => 'Bunday bola topilmadi.',
            'name.required' => 'Ism majburiy.',
            'phone.required' => 'Telefon raqami majburiy.',
            'phone.regex' => 'Telefon raqami +998 XX XXX XX XX formatda bo‘lishi kerak.',
        ]);
        try {
            ChildParent::create([
                'child_id' => $validated['child_id'],
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]);
            return response()->json([
                'success' => true,
                'message' => "Yangi qarindosh muvaffaqiyatli qo'shildi.",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Qarindoshni qo‘shishda xatolik yuz berdi.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // Qarindoshni o'chirish
    public function create_qarindosh_delete(Request $request){
        $validated = $request->validate([
            'id' => 'required|exists:child_parents,id',
        ], [
            'id.required' => 'ID kiritilishi shart.',
            'id.exists' => 'Qarindosh topilmadi.',
        ]);
        try {
            $childParent = ChildParent::find($validated['id']);
            if (!$childParent) {
                return response()->json([
                    'success' => false,
                    'message' => "Qarindosh topilmadi yoki allaqachon o'chirilgan.",
                ], 404);
            }
            $childParent->delete();
            return response()->json([
                'success' => true,
                'message' => "Qarindosh muvaffaqiyatli o'chirildi.",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Qarindoshni o‘chirishda xatolik yuz berdi.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // Yangi kommentariya
    public function create_comment(Request $request){
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'description' => 'required|string|max:1000',
        ], [
            'child_id.required' => 'Bola ID kiritilishi shart.',
            'child_id.exists' => 'Bunday bola topilmadi.',
            'description.required' => 'Izoh kiritilishi shart.',
            'description.max' => 'Izoh 1000 ta belgidan oshmasligi kerak.',
        ]);
        try {
            ChildComment::create([
                'child_id' => $validated['child_id'],
                'description' => $validated['description'],
                'user_id' => auth()->id(),
            ]);
            return response()->json([
                'success' => true,
                'message' => "Yangi izoh muvaffaqiyatli qoldirildi.",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Izoh qoldirishda xatolik yuz berdi.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // Yangi to'lov
    public function create_paymart(Request $request){
        $data = $request->validate([
            'child_id' => 'required|exists:children,id',
            'child_parent_id' => 'required|exists:child_parents,id',
            'type' => 'required|in:naqt,plastik,qaytar_naqt,qaytar_plastik,chegirma',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);
        if (in_array($data['type'], ['qaytar_naqt', 'qaytar_plastik'])) {
            if (!$this->checkKassaHasEnough($data['type'], $data['amount'])) {
                return response()->json([
                    'success' => false,
                    'message' => "Kassada yetarli mablag' mavjud emas.",
                ], 400);
            }
        }
        DB::beginTransaction();
        try {
            $map = [
                'naqt' => ['type' => 'naqt', 'status' => 'tulov'],
                'plastik' => ['type' => 'plastik', 'status' => 'tulov'],
                'qaytar_naqt' => ['type' => 'naqt', 'status' => 'qaytar'],
                'qaytar_plastik' => ['type' => 'plastik', 'status' => 'qaytar'],
                'chegirma' => ['type' => 'chegirma', 'status' => 'chegirma'],
            ];
            $resolved = $map[$data['type']];
            PaymartChild::create([
                'child_id' => $data['child_id'],
                'child_parent_id' => intval($data['child_parent_id']),
                'amount' => $data['amount'],
                'type' => $resolved['type'],
                'status' => $resolved['status'],
                'description' => $data['description'] ?? '',
                'user_id' => auth()->id(),
            ]);
            $this->updateKassa($resolved['type'], $resolved['status'], $data['amount']);
            $this->updateBalans($data['child_id'], $data['type'], $data['amount']);
            if ($resolved['status'] === 'qaytar') {
                $this->logQaytarHistory($data['type'], $data['amount']);
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "To'lov muvaffaqiyatli bajarildi.",
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage(),
            ], 500);
        }
    }
    protected function checkKassaHasEnough($type, $amount){
        $kassa = Kassa::first();
        return match ($type) {
            'qaytar_naqt' => $kassa->naqt >= $amount,
            'qaytar_plastik' => $kassa->plastik >= $amount,
            default => true,
        };
    }
    protected function updateKassa($type, $status, $amount){
        $kassa = Kassa::first();
        if ($status === 'tulov') {
            $type === 'naqt' ? $kassa->naqt += $amount : $kassa->plastik += $amount;
        } elseif ($status === 'qaytar') {
            $type === 'naqt' ? $kassa->naqt -= $amount : $kassa->plastik -= $amount;
        }
        $kassa->save();
    }
    protected function updateBalans($child_id, $type, $amount){
        $child = Child::findOrFail($child_id);
        if (in_array($type, ['naqt', 'plastik', 'chegirma'])) {
            $child->balans += $amount;
        } elseif (in_array($type, ['qaytar_naqt', 'qaytar_plastik'])) {
            $child->balans -= $amount;
        }
        $child->save();
    }
    protected function logQaytarHistory($type, $amount){
        $status = $type === 'qaytar_naqt' ? 'naqt_qaytar' : 'plastik_qaytar';
        BalansHistory::create([
            'status' => $status,
            'type' => 'success',
            'amount' => $amount,
            'start_comment' => 'To‘lov qaytarildi',
            'start_user_id' => auth()->id(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\Group;
use App\Models\Child;
use App\Models\GroupChild;

class ChilDebitController extends Controller
{
    public function index_debit(Request $request){
        $query = Child::where('children.balans','<',0)
            ->join('group_children', 'group_children.child_id', '=', 'children.id')
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
        return view('child.index_debit', compact('children'));
    }
}

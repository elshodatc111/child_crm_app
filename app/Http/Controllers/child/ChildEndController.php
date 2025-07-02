<?php

namespace App\Http\Controllers\child;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VacancyChild;
use App\Models\VacancyChildComment;
use App\Models\Group;
use App\Models\Child;
use App\Models\GroupChild;

class ChildEndController extends Controller
{
    public function index_end(Request $request){
        $query = Child::join('group_children', 'group_children.child_id', '=', 'children.id')
            ->where('group_children.status', 'false');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('children.name', 'like', '%' . $search . '%');
            });
        }
        $children = $query->select(
            'children.id',
            'children.name',
            'children.birthday',
            'children.balans'
        )->paginate(10);
        return view('child.index_end', compact('children'));
    }
}

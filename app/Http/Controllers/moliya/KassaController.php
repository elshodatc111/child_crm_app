<?php

namespace App\Http\Controllers\moliya;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balans;
use App\Models\BalansHistory;
use App\Models\Kassa;
use Carbon\Carbon;

class KassaController extends Controller
{
    public function index(){
        $Kassa = Kassa::first();
        return view('moliya.kassa',compact('Kassa'));
    }
}

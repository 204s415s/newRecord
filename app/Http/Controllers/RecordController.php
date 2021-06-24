<?php

namespace App\Http\Controllers;

use App\User;
use App\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function top() {
        $user = Auth::user();
        return view('top')->with(['user' => $user]);
    }
}

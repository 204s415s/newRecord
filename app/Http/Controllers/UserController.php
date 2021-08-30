<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\GoogleSheet;
use App\Student;

class UserController extends Controller
{
    public function index (User $user) {
        $users = $user->all();
        return $users;
    }
    
    // public function google() {
    //     $sheets = GoogleSheet::instance();
    //     $sheet_id = '17OK3SKJ7d2sV6x02yoqr19aw4RQyZWHVbjyBTw-Ch3A';
    //     $range = 'B12:I46';
    //     $response = $sheets->spreadsheets_values->get($sheet_id, $range);
    //     $values = $response->getValues();
    //     dd($values);
    // }
    
    public function nowUser() {
        return Auth::id();
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\GoogleSheet;

class UserController extends Controller
{
    public function index (User $user) {
        $users = $user->all();
        return $users;
    }
    
    public function google() {
        $sheets = GoogleSheet::instance();
        
        $sheet_id = '17OK3SKJ7d2sV6x02yoqr19aw4RQyZWHVbjyBTw-Ch3A';
        $range = 'A1:I46';
        $response = $sheets->spreadsheets_values->get($sheet_id, $range);
        $values = $response->getValues();
        return $values;
    }
}

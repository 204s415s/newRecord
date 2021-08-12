<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleSheet {
    public static function instance() {
        // $credentials_path = storage_path('app/json/lev-college-43ca656233f1.json');
        // $credential = env('GOOGLE_SHEET_CREDENTIAL');
        $client = new \Google_Client();
        $client->setDeveloperKey("GOOGLE_CREDENTIALS");
        $client->setScopes([[\Google_Service_Sheets::SPREADSHEETS]]);
        $client->setAuthConfig($credential);
        return new \Google_Service_Sheets($client);
    }
}

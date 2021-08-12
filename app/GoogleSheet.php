<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleSheet {
    public static function instance() {
        $credentials_file = storage_path('app/json/lev-college-43ca656233f1.json');
        if(! file_exists($credentials_file)) {
            file_put_contents('credentials.json', getenv('GOOGLE_CREDENTIALS'));
            $credentials_file = 'credentials.json';
        }
        
        $client = new \Google_Client();
        $client->setScopes([[\Google_Service_Sheets::SPREADSHEETS]]);
        $client->setAuthConfig($credentials_file);
        return new \Google_Service_Sheets($client);
    }
}

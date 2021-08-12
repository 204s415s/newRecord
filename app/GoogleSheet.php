<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleSheet {
    public static function instance() {
        //herokuで動かしたいやつ
        // $credential = env('GOOGLE_SHEET_CREDENTIAL');
        // putenv('GOOGLE_SHEET_CREDENTIAL');
        // $client = new \Google_Client();
        // $client->useApplicationDefaultCredentials();
        // //$client->setDeveloperKey("GOOGLE_CREDENTIALS");
        // $client->setScopes([[\Google_Service_Sheets::SPREADSHEETS]]);
        // //$client->setAuthConfig($credential);
        // return new \Google_Service_Sheets($client);
        
        
        
        $credentials_path = app_path('google-credentials.json');
        $client = new \Google_Client();
        $client->setScopes([[\Google_Service_Sheets::SPREADSHEETS]]);
        $client->setAuthConfig($credentials_path);
        return new \Google_Service_Sheets($client);
        
        
        //ローカルで動くやつ
        // $credentials_path = storage_path('app/json/lev-college-43ca656233f1.json');
        // $client = new \Google_Client();
        // $client->setScopes([[\Google_Service_Sheets::SPREADSHEETS]]);
        // $client->setAuthConfig($credentials_path);
        // return new \Google_Service_Sheets($client);
    }
}

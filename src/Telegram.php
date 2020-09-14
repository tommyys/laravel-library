<?php

// use this link to get your chat id
// https://api.telegram.org/bot677341098:AAEX6-kv_4gC8y-cvuFcwZKA6mbzjBXj3eU/getUpdates

namespace Axstarzy\LaravelLibrary;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Exception;
use Log;

class Telegram {

    public static function notification($message, $chatID=null){
        if(!$chatID){
            $chatID = env('TELEGRAM_NOTI_GROUP');
        }
        // if env not production dont send
        if(env('APP_ENV') != "production"){
            return false;
        };

        $params = [
            'chat_id' => $chatID,
            'text' => $message
        ];
        
        return self::httpGetRequest('sendMessage', $params);
    }

    public static function imgNotification($image_path, $chatID = null){
        if(!$chatID){
            $chatID = env('TELEGRAM_NOTI_GROUP');
        }
        // if env not production dont send
        if(env('APP_ENV') != "production"){
            return false;
        };

        $params = [
            'chat_id' => $chatID,
            'photo' => $image_path
        ];
        
        return self::httpGetRequest('sendphoto', $params);
    }

    private static function httpGetRequest($route, $params){
        $client = new Client(['verify' => false ]);
        $params['parse_mode'] = 'Markdown';
        $params['disable_web_page_preview'] = True;
        $bot = env('TELEGRAM_BOT_ID', "bot677341098:AAEX6-kv_4gC8y-cvuFcwZKA6mbzjBXj3eU");
        $reqURL = "https://api.telegram.org/".$bot."/" . $route . "?".http_build_query($params);
        try {
          $res = $client->get($reqURL);
        } catch(Exception $e) {
            Log::info("Telegram sent failed");
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
   
}


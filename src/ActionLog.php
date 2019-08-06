<?php

namespace Axstarzy\LaravelLibrary;

use Illuminate\Database\Eloquent\Model;

use Log;

class ActionLog extends Model
{
    protected $table = 'action_log';

    protected $guarded = [];

    public static function createRecord($request){
        $input = "";

        $useragent = $request->server('HTTP_USER_AGENT');
        if(empty($useragent)) {
            //Error prevent for user qhh3106
            $useragent = 'NO USER AGENT';
        }

        $ip = $request->ip();
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        $input = implode_recur($request->all());

        $log = self::create([
            'ip'=> $ip,
            'user_agent' => $useragent,
            'function' => $request->url(),
            'input' => $input,
        ]);
        if(auth()->check()){
            $log->update(['user_id' => auth()->user()->id]);
        }

    }

    public static function check30sGap($request){
        if(env('APP_ENV') == "local"){
            return true;
        }

        $ip = $request->ip();
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }

        $action = self::where('ip', $ip)
                    ->where('function', $request->url())
                    ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime("-30 seconds")))
                    ->get();
	
        if(sizeof($action) > 1){
            return false;
        }
        
        return true;
    }
}

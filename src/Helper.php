<?php

if (! function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return app('translator');
        }
        
        if(!Lang::has($key)){
            $stringParts = explode(".", $key);
            switch($stringParts[0]){
                case "msg":
                    return str_replace("msg.", "", $key);
                break;
                case "description":
                    return str_replace("description.", "", $key);
                break;
                default:
                case "string":
                    return str_replace("string.", "", $key);
                break;
            }
        }

        return app('translator')->trans($key, $replace, $locale);
    }
}

if (! function_exists('env')) {
    function env($name, $default=null){
        $value = $default;
        $fn = fopen(base_path('.env'),"r");
        while(! feof($fn))  {
            $result = fgets($fn);
            if(trim($result)){
                $var = explode("=", trim($result));
                $key = $var[0];
                $val = $var[1];
                if($key == $name){
                    $value = $val;
                }
            }
        }
        fclose($fn);
        return $value;
    }
}

if (! function_exists('sqlLog')) {
    /**
     * Translate the given message.
     *
     * @param  object  $query
     * @return Log
     */
    function sqlLog($query){
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        foreach($bindings as $value){
            $pos = strpos($sql, "?");
            if ($pos !== false) {
                $sql = substr_replace($sql, '"'.$value.'"', $pos, strlen("?"));
            }
        }
        Log::info($sql);
    }
}

if (! function_exists('getStatusLabel')) {
    function getStatusLabel($status){
        switch($status){
            case 0:
                $value = 'default';
            break;
            case 1:
                $value = 'success';
            break;
            case 2:
                $value = 'danger';
            break;
            default:
                $value = 'default';
            break;
        }
        return $value;
    }
}

if (! function_exists('output')) {
    function output($string){
        Log::info($string);
        echo $string."\n";
    }
}

if (! function_exists('implode_recur')) {
    function implode_recur($arrayvar) {
        $output = "";
        foreach ($arrayvar as $key => $value){
            if (is_array ($value)) {
                $output .= $key.'=>'.implode_recur($value); // Recursive array 
            } else{
                $output .= $key.'=>'.$value.',';
            }                   
        }

        return "[".$output."]";
    }
}

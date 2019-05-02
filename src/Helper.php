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

if (! function_exists('sqlLog')) {

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
                $value = 'label-default';
            break;
            case 1:
                $value = 'label-success';
            break;
            case 2:
                $value = 'label-danger';
            break;
            case 4:
                $value = 'label-danger faa-flash animated';
            break;
            case 5:
                $value = 'label-danger faa-flash animated';
            break;
            default:
                $value = 'label-default';
            break;
        }
        return $value;
    }
}


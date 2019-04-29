<?php

if (! function_exists('transt')) {
    /**
     * Translate the given message.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function transt($id = null, $parameters = [], $domain = 'messages', $locale = null)
    {
        if (is_null($id)) {
            return app('translator');
        }
        
        if(!Lang::has($id)){
            $stringParts = explode(".", $id);
            switch($stringParts[0]){
                case "msg":
                    return str_replace("msg.", "", $id);
                break;
                case "description":
                    return str_replace("description.", "", $id);
                break;
                default:
                case "string":
                    return str_replace("string.", "", $id);
                break;
            }
        }

        return app('translator')->trans($id, $parameters, $domain, $locale);
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


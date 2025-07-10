<?php

function setting($key, $multiple = false)
{
    try {
        if(!$multiple){
            $vlaue = $GLOBALS['app_settings']->where("setting_title", $key)->first();
            if ($vlaue) {
                return $vlaue->value;
            } else {
                return '';
            }
        }else{
            $vlaues = $GLOBALS['app_settings']->where("setting_title", $key)->all();
            return $vlaues;
        }
    } catch (\Throwable $th) {
        var_dump($th->getMessage());
    }
}

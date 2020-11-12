<?php

if(! function_exists('responseJson')) {
    function responseJson($data) {
        if(is_array($data)){
            $data = json_encode($data);
        }
        return $data;
    }
}
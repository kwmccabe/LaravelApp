<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display request info
     */
    public function get_request(Request $request)
    {
        // attributes, request , query , server , files , cookies , headers
        $exclude = array('server');

        $result = "<b>".get_class($request)." :</b>\n";
        foreach($request as $key => $value) {
            $result .= "<b>$key</b> => ".get_class($value)." : \n";
            if (!in_array($key,$exclude)) {
                $result .= print_r($value,true)."\n";
            } else {
                $result .= "[excluded] \n\n";
            }
        }
        return '<pre>'.$result.'</pre>';
    }

    /**
     * Display datetime info
     */
    public function get_date()
    {
        $timer =- hrtime(true);

        $result = "";
        $result .= "date(DATE_RFC2822) => " . date(DATE_RFC2822) . "\n";
        $result .= "time() => " . time() . "\n";
        $result .= "microtime(true) => " . microtime(true) . "\n";
        $result .= "hrtime(true) => " . hrtime(true) . "\n";

        $timer += hrtime(true);
        //$result .= "timer: " . $timer . " nanoseconds\n";
        $result .= "timer: " . $timer/1e+6 . " milliseconds\n";

        return '<pre>'.$result.'</pre>';
    }


}

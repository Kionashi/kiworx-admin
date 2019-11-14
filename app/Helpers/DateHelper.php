<?php

namespace App\Helpers;

abstract class DateHelper
{
    
    public static function relativeTime($time)
    {
        if(!is_numeric($time))
            $time = strtotime($time);
            
            $periods = array("second", "minute", "hour", "day", "week", "month", "year", "age");
            $lengths = array("60","60","24","7","4.35","12","100");
            
            $now = time();
            
            $difference = $now - $time;
            if ($difference <= 10 && $difference >= 0)
                return $tense = 'just now';
                elseif($difference > 0)
                $tense = 'ago';
                elseif($difference < 0)
                $tense = 'later';
                
                for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                    $difference /= $lengths[$j];
                }
                
                $difference = round($difference);
                
                $period =  $periods[$j] . ($difference >1 ? 's' :'');
                return "{$difference} {$period} {$tense} ";
    }
    
}


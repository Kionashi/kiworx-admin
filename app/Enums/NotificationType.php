<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

abstract class NotificationType extends Enums
{
    const GENERAL = 'GENERAL';
    const RECRUIT = 'RECRUIT';
    const CALENDAR = 'CALENDAR';

    public static function values() {
        return array(
            'GENERAL'   => NotificationType::GENERAL, 
            'RECRUIT'       => NotificationType::RECRUIT,
            'CALENDAR'       => NotificationType::CALENDAR
        );
    }
    
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case NotificationType::GENERAL:
                return 'General';
            case NotificationType::RECRUIT:
                return 'Recruit';
            case NotificationType::CALENDAR:
                return 'Event';
        }
    }
}
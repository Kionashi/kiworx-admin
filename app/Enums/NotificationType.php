<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

abstract class NotificationType extends Enums
{
    const GENERAL = 'GENERAL';
    const HIRING = 'HIRING';
    const CALENDAR = 'CALENDAR';

    public static function values() {
        return array(
            'GENERAL'   => NotificationType::GENERAL, 
            'HIRING'       => NotificationType::HIRING,
            'CALENDAR'       => NotificationType::CALENDAR
        );
    }
    
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case NotificationType::GENERAL:
                return 'General';
            case NotificationType::HIRING:
                return 'Hiring';
            case NotificationType::CALENDAR:
                return 'Event';
        }
    }
}
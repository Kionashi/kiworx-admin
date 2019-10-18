<?php

namespace App\Enums;


abstract class OfferWorkingDays extends Enums
{
    const PART_TIME = 'PART_TIME';
    const FULL_TIME = 'FULL_TIME';
    
    public static function values() {
        return array(
            'PART_TIME'    => OfferWorkingDays::PART_TIME,
            'FULL_TIME'   => OfferWorkingDays::FULL_TIME
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferWorkingDays::PART_TIME:
                return 'Part time';
            case OfferWorkingDays::FULL_TIME:
                return 'Full time';
        }
    }
}
<?php

namespace App\Enums;


abstract class OfferWorkingLanguages extends Enums
{
    const ENGLISH = 'ENGLISH';
    const SPANISH = 'SPANISH';
    const FRENCH = 'FRENCH';
    
    public static function values() {
        return array(
            'ENGLISH'       => OfferWorkingLanguages::ENGLISH,
            'SPANISH'       => OfferWorkingLanguages::SPANISH,
            'FRENCH'        => OfferWorkingLanguages::FRENCH,
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferWorkingLanguages::ENGLISH:
                return 'Inglés';
            case OfferWorkingLanguages::SPANISH:
                return 'Español';
            case OfferWorkingLanguages::FRENCH:
                return 'Francés';
        }
    }
}
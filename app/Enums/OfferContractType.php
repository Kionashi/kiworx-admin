<?php

namespace App\Enums;


abstract class OfferContractType extends Enums
{
    const PRACTICES = 'PRACTICES';
    const DURATION_DETERMINED = 'DURATION_DETERMINED';
    const FREELANCE = 'FREELANCE';
    const UNDEFINED = 'UNDEFINED';

    public static function values() {
        return array(
            'PRACTICES'    => OfferContractType::PRACTICES, 
            'DURATION_DETERMINED'   => OfferContractType::DURATION_DETERMINED,
            'FREELANCE'  => OfferContractType::FREELANCE,
            'UNDEFINED'  => OfferContractType::UNDEFINED
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferContractType::PRACTICES:
                return 'Prácticas';
            case OfferContractType::DURATION_DETERMINED:
                return 'Duración determinada';
            case OfferContractType::FREELANCE:
                return 'Freelance';
            case OfferContractType::UNDEFINED:
                return 'Indefinido';
        }
    }
}
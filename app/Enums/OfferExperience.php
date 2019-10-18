<?php

namespace App\Enums;


abstract class OfferExperience extends Enums
{
    const PRACTICES = 'PRACTICES';
    const ONE_TO_THREE_YEARS= 'ONE_TO_TREE_YEARS';
    const THREE_TO_FIVE_YEARS= 'THREE_TO_FIVE_YEARS';
    const FIVE_YEARS_OR_MORE= 'FIVE_YEARS_OR_MORE';

    public static function values() {
        return array(
            'PRACTICES'    => OfferExperience::PRACTICES, 
            'ONE_TO_THREE_YEARS'   => OfferExperience::ONE_TO_THREE_YEARS,
            'THREE_TO_FIVE_YEARS'  => OfferExperience::THREE_TO_FIVE_YEARS,
            'FIVE_YEARS_OR_MORE'  => OfferExperience::FIVE_YEARS_OR_MORE
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferExperience::PRACTICES:
                return 'Prácticas';
            case OfferExperience::ONE_TO_THREE_YEARS:
                return '1 a 3 años';
            case OfferExperience::THREE_TO_FIVE_YEARS:
                return '3 a 5 años';
            case OfferExperience::FIVE_YEARS_OR_MORE:
                return 'más de 5 años';
        }
    }
}
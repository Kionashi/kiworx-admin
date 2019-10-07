<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;

abstract class OfferCategory extends Enums
{
    const IT = 'IT';
    const MARKETING = 'MARKETING';
    const BUSINESS = 'BUSINESS';

    public static function values() {
        return array(
            'IT'        => OfferCategory::IT, 
            'MARKETING' => OfferCategory::MARKETING,
            'BUSINESS'  => OfferCategory::BUSINESS
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferCategory::IT:
                return 'IT';
            case OfferCategory::MARKETING:
                return 'Marketing';
            case OfferCategory::BUSINESS:
                return 'Negocios';
        }
    }

}
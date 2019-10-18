<?php

namespace App\Enums;


abstract class OfferApplicationStatus extends Enums
{
    const ACCEPTED = 'ACCEPTED';
    const PENDING = 'PENDING';
    const REJECTED = 'REJECTED';
    
    public static function values() {
        return array(
            'ACCEPTED'    => OfferApplicationStatus::ACCEPTED,
            'PENDING'   => OfferApplicationStatus::PENDING,
            'REJECTED'   => OfferApplicationStatus::REJECTED
        );
    }
    
    public static function getFriendlyName($enum) {
        switch ($enum) {
            case OfferApplicationStatus::ACCEPTED:
                return 'Aceptado';
            case OfferApplicationStatus::PENDING:
                return 'Pendiente';
            case OfferApplicationStatus::REJECTED:
                return 'Rechazado';
        }
    }
}
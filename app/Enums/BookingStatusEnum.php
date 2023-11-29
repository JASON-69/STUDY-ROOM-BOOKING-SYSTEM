<?php

namespace App\Enums;

use App\Traits\EnumToArray;
enum BookingStatusEnum : string {
    use EnumToArray;
    
    case BOOKED = "Booked";
    case APPROVED = "Approved";
    case REJECTED = "Rejected";
}
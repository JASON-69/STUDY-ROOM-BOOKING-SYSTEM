<?php

namespace App\Enums;

use App\Traits\EnumToArray;
enum BriefDescription : string {
    use EnumToArray;
    
    case DISCUSSION = "Discussion";
    case EVENT = "Event";
    case PROGRAMME = "Programme";
}
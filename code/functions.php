<?php


function modCalc($atributo) {
    switch ($atributo){
        case ($atributo<=4): $mod="-10";
        return $mod;
        case ($atributo<=7): $mod="-9";
        return $mod;
        case ($atributo<=11): $mod="-8";
        return $mod;
        case ($atributo<=15): $mod="-7";
        return $mod;
        case ($atributo<=19): $mod="-6";
        return $mod;
        case ($atributo<=23): $mod="-5";
        return $mod;
        case ($atributo<=27): $mod="-4";
        return $mod;
        case ($atributo<=31): $mod="-3";
        return $mod;
        case ($atributo<=35): $mod="-2";
        return $mod;
        case ($atributo<=39): $mod="-1";
        return $mod;
        case ($atributo<=44): $mod="0";
        return $mod;
        case ($atributo<=49): $mod="+1";
        return $mod;
        case ($atributo<=54): $mod="+2";
        return $mod;
        case ($atributo<=59): $mod="+3";
        return $mod;
        case ($atributo<=64): $mod="+4";
        return $mod;
        case ($atributo<=70): $mod="+5";
        return $mod;
        case ($atributo<=76): $mod="+6";
        return $mod;
        case ($atributo<=82): $mod="+7";
        return $mod;
        case ($atributo<=89): $mod="+8";
        return $mod;
        case ($atributo<=99): $mod="+9";
        return $mod;
        case ($atributo>=100): $mod="+10";
        return $mod;
    }

    echo $mod;

}
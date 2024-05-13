<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnyController extends Controller
{
    //

    public static function DayToHari($day){
        if(is_numeric($day)){
            switch ($day) {
                case '0':
                    return 'senin';
                case '1':
                    return 'selasa';
                case '2':
                    return 'rabu';
                case '3':
                    return 'kamis';
                case '4':
                    return 'jumat';
                case '5':
                    return 'sabtu';
                case '6':
                    return 'minggu';

                default:
                    return false;
            }
        }

        switch ($day) {
            case 'Mon':
                return 'senin';
            case 'Tue':
                return 'selasa';
            case 'Wed':
                return 'rabu';
            case 'Thu':
                return 'kamis';
            case 'Fri':
                return 'jumat';
            case 'Sat':
                return 'sabtu';
            case 'Sun':
                return 'minggu';
            case 'Monday':
                return 'senin';
            case 'Tuesday':
                return 'selasa';
            case 'Wednesday':
                return 'rabu';
            case 'Thursday':
                return 'kamis';
            case 'Friday':
                return 'jumat';
            case 'Saturday':
                return 'sabtu';
            case 'Sunday':
                return 'minggu';

            default:
                return false;
        }
    }
}

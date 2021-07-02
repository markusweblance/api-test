<?php


namespace Api;
use Api\City;

class GetController
{

    public static function get($url = [])
    {
        if (!empty($url[2])){
            switch ($url[1]){
                case 'city':
                    $cities = new City();
                    return $cities->getCity($url[2]);
            }
        } else {
            switch ($url[1]){
                case 'city':
                    $cities = new City();
                    return $cities->getCities();
            }
        }
    }

}
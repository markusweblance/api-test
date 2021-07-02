<?php


namespace Api;

use Api\City;

class PostController
{
    /**
     * @param $title
     * @param array $url
     * @return array|string|null
     */
    public static function postCity($title, $url = [])
    {
        if ($url[1] == 'city') {
            $city = new City();
            return $city->setCity($title);
        } else {
            return null;
        }
    }

    /**
     * @param $id
     * @param $title
     * @param array $url
     * @return int|string|null
     */
    public static function renameCity($id, $title, $url= []){
        if ($url[1] == 'city') {
            $city = new City();
            return $city->updateCity($id, $title);
        } else {
            return null;
        }
    }

    public static function delete($id, $url){
        if ($url[1] == 'city') {
            $city = new City();
            return $city->deleteCity($id);
        } else {
            return null;
        }
    }
}
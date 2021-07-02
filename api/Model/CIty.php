<?php


namespace Api;

use RedBeanPHP\R;

class City extends Connect
{

    /**
     * @return array|null
     */
    public function getCities()
    {
        return R::getAll('SELECT * FROM `city`');
    }

    /**
     * @param $id
     * @return array|null
     */
    public function getCity($id)
    {
        return R::getRow('SELECT * FROM `city` WHERE `id` LIKE ? LIMIT 1',
            ["%$id%"]
        );
    }

    /**
     * @param $title
     * @return array|string|null
     * @throws \RedBeanPHP\RedException\SQL
     */
    public function setCity($title)
    {
        if (R::getRow('SELECT * FROM `city` WHERE `title` LIKE ? LIMIT 1',
            ["%$title%"]
        )) {
            return 'This data is already in the database';
        }
        $city = R::dispense('city');
        $city->title = $title;
        $id = R::store($city);

        if ($id) {
            return R::getRow('SELECT * FROM `city` WHERE `id` LIKE ? LIMIT 1',
                ["%$id%"]
            );
        } else {
            return 'Error';
        }
    }

    /**
     * @param $id
     * @param $title
     * @return mixed|string|null
     * @throws \RedBeanPHP\RedException\SQL
     */
    public function updateCity($id, $title)
    {
        $city = R::load('city', $id);
        $city->title = $title;
        $city_id = R::store($city);
        $up_city = R::load('city', $city_id);
        if ($city_id) {
            return $up_city->title;
        } else {
            return 'Error';
        }
    }

    /**
     * @param $id
     * @return string
     */
    public function deleteCity($id)
    {
        $city = R::load('city', $id);
        R::trash($city);
        return 'DELETE';
    }

}
<?php


namespace Api;

use RedBeanPHP\R;
use Exception;

class Connect
{
    public function __construct()
    {
        try {
            R::setup('mysql:host=localhost;dbname=api-test', 'api-test', 'ib2J07vemDlFsofk', false);
            if (!R::testConnection()) {
                throw new Exception('No DB');
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

    }

}
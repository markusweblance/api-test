<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


use Api\GetController;
use Api\PostController;


require_once '../vendor/autoload.php';
require_once 'Helpers/dump.php';
$url = explode('/', $_GET['q']);
array_unshift($url, $_SERVER['REQUEST_METHOD']);

switch ($url[0]) {
    case 'GET':
        $get = GetController::get($url);
        if ($get) {
            echo json_encode($get);
        } else {
            echo json_encode(null);
        }
        break;
    case 'POST':
        $post_in = (array)json_decode(file_get_contents('php://input'));
        $post = PostController::postCity($post_in['title'], $url);
        echo json_encode($post);
        http_response_code(201);
        break;
    case 'PATCH':
        $post_in = (array)json_decode(file_get_contents('php://input'));
        $post = PostController::renameCity($post_in['id'], $post_in['title'], $url);
        echo json_encode($post);
        break;
    case 'DELETE':
        $post_in = (array)json_decode(file_get_contents('php://input'));
        $del = PostController::delete($post_in['id'], $url);
        echo 'OK';
        break;
}
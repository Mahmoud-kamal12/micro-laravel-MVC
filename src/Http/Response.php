<?php

namespace Lib\Http;

use JetBrains\PhpStorm\NoReturn;

class Response
{

    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function back()
    {
        header('Location:' . $_SERVER['HTTP_REFERER']);

        return $this;
    }

    public function json(array $data){
        header("Content-Type: application/json");
        echo json_encode($data);
        exit();
    }
}

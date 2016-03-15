<?php
namespace App\Controller;

class ErrorController
{
    public function error404()
    {
        $title = '404 File Not Found';

        require VIEW_DIR . '/errors/404.php';
    }
}

<?php

class View
{
    function __construct()
    {
        //echo "<br>we are in page View";
        $this->result = "OK";
    }

    function Render($name, $data = null)
    {
        $name = ucfirst($name);
        if ($name != '../app/Login/index') {
            require_once("../app/Views/Header.php");
            require_once("../app/Views/" . $name . ".php");
            require_once("../app/Views/Footer.php");
        } else {
            require_once("../app/Views/" . $name . ".php");
        }
    }

}

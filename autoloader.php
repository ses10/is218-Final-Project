<?php
class Autoloader
{
    public static function loader($class)
    {
        $filename = $class . '.php';
        $file ='core/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        include $file;
    }
}

<?php
#Author: Tang.Hongbo
#Email: tang.hongbo@sh.adways.net
#Time: 2012-07-25

/**
 * this function is automatically to import the class or interface which has not been defined.
 */
function ApnStupid_Autoload($className)
{
    $path = dirname(__FILE__);
    $file = $path . DIRECTORY_SEPARATOR . $className . '.php';
    if (!is_readable($file)) {
        throw new Exception(
            "ERROR: Unable to read the file: '$file'"
        );
    }
    require_once $file;
    if (!class_exists($className, false) && !interface_exists($className, false)) {
        throw new Exception(
            "ERROR: There is no class: '$className' in the file: '$file'"
        );
    }
    return true;
}

if (function_exists('__autoload')) {
    spl_autoload_register('__autoload');
}
spl_autoload_register('ApnStupid_Autoload');
?>

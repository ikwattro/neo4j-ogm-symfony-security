<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    private $autoloader;

    public function boot()
    {
        $container = &$this->container;

        $this->autoloader = function($class) use (&$container) {
            if (0 === strpos($class, 'neo4j_ogm_proxy')) {
                $cacheDir = $container->getParameter('kernel.cache_dir') . DIRECTORY_SEPARATOR . 'neo4j';
                $file = $cacheDir.DIRECTORY_SEPARATOR.$class.'.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        };

        spl_autoload_register($this->autoloader);
    }

    public function shutdown()
    {
        spl_autoload_unregister($this->autoloader);
    }
}

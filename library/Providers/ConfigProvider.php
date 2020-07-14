<?php

declare(strict_types=1);

namespace Gewaer\Providers;

use function Baka\appPath;
use Canvas\Providers\ConfigProvider as CanvasConfigProvider;
use Phalcon\Config;
use Phalcon\Di\DiInterface;

class ConfigProvider extends CanvasConfigProvider
{
    /**
     * @param DiInterface $container
     */
    public function register(DiInterface $container) : void
    {
        $container->setShared(
            'config',
            function () {
                /**
                 * @todo Find a better way to handle unit test file include
                 */
                $data = require appPath('library/Core/config.php');

                return new Config($data);
            }
        );
    }
}

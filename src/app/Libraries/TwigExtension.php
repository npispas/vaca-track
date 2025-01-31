<?php

namespace App\Libraries;

use App\Core\Config;
use App\Core\Router;
use App\Core\Session;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TwigExtensions
 *
 * Extends Twig with custom functions, including session flash messages.
 */
class TwigExtension extends AbstractExtension
{
    /**
     * Register custom Twig functions.
     *
     * @return array Custom Twig functions
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('flash_messages', [$this, 'getFlashMessages']),
            new TwigFunction('session', [$this, 'session']),
            new TwigFunction('config', [$this, 'config']),
            new TwigFunction('router', [$this, 'router']),
        ];
    }

    /**
     * Retrieve a session item.
     *
     * @param string $key
     * @return mixed Returns a session item or the default value if not exists
     */
    public function session(string $key): mixed
    {
        return Session::get($key);
    }

    /**
     * Retrieve a configuration item.
     *
     * @param string $key
     * @return mixed Returns a configuration item or the default value if not exists
     */
    public function config(string $key): mixed
    {
        return Config::get($key);
    }

    /**
     * Retrieve a router instance.
     *
     * @return Router Returns an instance of the router.
     */
    public function router(): Router
    {
        return Router::getInstance();
    }

    /**
     * Retrieve and clear session flash messages.
     */
    public function getFlashMessages(): ?array
    {
        return Session::getFlashMessages();
    }
}

<?php

namespace App\Libraries;

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
        ];
    }

    /**
     * Retrieve and clear session flash messages.
     *
     * @return array|null Flash messages or null if none exist
     */
    public function getFlashMessages(): ?array
    {
        return Session::getFlashMessages();
    }
}

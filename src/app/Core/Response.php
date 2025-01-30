<?php

namespace App\Core;

/**
 * Class Response
 *
 * Handles HTTP redirects and session messages.
 */
class Response
{
    private string $route;

    /**
     * Create a new redirect response.
     *
     * @param string $route The route to redirect to.
     * @return self
     */
    public static function redirect(string $route): self
    {
        $instance = new self();
        $instance->route = $route;

        return $instance;
    }

    /**
     * Attach session flash messages.
     *
     * @param string $key Message type (success, error, info, etc.)
     * @param array|string $value The value content.
     * @return self
     */
    public function with(string $key, array|string $value): self
    {
        Session::flash($key, $value);

        return $this;
    }

    /**
     * Execute the redirect and store session messages.
     */
    public function send(): void
    {
        header("Location: $this->route");
        exit;
    }
}

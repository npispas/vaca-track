<?php

namespace App\Middleware;

/**
 * Interface Middleware
 *
 * Defines the contract for middleware classes that handle request processing
 * before reaching the intended route or controller.
 */
interface Middleware
{
    /**
     * Handle the request before proceeding to the controller.
     * Middleware classes implementing this method can enforce authentication, authorization,
     * request modifications, or any pre-processing logic.
     *
     * @return void
     */
    public function handle(): void;
}

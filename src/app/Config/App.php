<?php

return [
    'debug' => getenv('APP_DEBUG') === 'true',
    'timezone' => getenv('APP_TIMEZONE') ?: 'UTC',
    'name' => getenv('APP_NAME') ?: 'VacaTrack',
    'vacation_days' => getenv('APP_VACATION_DAYS') ?: 20,
];

<?php

return [
    'debug' => getenv('APP_DEBUG') === 'true',
    'timezone' => getenv('APP_TIMEZONE') ?: 'UTC',
    'name' => getenv('APP_NAME') ?: 'VacaTrack',
];
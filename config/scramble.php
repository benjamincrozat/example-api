<?php

declare(strict_types=1);

use Dedoc\Scramble\Http\Middleware\RestrictedDocsAccess;

return [
    'api_path' => 'api',
    'api_domain' => null,
    'export_path' => 'storage/api-docs/openapi.json',
    'info' => [
        'version' => env('API_VERSION', '1.0.0'),
        'description' => 'Product CRUD API built with Laravel, PostgreSQL, JSON request logging, and generated OpenAPI documentation.',
    ],
    'ui' => [
        'title' => 'Example API',
        'theme' => 'light',
        'hide_try_it' => false,
        'hide_schemas' => false,
        'logo' => '',
        'try_it_credentials_policy' => 'include',
        'layout' => 'responsive',
    ],
    'servers' => null,
    'enum_cases_description_strategy' => 'description',
    'enum_cases_names_strategy' => false,
    'flatten_deep_query_parameters' => true,
    'middleware' => [
        'web',
        RestrictedDocsAccess::class,
    ],
    'extensions' => [],
];

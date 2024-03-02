<?php


if (!function_exists('getLocales')) {

    function isRtl($lang)
    {
        return in_array($lang, config("app.locales.rtl"));
    }
}


if (!function_exists('requestPrefix')) {

    function adminRequest($request = null)
    {
        if (!$request) $request = request();

        if (is_string($request))
            $prefix = getPrefix($request);
        else
            $prefix = $request->route()->getPrefix();

        return $prefix === '/' . config('app.admin-prefix') || $prefix === config('app.admin-prefix') || str_contains($prefix,config('app.admin-prefix'));
    }
}


if (!function_exists('getPrefix')) {

    function getPrefix($url)
    {
        $path = parse_url($url, PHP_URL_PATH); // Extract the path from the URL

        $segments = explode('/', trim($path, '/'));

        if (count($segments) > 0) {
            return $segments[0];
        }
        return null;
    }
}



if (!function_exists('buildBreadCrumb')) {

    function buildBreadCrumb($activeHeader = null, $header = null, $useDashboard = true)
    {
        if ($useDashboard)
            $header = [
                'title' => 'Dashboard',
                'link' => route('admin.dashboard')
            ];

        return [
            'breadcrumb' => [
                    'header' => [
                        'title' => $header['title'],
                        'link' => $header['link']
                    ],
                    'active_header' => $activeHeader ? [
                        'title' => $activeHeader['title'],
                        'link' => $activeHeader['link']
                    ] : null
                ]
        ];
    }
}


if (!function_exists('buildConfig')) {

    function buildConfig()
    {
       return [
            'columns' => [
                [
                    'field' => 'name',
                    'header' => 'Name'
                ],
                [
                    'field' => 'description',
                    'header' => 'Description'
                ],
                
            ],

        ];
    }
}

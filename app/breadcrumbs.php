<?php

$packages = Config::get('cpanel::package');

foreach ($packages as $key => $val) {
    $breadcrumb = base_path('workbench/rabbit/' . $key . '/src/breadcrumbs.php');
    if (file_exists($breadcrumb)) {
        include($breadcrumb);
    }
}
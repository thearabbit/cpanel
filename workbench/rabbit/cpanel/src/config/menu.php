<?php

return array(
    // Home
    'Home' => array(
        'icon' => 'home',
        'url' => URL::route('cpanel.home.index'),
//        'target' => '_blank',
//        'tree' => array(
//            'Title1' => array('url' => ''),
//            'Title2' => array('url' => ''),
//        )
    ),
    'Exchange' => array(
        'icon' => 'money',
        'url' => URL::route('cpanel.exchange.index')
    ),
    'Company' => array(
        'icon' => 'briefcase',
        'url' => URL::route('cpanel.company.edit', 1)
    ),
    'Branch' => array(
        'icon' => 'sitemap',
        'url' => URL::route('cpanel.branch.index')
    ),
    'Group' => array(
        'icon' => 'users',
        'url' => URL::route('cpanel.group.index')
    ),
    'User' => array(
        'icon' => 'user',
        'url' => URL::route('cpanel.user.index')
    ),
//    'Backup' => array(
//        'icon' => 'download',
//        'url' => URL::route('cpanel.backup.create')
//    ),
//    'Restore' => array(
//        'icon' => 'upload',
//        'url' => URL::route('cpanel.restore.create')
//    ),

    // Tool
//    'Tools' => array(
//        'icon' => 'cog',
//        'tree' => array(
//            'Company' => array('url' => URL::route('cpanel.company.edit', 1)),
//            'User' => array('url' => URL::route('cpanel.user.index')),
//            'Backup' => array('url' => URL::route('cpanel.backup.create')),
//            'Restore' => array('url' => URL::route('cpanel.restore.create')),
//        ),
//    ),

);

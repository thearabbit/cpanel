<?php

// Home
Breadcrumbs::register('cpanel.home.index', function ($breadcrumbs) {
    $breadcrumbs->push('<i class="fa fa-home"></i> Home', route(CpanelAuth::getGroup()->package . '.home.index'));
});
// User
Breadcrumbs::register('cpanel.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('User', route('cpanel.user.index'));
});
Breadcrumbs::register('cpanel.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.user.index');
    $breadcrumbs->push('Add New', route('cpanel.user.create'));
});
Breadcrumbs::register('cpanel.user.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.user.index');
    $breadcrumbs->push('Edit', route('cpanel.user.edit'));
});
// Branch
Breadcrumbs::register('cpanel.branch.index', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Branch', route('cpanel.branch.index'));
});
Breadcrumbs::register('cpanel.branch.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.branch.index');
    $breadcrumbs->push('Add New', route('cpanel.branch.create'));
});
Breadcrumbs::register('cpanel.branch.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.branch.index');
    $breadcrumbs->push('Edit', route('cpanel.branch.edit'));
});
// Group
Breadcrumbs::register('cpanel.group.index', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Group', route('cpanel.group.index'));
});
Breadcrumbs::register('cpanel.group.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.group.index');
    $breadcrumbs->push('Add New', route('cpanel.group.create'));
});
Breadcrumbs::register('cpanel.group.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.group.index');
    $breadcrumbs->push('Edit', route('cpanel.group.edit'));
});
// Exchange
Breadcrumbs::register('cpanel.exchange.index', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Exchange', route('cpanel.exchange.index'));
});
Breadcrumbs::register('cpanel.exchange.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.exchange.index');
    $breadcrumbs->push('Add New', route('cpanel.exchange.create'));
});
Breadcrumbs::register('cpanel.exchange.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.exchange.index');
    $breadcrumbs->push('Edit', route('cpanel.exchange.edit'));
});
// User profile
Breadcrumbs::register('cpanel.profile.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Profile', route('cpanel.profile.edit'));
});
// Company
Breadcrumbs::register('cpanel.company.edit', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Company', route('cpanel.company.edit'));
});
// Backup
Breadcrumbs::register('cpanel.backup.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Backup', route('cpanel.backup.create'));
});
// Restore
Breadcrumbs::register('cpanel.restore.create', function ($breadcrumbs) {
    $breadcrumbs->parent('cpanel.home.index');
    $breadcrumbs->push('Restore', route('cpanel.restore.create'));
});

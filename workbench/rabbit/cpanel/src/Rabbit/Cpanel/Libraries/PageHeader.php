<?php
namespace Rabbit\Cpanel\Libraries;


class PageHeader
{
    // Header for AdminLTE
    private $tmpHeader = '<i class="fa fa-:icon"></i> :title';

    public function make()
    {
        $routeName = \Route::currentRouteName();
        list($package, $resource, $action) = explode('.', $routeName);
        $title = ucwords(str_replace('_', ' ', $resource));

        switch ($action) {
            case 'index':
                $icon = 'list';
                break;
            case 'show':
                $icon = 'eye';
                break;
            case 'create':
                $icon = 'plus';
                break;
            case 'edit':
                $icon = 'pencil';
                break;
            default:
                $icon = '';
        }
        $data = str_replace([':icon', ':title'], [$icon, $title], $this->tmpHeader);

        return $data;
    }
}
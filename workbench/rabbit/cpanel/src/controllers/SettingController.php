<?php
namespace Rabbit\Cpanel;

class SettingController extends BaseController
{

    /**
     * Get setting
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $group = null;
        $branch = null;
        if (isset(\CpanelAuth::getGroup()->id) and isset(\CpanelAuth::getBranch()->id)) {
            $group = \CpanelAuth::getGroup()->id;
            $branch = \CpanelAuth::getBranch()->id;
        }
        $data['group'] = $group;
        $data['branch'] = $branch;

        return \View::make('cpanel::setting.form', $data);
    }

    /**
     * Post setting
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        // Set group and branch session
        \CpanelAuth::setGroup(\Input::get('group'));
        \CpanelAuth::setBranch(\Input::get('branch'));

        return \Redirect::route(\CpanelAuth::getGroup()->package . '.home.index');
    }

}

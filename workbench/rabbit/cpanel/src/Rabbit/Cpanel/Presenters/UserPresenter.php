<?php
/**
 * Created by PhpStorm.
 * User: Theara-CBIRD
 * Date: 7/21/14
 * Time: 10:17 AM
 */

namespace Rabbit\Cpanel\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    public function getGroup()
    {
        return implode(', ', json_decode($this->cp_group_id, true));
    }

}
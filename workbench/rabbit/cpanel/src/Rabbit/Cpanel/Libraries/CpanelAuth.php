<?php namespace Rabbit\Cpanel\Libraries;

use Rabbit\Cpanel\BranchModel;
use Rabbit\Cpanel\GroupModel;

class CpanelAuth
{
    /**
     * Set group session
     *
     * @param $id
     */
    public function setGroup($id)
    {
        $data = GroupModel::find($id);
        // Set current group to session
        \Session::put('auth_group', $data);
    }

    /**
     * Set branch session
     *
     * @param $id
     */
    public function setBranch($id)
    {
        $data = BranchModel::find($id);
        // Set current branch to session
        \Session::put('auth_branch', $data);
    }

    /**
     * Get group session
     *
     * @return mixed
     */
    public function getGroup()
    {
        $data = \Session::get('auth_group');
        return $data;
    }

    /**
     * Get branch session
     *
     * @return mixed
     */
    public function getBranch()
    {
        $data = \Session::get('auth_branch');
        return $data;
    }

    /**
     * Verify group and branch session
     *
     * @return bool
     */
    public function has()
    {
        return (\Session::has('auth_group') and \Session::has('auth_branch'));
    }

    /**
     * Clear group and branch session
     */
    public function clear()
    {
        \Session::forget('auth_group');
        \Session::forget('auth_branch');
    }

}
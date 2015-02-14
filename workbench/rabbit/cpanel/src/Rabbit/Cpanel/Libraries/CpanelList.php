<?php
/**
 * Created by PhpStorm.
 * User: Theara
 * Date: 6/29/14
 * Time: 12:48 PM
 */

namespace Rabbit\Cpanel\Libraries;


use Rabbit\Cpanel\BranchModel;
use Rabbit\Cpanel\GroupModel;

class CpanelList
{
    private $selectOne = ['' => '- Select One -'];

    /**
     * User type
     *
     * @param bool $selectOne
     * @return array
     */
    public function type($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }

        if (\Auth::user()->type == 'Super') {
            $dataTmp = array(
                'Super' => 'Super',
                'Admin' => 'Admin',
                'Guest' => 'Guest',
            );
        } else { // For Admin
            $dataTmp = array(
                'Guest' => 'Guest',
            );
        }

        $data = $this->selectOne + $dataTmp;

        return $data;
    }

    /**
     * User permission
     *
     * @param bool $selectOne
     * @return array
     */
    public function permission($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }

        $data = $this->selectOne + \Config::get('cpanel::permission');

        return $data;
    }

    /**
     * User active
     *
     * @param bool $selectOne
     * @return array
     */
    public function activated($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }

        $data = $this->selectOne + ['Yes' => 'Yes', 'No' => 'No'];

        return $data;
    }

    /**
     * Group permission
     *
     * @param bool $selectOne
     * @return array
     */
    public function groupPermission($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }

        $groupId = json_decode(\Auth::user()->group, true);
        $groups = GroupModel::whereIn('id', $groupId)->orderBy('id')->get();
        $groupsTmp = [];
        foreach ($groups as $list) {
            $groupsTmp[$list->id] = $list->name . ' | ' . \Config::get('cpanel::package.' . $list->package . '.name');
        }

        $list = $this->selectOne + $groupsTmp;

        return $list;
    }

    /**
     * Branch permission
     *
     * @param bool $selectOne
     * @return array
     */
    public function branchPermission($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }

        $branchId = json_decode(\Auth::user()->branch, true);
        $branches = BranchModel::whereIn('id', $branchId)->orderBy('id')->get();
        $branchesTmp = [];
        foreach ($branches as $list) {
            $branchesTmp[$list->id] = $list->id . ' | ' . $list->en_name . ' (' . $list->en_short_name . ')';
        }

        $list = $this->selectOne + $branchesTmp;

        return $list;
    }

    /**
     * Workbench package
     *
     * @param bool $selectOne
     * @return array
     */
    public function package($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }
        $data = \Config::get('cpanel::package');
        $dataTmp = [];
        foreach ($data as $key => $val) {
            if (\Auth::user()->type == 'Super') {
                $dataTmp[$key] = $val['name'];
            } else {
                if ($key != 'cpanel')
                    $dataTmp[$key] = $val['name'];
            }
        }

        $list = $this->selectOne + $dataTmp;

        return $list;
    }

    /**
     * Branch office
     *
     * @param bool $selectOne
     * @return array
     */
    public function branch($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }
        $data = BranchModel::orderBy('id')->get();
        $dtaTmp = [];
        foreach ($data as $branch) {
            $dtaTmp[$branch->id] = $branch->id . ' | ' . $branch->en_name . ' (' . $branch->en_short_name . ')';
        }
        $list = $this->selectOne + $dtaTmp;
        return $list;
    }

    /**
     * Group from table store
     *
     * @param bool $selectOne
     * @return array
     */
    public function group($selectOne = true)
    {
        if (!$selectOne) {
            $this->selectOne = [];
        }
        $data = GroupModel::orderBy('id');
        if (\Auth::user()->type != 'Super') {
            $data->where('package', '!=', 'cpanel');
        }
        $data = $data->get();

        $dtaTmp = [];
        foreach ($data as $val) {
            $dtaTmp[$val->id] = $val->name . ' (' . $val->package . ')';
        }
        $list = $this->selectOne + $dtaTmp;
        return $list;
    }

}
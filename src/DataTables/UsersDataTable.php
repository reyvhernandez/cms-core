<?php

namespace Yajra\CMS\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable api response.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->diffForHumans();
            })
            ->editColumn('email', function (User $user) {
                return html()->mailto($user->email);
            })
            ->editColumn('is_blocked', function (User $user) {
                return dt_check($user->is_blocked);
            })
            ->editColumn('is_activated', function (User $user) {
                return dt_check($user->is_activated);
            })
            ->editColumn('is_admin', function (User $user) {
                return dt_check($user->is_admin);
            })
            ->editColumn('roles', function (User $user) {
                return dt_render('administrator.users.datatables.roles', compact('user'));
            })
            ->addColumn('action', function (User $user) {
                return dt_render('administrator.users.datatables.action', $user->toArray());
            })
            ->rawColumns(['email', 'is_blocked', 'is_activated', 'is_admin', 'roles', 'action']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = User::with('roles')->select('users.*');

        if ($this->datatables->getRequest()->get('deleted') == 'true') {
            $users->onlyTrashed();
        }

        if ($status = $this->datatables->getRequest()->get('status')) {
            $users->whereIn('is_activated', $status);
        }

        if ($roles = $this->datatables->getRequest()->get('roles')) {
            $users->havingRoles($roles);
        }

        return $this->applyScopes($users);
    }

    /**
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns(trans('cms::user.dataTable.columns'))
                    ->minifiedAjax()
                    ->parameters(trans('cms::user.dataTable.parameters'));
    }

    /**
     * @return string
     */
    protected function filename()
    {
        return trans('cms::user.dataTable.filename');
    }
}

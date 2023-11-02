<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'Dashboard' => [
                'icon' => 'home',
                'route_name' => 'dashboard-overview-1',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Dashboard',
                'rol' => 'all'
            ],
            'Usuarios' => [
                'icon' => 'users',
                'route_name' => 'users.user.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Usuarios',
                'rol' => 'admin'
            ],
            'Tickets' => [
                'icon' => 'inbox',
                'route_name' => 'tickets.ticket.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Tickets',
                'rol' => 'all'
            ],
            'Flujos' => [
                'icon' => 'git-merge',
                'route_name' => 'flows.flow.index',
                'params' => [
                    'layout' => 'side-menu'
                ],
                'title' => 'Flujos',
                'rol' => 'all'
            ],
        ];
    }
}

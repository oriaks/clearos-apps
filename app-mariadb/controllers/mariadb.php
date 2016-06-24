<?php

/**
 * MariaDB controller.
 *
 * @category   apps
 * @package    mariadb
 * @subpackage controllers
 * @author     Michael Richard <michael.richard@oriaks.com>
 * @copyright  2016 Oriaks
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.oriaks.com
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * MariaDB controller.
 *
 * @category   apps
 * @package    mariadb
 * @subpackage controllers
 * @author     Michael Richard <michael.richard@oriaks.com>
 * @copyright  2016 Oriaks
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.oriaks.com
 */

class MariaDB extends ClearOS_Controller
{
    /**
     * MariaDB default controller
     *
     * @return view
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->lang->load('mariadb');

        // Load views
        //-----------

        $views = array(
            'mariadb/server',
            'mariadb/setting'
        );

        $this->page->view_forms($views, lang('mariadb_app_name'));
    }
}

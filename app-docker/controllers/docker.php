<?php

/**
 * Docker controller.
 *
 * @category   apps
 * @package    docker
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
 * Docker controller.
 *
 * @category   apps
 * @package    docker
 * @subpackage controllers
 * @author     Michael Richard <michael.richard@oriaks.com>
 * @copyright  2016 Oriaks
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.oriaks.com
 */

class Docker extends ClearOS_Controller
{
    /**
     * Docker default controller
     *
     * @return view
     */

    function index()
    {
        // Load libraries
        //---------------

        $this->lang->load('docker');

        // Load views
        //-----------

        $views = array(
            'docker/server',
        );

        $this->page->view_forms($views, lang('docker_app_name'));
    }
}

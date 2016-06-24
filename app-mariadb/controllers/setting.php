<?php

/**
 * MariaDB settings controller.
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

// Exceptions
//-----------

use \clearos\apps\base\Engine_Exception as Engine_Exception;

clearos_load_library('base/Engine_Exception');

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * MariaDB settings controller.
 *
 * @category   apps
 * @package    mariadb
 * @subpackage controllers
 * @author     Michael Richard <michael.richard@oriaks.com>
 * @copyright  2016 Oriaks
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.oriaks.com
 */

class Setting extends ClearOS_Controller
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

        $this->load->library('mariadb/MariaDB');
        $this->lang->load('mariadb');

        // Set validation rules
        //---------------------
         
        if ($this->input->post('submit')) {
            $this->form_validation->set_policy('current_password', 'mariadb/MariaDB', 'validate_password', TRUE);
            $this->form_validation->set_policy('password', 'mariadb/MariaDB', 'validate_password', TRUE);
            $this->form_validation->set_policy('verify', 'mariadb/MariaDB', 'validate_password', TRUE);
        } else {
            $this->form_validation->set_policy('new_password', 'mariadb/MariaDB', 'validate_password', TRUE);
            $this->form_validation->set_policy('new_verify', 'mariadb/MariaDB', 'validate_password', TRUE);
        }

        $form_ok = $this->form_validation->run();

        // Extra validation
        //-----------------

        if ($this->input->post('submit')) {
            $current_password = $this->input->post('current_password');
            $password = $this->input->post('password');
            $verify = $this->input->post('verify');
        } else {
            $current_password = '';
            $password = $this->input->post('new_password');
            $verify = $this->input->post('new_verify');
        }

        if ($form_ok) {
            if ($password !== $verify) {
                $this->form_validation->set_error('new_verify', lang('base_password_and_verify_do_not_match'));
                $this->form_validation->set_error('verify', lang('base_password_and_verify_do_not_match'));
                $form_ok = FALSE;
            }
        }

        // Handle form submit
        //-------------------

        if (($this->input->post('submit') || $this->input->post('submit_new')) && $form_ok) {
            try {
                $this->mariadb->set_root_password($current_password, $password);

                $this->page->set_message(lang('mariadb_password_updated'), 'info');
                redirect('/mariadb');
            } catch (Exception $e) {
                $this->page->view_exception($e);
            }
        }

        // Load view data
        //---------------

        try {
            $is_running = $this->mariadb->get_running_state();
            $data['is_password_set'] = $this->mariadb->is_root_password_set();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        $this->page->view_form('mariadb/setting', $data, lang('base_settings'));
    }
}

<?php

/**
 * MariaDB view.
 *
 * @category   apps
 * @package    mariadb
 * @subpackage views
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
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('mariadb');

///////////////////////////////////////////////////////////////////////////////
// Show warning if password is not set
///////////////////////////////////////////////////////////////////////////////

echo "<div id='mariadb_not_running' style='display:none;'>";
echo infobox_warning(lang('base_warning'), lang('mariadb_management_tool_not_accessible'));
echo "</div>";

///////////////////////////////////////////////////////////////////////////////
// Password not set
///////////////////////////////////////////////////////////////////////////////

echo "<div id='mariadb_no_password' style='display:none;'>";
echo infobox_warning(lang('base_warning'), lang('mariadb_lang_please_set_a_database_password'));

echo form_open('mariadb');
echo form_header(lang('base_password'));

echo field_password('new_password', '', lang('base_password'));
echo field_password('new_verify', '', lang('base_verify'));

echo field_button_set(
    array(form_submit_custom('submit_new', lang('mariadb_set_password'), 'high'))
);

echo form_footer();
echo form_close();

echo "</div>";

///////////////////////////////////////////////////////////////////////////////
// Password set
///////////////////////////////////////////////////////////////////////////////

echo "<div id='mariadb_password_ok' style='display:none;'>";

$options['buttons']  = array(
    anchor_custom('/mysql', lang('mariadb_go_to_management_tool'), 'high', array('target' => '_blank'))
);

echo infobox_highlight(
    lang('mariadb_management_tool'),
    lang('mariadb_management_tool_help'),
    $options
);

echo form_open('mariadb');
echo form_header(lang('base_password'));

echo field_password('current_password', '', lang('base_current_password'));
echo field_password('password', '', lang('base_password'));
echo field_password('verify', '', lang('base_verify'));

echo field_button_set(
    array(form_submit_update('submit', 'high'))
);

echo form_footer();
echo form_close();

echo "</div>";

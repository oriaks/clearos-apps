<?php

/**
 * Openfire view.
 *
 * @category   apps
 * @package    openfire
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
$this->lang->load('openfire');

///////////////////////////////////////////////////////////////////////////////
// Show warning if service is not running
///////////////////////////////////////////////////////////////////////////////

echo "<div id='openfire_not_running' style='display:none;'>";
echo infobox_warning(lang('base_warning'), lang('openfire_management_tool_not_accessible'));
echo "</div>";

echo "<div id='openfire_running' style='display:none;'>";

$options['buttons']  = array(
    anchor_custom('http://'.explode(':', $_SERVER['HTTP_HOST'])[0].':9090', lang('openfire_go_to_management_tool'), 'high', array('target' => '_blank'))
);

echo infobox_highlight(
    lang('openfire_management_tool'),
    lang('openfire_management_tool_help'),
    $options
);

echo "</div>";

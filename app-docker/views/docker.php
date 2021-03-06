<?php

/**
 * Docker controller.
 *
 * @category   Apps
 * @package    Docker
 * @subpackage Controllers
 * @author     Michael Richard <michael.richard@oriaks.com>
 * @copyright  2016 Oriaks
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.oriaks.com
 */

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('docker');

///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

echo infobox_highlight(lang('docker_app_name'), '...');

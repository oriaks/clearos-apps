<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'openfire';
$app['version'] = '0.0.1';
$app['release'] = '1';
$app['vendor'] = 'Oriaks';
$app['packager'] = 'Oriaks';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('openfire_app_description');
$app['tooltip'] = lang('openfire_app_tooltip');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('openfire_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_communication_and_collaboration');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'app-base-core >= 1:1.2.6',
    'app-network-core', 
    'app-storage-core >= 1:1.4.7',
    'docker-engine >= 1.11',
);

$app['core_file_manifest'] = array( 
    'openfire_default.conf' => array ( 'target' => '/etc/clearos/storage.d/openfire_default.conf' ),
    'openfire.php'=> array( 'target' => '/var/clearos/base/daemon/openfire.php' ),
);

$app['delete_dependency'] = array(
    'app-openfire-core',
);

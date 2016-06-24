<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'docker';
$app['version'] = '0.0.1';
$app['release'] = '1';
$app['vendor'] = 'Oriaks';
$app['packager'] = 'Oriaks';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('docker_app_description');
$app['tooltip'] = lang('docker_app_tooltip');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('docker_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_infrastructure');

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
    'docker.php'=> array( 'target' => '/var/clearos/base/daemon/docker.php' ),
);

$app['delete_dependency'] = array(
    'app-docker-core',
    'app-docker-repo',
    'docker-engine',
);

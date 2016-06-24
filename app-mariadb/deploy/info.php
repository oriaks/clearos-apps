<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'mariadb';
$app['version'] = '0.0.1';
$app['release'] = '1';
$app['vendor'] = 'Oriaks';
$app['packager'] = 'Oriaks';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('mariadb_app_description');
$app['tooltip'] = lang('mariadb_app_tooltip');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('mariadb_app_name');
$app['category'] = lang('base_category_server');
$app['subcategory'] = lang('base_subcategory_database');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['core_requires'] = array(
    'app-base-core >= 1:1.2.6',
    'app-network-core', 
    'app-storage-core >= 1:1.4.7',
    'docker-engine >= 1.11',
    'phpMyAdmin >= 4.4.9',
);

$app['core_file_manifest'] = array( 
    'mariadb_default.conf' => array ( 'target' => '/etc/clearos/storage.d/mariadb_default.conf' ),
    'mariadb.php'=> array( 'target' => '/var/clearos/base/daemon/mariadb.php' ),
);

$app['delete_dependency'] = array(
    'app-mariadb-core',
    'phpMyAdmin',
);

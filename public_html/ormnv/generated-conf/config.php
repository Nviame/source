<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'dsn' => 'mysql:host=localhost;dbname=nviame',
  'user' => 'nviame_app',
  'password' => 'RB1fr30a',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
  ),
  'settings' =>
  array (
    'charset' => 'utf8mb4',
    'queries' =>
    array (
      'utf8' => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci, COLLATION_CONNECTION = utf8mb4_unicode_ci, COLLATION_DATABASE = utf8mb4_unicode_ci, COLLATION_SERVER = utf8mb4_unicode_ci',
    ),
  ),
));
$manager->setName('default');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setAdapterClass('nviame', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'dsn' => 'mysql:host=localhost;dbname=nviame',
  'user' => 'nviame_app',
  'password' => 'RB1fr30a',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
  ),
));
$manager->setName('nviame');
$serviceContainer->setConnectionManager('nviame', $manager);
$serviceContainer->setDefaultDatasource('default');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => 'log/propel.log',
  'level' => 300,
));
$serviceContainer->setLoggerConfiguration('nviame', array (
  'type' => 'stream',
  'path' => 'log/propel_nviame.log',
));
<?php

if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

$configuration = new sfProjectConfiguration(dirname(__FILE__).'/../fixtures/project');
require_once $configuration->getSymfonyLibDir().'/vendor/lime/lime.php';

function sfBlueprintPlugin_autoload_again($class)
{
  $autoload = sfSimpleAutoload::getInstance();
  $autoload->reload();
  return $autoload->autoload($class);
}
spl_autoload_register('sfBlueprintPlugin_autoload_again');

if (file_exists($config = dirname(__FILE__).'/../../config/sfBlueprintPluginConfiguration.class.php'))
{
  require_once $config;
  $plugin_configuration = new sfBlueprintPluginConfiguration($configuration, dirname(__FILE__).'/../..', 'sfBlueprintPlugin');
}
else
{
  $plugin_configuration = new sfPluginConfigurationGeneric($configuration, dirname(__FILE__).'/../..', 'sfBlueprintPlugin');
}

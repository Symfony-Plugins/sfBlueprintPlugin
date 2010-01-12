<?php

$plugins = sfConfig::get('app_blueprint_plugins', array());
$availablePlugins = array('buttons','fancy-type','link-icons','rtl');
$blueprintPath = '/sfBlueprintPlugin/css/';

/**
 * @desc  Load blueprint library in header
 */
$response = sfContext::getInstance()->getResponse();
$response->addStylesheet($blueprintPath . 'screen','last');
$response->addStylesheet($blueprintPath . 'print', 'last', array('media' => 'print'));
$response->addStylesheet($blueprintPath . 'ie', 'last', array('condition' => 'IE'));
/**
  * @desc	Load blueprint plugin in header
	*/
foreach ($plugins as $plugin){
	if (in_array($plugin, $availablePlugins )){
		$response->addStylesheet( $blueprintPath . 'plugins/' . $plugin . '/screen','last');
	}
}
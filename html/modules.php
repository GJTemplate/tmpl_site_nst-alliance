<?php
/**
* @package Helix Framework
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2017 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

function modChrome_sp_xhtml($module, $params, $attribs) {

	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? ' col-sm-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'sp-module-title'));
	$idMod = $module->id;

	if ($module->content) {

		echo '<' . $moduleTag . ' class="sp-module t3-module ' . htmlspecialchars($params->get('moduleclass_sfx')) . $moduleClass . '" id="Mod'. $idMod .'"  >';

			if ($module->showtitle){
				$title = explode('//', $module->title, 2);
				//echo trim($title[0]);
				if (count($title) == 2) {
					echo '<' . $headerTag . ' class="' . $headerClass . '">';
						echo trim($title[0]);
					echo '<span class="rhino-last-title">' . trim($title[1]) . '</span></' . $headerTag . '>';
				}else{
					echo '<' . $headerTag . ' class="' . $headerClass . '">' . trim($title[0]) . '</' . $headerTag . '>';
				}
			}

			echo '<div class="sp-module-content">';
			echo $module->content;
			echo '</div>';

		echo '</' . $moduleTag . '>';
	}
}


function modChrome_rhino($module, &$params, &$attribs){

	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? ' col-sm-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'sp-module-title'));

	if ($module->content) {
		echo '<' . $moduleTag . ' class="sp-module ' . htmlspecialchars($params->get('moduleclass_sfx')) . $moduleClass . '">';
			if ($module->showtitle){
				$title = explode('//', $module->title, 2);
				if (count($title) == 2) {
					$mod_title = '<' . $headerTag . ' class="' . $headerClass . '">' . trim($title[0]) . '<span class="rhino-last-title">' . trim($title[1]) . '</span></' . $headerTag . '>';
				}else{
					$mod_title = '<' . $headerTag . ' class="' . $headerClass . '">' . trim($title[0]) . '</' . $headerTag . '>';
				}
				$generated_content = str_replace('<' . $headerTag . '>' . $module->title . '</' . $headerTag . '>', $mod_title , $module->content);
			}

			echo '<div class="sp-module-content">';
			echo $generated_content;
			echo '</div>';

		echo '</' . $moduleTag . '>';
	}

}

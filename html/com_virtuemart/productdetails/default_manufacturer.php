<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @author Max Milbers, Valerie Isaksen
 * @link ${PHING.VM.MAINTAINERURL}
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @version $Id: default_manufacturer.php 9413 2017-01-04 17:20:58Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>
<div class="manufacturer">
	<?php
	$i = 1;

	$mans = array();
	// Gebe die Hersteller aus
	foreach($this->product->manufacturers as $manufacturers_details) {

		//Link to products
		$link = JRoute::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturers_details->virtuemart_manufacturer_id, FALSE);
		$name = $manufacturers_details->mf_name;

		// Avoid JavaScript on PDF Output
		if (!$this->writeJs) {
			$mans[] = JHtml::_('link', $link, $name);
		} else {
			$mans[] = '<a href="'.$link .'">'.$name.'</a>';
		}
	}
	echo JTEXT::_('COM_VIRTUEMART_PRODUCT_DETAILS_MANUFACTURER_LBL').': '.implode(', ',$mans);
	?>
</div>
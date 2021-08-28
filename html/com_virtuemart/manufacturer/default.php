<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage Manufacturer
* @author Kohl Patrick, Eugen Stranz
* @link ${PHING.VM.MAINTAINERURL}
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

// Category and Columns Counter
$iColumn = 1;
$iManufacturer = 1;

// Calculating Manufacturers Per Row
$manufacturerPerRow = VmConfig::get ('manufacturer_per_row', 3);
switch($manufacturerPerRow){
    case 1:
        $manufacturerCellWidth = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        break;
    case 2:
        $manufacturerCellWidth = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
        break;
    case 3:
        $manufacturerCellWidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
        break;
    case 4:
        $manufacturerCellWidth = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
        break;
    case 5:
        $manufacturerCellWidth = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
        break;
    default:
        $manufacturerCellWidth = 'col-lg-2 col-md-3 col-sm-4 col-xs-12';
}

// Lets output the categories, if there are some
if (!empty($this->manufacturers)) { ?>

<div class="category-view">
    <div class="row">
        <?php // Start the Output
        foreach ( $this->manufacturers as $manufacturer ) {

            // Manufacturer Elements
            $manufacturerURL = JRoute::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id, FALSE);
            $manufacturerIncludedProductsURL = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id, FALSE);
            $manufacturerImage = $manufacturer->images[0]->displayMediaThumb("",false);

            // Show Category ?>
            <div class="category <?php echo $manufacturerCellWidth ?>">
                <div class="spacer">
                    <div class="category-image card">
                            <a title="<?php echo $manufacturer->mf_name; ?>" href="<?php echo $manufacturerURL; ?>"><?php echo $manufacturerImage;?></a>
                    </div>
                    <div class="category-name">
                        <h3>
                            <a title="<?php echo $manufacturer->mf_name; ?>" href="<?php echo $manufacturerURL; ?>"><?php echo $manufacturer->mf_name; ?></a>
                        </h3>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
<?php
}
?>
</div>
<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen

 * @link ${PHING.VM.MAINTAINERURL}
 * @copyright Copyright (c) 2004 - 2012 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showcategory.php 9413 2017-01-04 17:20:58Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ( '_JEXEC' ) or die ( 'Restricted access' );

	if ($this->category->haschildren) {
	    $iCol = 1;
	    $iCategory = 1;
	    $categories_per_row = VmConfig::get ( 'categories_per_row', 3 );
 
        switch($categories_per_row){
            case 1:
                $category_cellwidth = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
                break;
            case 2:
                $category_cellwidth = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
                break;
            case 3:
                $category_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
                break;
            case 4:
                $category_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
                break;
            case 5:
                $category_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
                break;
            case 6:
                $category_cellwidth = 'col-lg-2 col-md-3 col-sm-4 col-xs-12';
                break;
            default:
                $category_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
        }
	    
	    ?>

	    <div class="category-view">

		<?php
		// Start the Output
		if (!empty($this->category->children)) {
            ?>
            <div class="row">
                <?php
                foreach ($this->category->children as $category) {

                    // Category Link
                    $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id, FALSE);

                    // Show Category
                    ?>
                    <div class="category <?php echo $category_cellwidth?>">
                        <div class="spacer">
                            <div class="category-image card">
                                <a href="<?php echo $caturl ?>" title="<?php echo vmText::_($category->category_name) ?>">
                                    <?php echo $category->images[0]->displayMediaThumb("",false); ?>
                                </a>    
                            </div>
                            <div class="category-name">
                                <h3>
                                    <a href="<?php echo $caturl ?>" title="<?php echo vmText::_($category->category_name) ?>">
                                        <?php echo vmText::_($category->category_name) ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php
                } ?>
		    </div>
        <?php
		}
        ?>
	</div>
    <?php }
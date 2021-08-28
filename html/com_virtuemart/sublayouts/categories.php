<?php
/**
*
* Shows the products/categories of a category
*
* @package	VirtueMart
* @subpackage
* @author Max Milbers
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
 * @version $Id: default.php 6104 2012-06-13 14:15:29Z alatak $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

$categories = $viewData['categories'];
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
        $category_cellwidth = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
        break;
    case 5:
        $category_cellwidth = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
        break;
    case 6:
        $category_cellwidth = 'col-lg-2 col-md-3 col-sm-4 col-xs-12';
        break;
    default:
        $category_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
}

if ($categories) {
?>

<div class="category-view">
    <div class="row">
        <?php 
        // Start the Output
        foreach ( $categories as $category ) {
            // Category Link
            $caturl = JRoute::_ ( 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id , FALSE);

            // Show Category ?>
            <div class="category <?php echo $category_cellwidth?>">
                <div class="spacer ">		
					<div class="box_cat-content-wr">
						
						<div class="box-content">
							<div class="images">
								<?php echo $category->images[0]->displayMediaThumb("class='i'",false); ?>
							</div>
							<div class="box-title">
								<div>
									<a href="<?php echo $caturl ?>" rel="nofollow" class="view" title="<?php echo vmText::_($category->category_name) ?>">Смотреть</a>
								</div>
							</div>							
						</div>	
						<div class="box-title">
							<h3><a href="<?php echo $caturl ?>" rel="nofollow" title=""><?php echo vmText::_($category->category_name) ?></a></h3>
						</div> 
						
					</div>		
                </div>
            </div>
        <?php
        } 
        ?>
    </div>
    <div class="clearfix"></div>
</div>

<?php
 } ?>

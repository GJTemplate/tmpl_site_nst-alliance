<?php
/**
 * sublayout products
 *
 * @package	VirtueMart
 * @author Max Milbers
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
 * @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
 */

defined('_JEXEC') or die('Restricted access');
$products_per_row = empty($viewData['products_per_row'])? 1:$viewData['products_per_row'] ;
$currency = $viewData['currency'];
$showRating = $viewData['showRating'];
echo shopFunctionsF::renderVmSubLayout('askrecomjs');

$ItemidStr = '';
$Itemid = shopFunctionsF::getLastVisitedItemId();
if(!empty($Itemid)){
	$ItemidStr = '&Itemid='.$Itemid;
}

$dynamic = false;
if (vRequest::getInt('dynamic',false)) {
	$dynamic = true;
}

switch($products_per_row){
    case 1:
        $product_cellwidth = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
        break;
    case 2:
        $product_cellwidth = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
        break;
    case 3:
        $product_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
        break;
    case 4:
        $product_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
        break;
    case 5:
        $product_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
        break;
    case 6:
        $product_cellwidth = 'col-lg-2 col-md-3 col-sm-4 col-xs-12';
        break;
    default:
        $product_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
}


foreach ($viewData['products'] as $type => $products ) {

    if( (!empty($type) and count($products)>0) or (count($viewData['products'])>1 and count($products)>0)){
        $productTitle = vmText::_('COM_VIRTUEMART_'.strtoupper($type).'_PRODUCT'); ?>
        <div class="<?php echo $type ?>-view">
        <h4><?php echo $productTitle ?></h4>
        <?php // Start the Output
    }

	$BrowseTotalProducts = count($products);

    ?>
    <div class="row product-wrap grid" itemtype="http://schema.org/ItemList" itemscope>
        <?php
        foreach ( $products as $product ) {
            if(!is_object($product) or empty($product->link)) {
                vmdebug('$product is not object or link empty',$product);
                continue;
            } ?>
            <div class="product-block <?php echo $product_cellwidth; ?> b1c-good" itemtype="http://schema.org/Product" itemprop="itemListElement" itemscope="" >
                <div class="spacer product-container card">
					<div class="product-container_wr">
                  
                   <?php echo shopFunctionsF::renderVmSubLayout('vmlabel',array('product'=>$product)); ?>
                    <div class="product-image">  
                       <?php echo shopFunctionsF::renderVmSubLayout('productday',array('product'=>$product)); ?>              
                        <div class="vm-trumb-slider">
                           <div>
                            <a title="<?php echo $product->product_name ?>" href="<?php echo $product->link.$ItemidStr; ?>">
                               <?php echo $product->images[0]->displayMediaThumb('class="img-rounded"', false); ?>
                               </a>
                           </div> 
                           <?php
                            $number = 4;
                            if ($number > count($product->images)){
                                $number = count($product->images);
                            }
                            for ($i = 1; $i < $number; $i++){ ?>
                                <div>
                                    <a title="<?php echo $product->product_name ?>" href="<?php echo $product->link.$ItemidStr; ?>">
                                    <img class="img-rounded" data-lazy="<?php echo "/".$product->images[$i]->getFileUrlThumb(); ?>">
                                    </a>
                                </div>
                            <?php    
                            } 
                            ?>  
                        </div>
                        <?php //include JPATH_PLUGINS.'/system/vmquickview/tmpl/vmquickview-button.php'; ?>
                    </div>
                    <meta itemprop="image" content="<?php echo JURI::base().$product->images[0]->file_url?>"/>

                    <div class="product-info">
                        <div class="product-name b1c-name" itemprop="name">
                            <?php echo JHtml::link ($product->link.$ItemidStr, $product->product_name,' itemprop="url"'); ?>
                        </div>
                        
                        <div class="clearfix"></div>						
						
                        <?php if (!empty($product->product_s_desc)): ?>
                        <div class="product_s_desc" itemprop="description">
                            <?php echo nl2br($product->product_s_desc); ?>
                        </div>
                        <?php endif; ?>         
                    </div>

                    <div class="product-details" itemtype="http://schema.org/Offer" itemprop="offers" itemscope>			
                        <?php echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency));
                        echo "<meta itemprop='price' content='".$product->prices['salesPrice']."'>";
                        echo "<meta itemprop='priceCurrency' content='".$currency->_vendorCurrency_code_3."'>";
                        ?>
                    </div>				
				</div>		
					
                <?php if(vRequest::getInt('dynamic')){
                    echo vmJsApi::writeJS();
                } ?>
                </div>
            </div>
        <?php
        } ?>
    </div>
    <div class="clearfix"></div>
    <?php
    if(!empty($type)and count($products)>0){ ?>
        </div>
    <?php
    }
  }

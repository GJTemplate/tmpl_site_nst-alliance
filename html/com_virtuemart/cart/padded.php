<?php
/**
*
* Layout for the add to cart popup
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link ${PHING.VM.MAINTAINERURL}
* @copyright Copyright (c) 2013 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
$productModel = VmModel::getModel('Product');
?>
<div class="padded-wrap">
    <div class="btn-padded-wrap">
        <?php
        echo '<a class="continue_link btn btn-default" href="' . $this->continue_link . '" >' . vmText::_('COM_VIRTUEMART_CONTINUE_SHOPPING') . '</a>';
        echo '<a class="showcart pull-right btn btn-primary" href="' . $this->cart_link . '">' . vmText::_('COM_VIRTUEMART_CART_SHOW') . '</a>';
        ?>
    </div>
    <div class="clearfix"></div>
    
    <div class="padded-product">
        <?php    
        if($this->products){
            foreach($this->products as $product){
                if($product->quantity>0){
                    $productModel->addImages($product);
                    ?>
                    <div class="padded-product-image">
                        <?php echo $product->images[0]->displayMediaThumb('class="padded-img img-rounded"',false); ?>
                    </div>
                    <div class="padded-product-name">
                        <?php echo vmText::sprintf('COM_VIRTUEMART_CART_PRODUCT_ADDED',$product->product_name.'</h4>','<h4>'.$product->quantity); ?> 
                    </div>
                    <div class="clearfix"></div>
                    <?php
                } else {
                    if(!empty($product->errorMsg)){
                        echo '<div>'.$product->errorMsg.'</div>';
                    }
                }

            }
        }
        ?>
    </div>
    <?php

    if(VmConfig::get('popup_rel',1)){
        //VmConfig::$echoDebug=true;
        if ($this->products and is_array($this->products) and count($this->products)>0 ) {

            $product = reset($this->products);

            $customFieldsModel = VmModel::getModel('customfields');
            $product->customfields = $customFieldsModel->getCustomEmbeddedProductCustomFields($product->allIds,'R');

            $customFieldsModel->displayProductCustomfieldFE($product,$product->customfields);
            if(!empty($product->customfields)){
                ?>
                <div class="product-related-products">
                <h4><?php echo vmText::_('COM_VIRTUEMART_RELATED_PRODUCTS'); ?></h4>
                <?php
            }
            ?>
            <div class="row product-wrap">
                <?php            
                foreach($product->customfields as $rFields){
                        if(!empty($rFields->display)){
                        ?><div class="product-block col-sm-4 col-xs-6">
                        <?php echo $rFields->display ?>
                        </div>
                    <?php }
                } ?>

                </div>
            </div>
        <?php
        }
    }

    ?>
</div>
<script>
jQuery(document).ready(function($) {
    $('.continue_link').click(function () { 
        $.fancybox.close();
        return false;
    });
    $('html.component  .pull-right').click(function () {       
        parent.window.location.replace("/cart");
        return false;
    });
});
</script>
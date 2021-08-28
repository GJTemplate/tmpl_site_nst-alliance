<?php defined('_JEXEC') or die('Restricted access');

$related = $viewData['related'];
$customfield = $viewData['customfield'];
$thumb = $viewData['thumb'];


//juri::root() For whatever reason, we used this here, maybe it was for the mails
?>
<div class="spacer product-container card">
   <?php echo shopFunctionsF::renderVmSubLayout('vmlabel',array('product'=>$related)); ?>
    <div class="product-image">
        <?php
        echo JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id), $thumb, array('title' => $related->product_name));
        ?>
    </div>
    <div class="product-info">
        <div class="product-name">
            <?php
            echo JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id),$related->product_name, array('title' => $related->product_name));
            ?>
        </div>
    </div>
    <div class="product-details"><?php
        if($customfield->wPrice){
            $currency = calculationHelper::getInstance()->_currencyDisplay;
            echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$related,'currency'=>$currency));        
        }
        
        if($customfield->wDescr){
            echo '<div class="product_s_desc">'.$related->product_s_desc.'</div>';
        }
        
        if($customfield->waddtocart){
            ?><div class="product-cart" ><?php
            echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$related,'rowHeights'=>1, 'position' => array('ontop', 'addtocart')));
            ?></div><?php
        }
            ?>
    </div>
</div>
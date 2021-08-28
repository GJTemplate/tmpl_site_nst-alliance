<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();


$col = 1;

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

?>
<div class="row product-wrap <?php echo $params->get ('moduleclass_sfx') ?>">

	<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
	<?php
    }
	
    foreach ($products as $product) { ?>
    <div class="product-block <?php echo $product_cellwidth ?>">
        <div class="spacer product-container card">
           <?php echo shopFunctionsF::renderVmSubLayout('vmlabel',array('product'=>$product)); ?>
            <div class="product-image">
                <?php
                if (!empty($product->images[0])) {
                    $image = $product->images[0]->displayMediaThumb ('class="img-rounded"', FALSE);
                } else {
                    $image = '';
                }
                echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
                ?>
            </div>

            <div class="product-info">
                <div class="product-name">  
                    <?php                         
                    $url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .$product->virtuemart_category_id); ?>
                    <a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>
                </div> 

                <?php
                JPluginHelper::importPlugin('system', 'vmrating');
                $dispatcher = JDispatcher::getInstance();
                $ratingParams = [
                    array(
                        'id' => $product->virtuemart_product_id,
                        'average_rating' => false,
                        'count_votes' => true,
                        'count_votes_text' => false,
                        'active_voting' => false,
                        'only_reg' => false,
                        'micro_data' => false
                    )
                ];
                $results = $dispatcher->trigger('showRating', $ratingParams);
                ?>
            </div>

            <div class="product-details">  
                <?php                                                  
                if ($show_price) {
                    echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency));
                }
                ?>

                <div class="product-cart">
                    <?php
                    if ($show_addtocart) {
                        echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product));
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    } ?>
    <div class="clearfix"></div>

    <?php
	if ($footerText) : ?>
		<div class="vmfooter<?php echo $params->get ('moduleclass_sfx') ?>">
			<?php echo $footerText ?>
		</div>
		<?php endif; ?>
</div>
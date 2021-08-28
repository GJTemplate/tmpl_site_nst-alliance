<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
// add javascript for price and cart, need even for quantity buttons, so we need it almost anywhere
vmJsApi::jPrice();

?>

<div class="vmslider-wrap<?php echo $moduleclass_sfx; ?> trendshop-slider">

	<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
	<?php
    }
	?>
    <div class="vmslider product-wrap <?php if($nav_nav == '1') echo 'nav-top'; if($nav_dots == '1' && $nav_nav == '0') echo 'nav-dots'; ?>">
        <?php foreach ($products as $product) { ?>
        <div class="product-block">
            <div class="spacer product-container card">
               <?php echo shopFunctionsF::renderVmSubLayout('vmlabel',array('product'=>$product)); ?>
                <?php
                // Product image
                $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id);
                if (!empty($product->images[0]) )
                $image = '<div class="image1">'.$product->images[0]->displayMediaThumb('class="img-rounded"',false).'</div>';
                else $image = '';
                ?>
                <div class="product-image <?php if($twoImage == '2') echo 'zoom-image'; if($twoImage == '1') echo 'no-opacity'; ?>">
                    <a href="<?php echo $url ?>">
                    <?php if($twoImage == 0) {
                              if (!empty($product->images[1]) ){
                                  $image2 = '<div class="image2">'.$product->images[1]->displayMediaThumb('class="img-rounded"',false).'</div>' ;
                                  echo $image.$image2;
                              }
                              else {
                                  $image = '<div class="oneimage">'.$product->images[0]->displayMediaThumb('class="img-rounded"',false).'</div>' ;
                                  echo $image;   
                              }
                          } else {
                              echo $image;
                          }
                        ?>
                    </a>
                </div>
                
                <?php 
                // Product name
                ?>
                <div class="product-info">
                    <div class="product-name"><a href="<?php echo $url ?>"><?php echo $product->product_name ?></a></div>
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

                <div class="product-details">
                   <?php
                    if ($show_price) {
                        echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$product,'currency'=>$currency));
                    } ?>
                    <?php
                    if ($show_addtocart) { ?>
                        <div class="product-cart">
                        <?php echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$product)); ?>
                       </div>
                    <?php
                    }
                    ?>
                </div>  
            </div>
        </div>
    <?php    
    } ?>
    </div>
		<?php
	if ($footerText) : ?>
		<div class="vmfooter<?php echo $params->get ('moduleclass_sfx') ?>">
			<?php echo $footerText ?>
		</div>
		<?php endif; ?>
</div>
<script>
jQuery('.vmslider-wrap<?php echo $moduleclass_sfx; ?> .vmslider').slick({
    dots: <?php echo ($nav_dots == '1') ? 'true' : 'false'; ?>,
    arrows: <?php echo ($nav_nav == '2') ? 'false' : 'true'; ?>,
    infinite: <?php echo ($loop == '1') ? 'true' : 'false'; ?>,
    autoplay: <?php echo ($autoplay == '1') ? 'true' : 'false'; ?>,
    autoplaySpeed: <?php echo $autoplayTimeout; ?>,
    slidesToShow: <?php echo $large?>,
    slidesToScroll: 1,
    swipeToSlide: true,
    speed: 200,
    responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: <?php echo $medium; ?>,
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: <?php echo $small; ?>,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: <?php echo $extrasmall; ?>,
          }
        }
    ]
});
</script>
<?php // no direct access
defined( '_JEXEC' ) or die('Restricted access');
vmJsApi::jPrice();
?>

<?php if($headerText) { ?>
    <div class="vmheader"><?php echo $headerText ?></div>
<?php } ?>

<div class="product-wrap product-day-module <?php echo $moduleclass_sfx; 
if(!$showSlider) echo ' noslider';
if($nav_dots) echo ' nav-dots'; ?>">
    <?php if(!$notimer){ ?>
        <?php foreach( $products as $product ) { ?>

        <?php if($product->prices['product_price_publish_down'][0]): ?>   
        <?php 
        if($product->prices['salesPrice'] !== $product->prices['product_price']) // проверка наличия скидки на товар
            $sale = true;
        else $sale = false;
        ?>

            <div class="product-block product-day-wrap <?php if($styleModule == 2) echo 'full-width'; ?>">
                <div class="spacer product-container card product-day">   
                    <div class="label label-warning product-day-label">
                        <?php echo vmText::_('MOD_VM_PRODUCT_DAY_PLATE'); ?> 
                    </div>
                    <?php if($percentProduct): ?>
                        <?php if($sale): ?>
                        <div class="product-day-discount">
                            <?php 
                                $percent = round(($product->prices['product_price'] - $product->prices['salesPrice'])*100/$product->prices['product_price']); // процент скидки ?>
                             <span class="discount-val"><?php echo $percent.'%'; ?></span>
                             <span class="discount-label"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_DISCOUNT'); ?></span>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php 
                    $datePublish = new DateTime($product->prices['product_price_publish_down']);
                    $date = $datePublish->format('Y-m-d');   
                    ?>

                    <?php if($styleModule == 2) echo '<div class="product-day-left">'; ?>
                    <div class="product-day-image">
                        <?php
                        if(!empty($product->images[0]))
                            $image = $product->images[0]->displayMediaThumb( 'class="img-rounded" ', false );
                        else $image = '';

                        echo JHTML::_( 'link', JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id ), $image, array('title' => $product->product_name) ); ?>
                    </div>                                    
                    <div class="product-day-timer-wrap">
                        <div class="product-day-timer theme1" data-countdown="<?php echo $date; ?>"></div> 
                    </div>
                    <?php if($styleModule == 2) echo '</div>'; ?>

                    <div class="product-info">
                        <div class="product-name">
                            <?php
                            $url = JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.
                            $product->virtuemart_category_id ); ?>
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

                        <div class="product-day-price">
                            <div class="price-sale">
                                <?php echo $currency->createPriceDiv ('salesPrice', '', $product->prices, true); ?>
                            </div>
                            <?php if($sale): ?>
                            <div class="price-base">
                                <?php echo $currency->createPriceDiv ('product_price', '', $product->prices, true); ?>
                            </div> 
                            <?php endif; ?>                   
                        </div>

                        <?php if($economy): ?>
                            <?php if($sale): ?>
                            <div class="product-day-economy">
                                <?php 
                                mb_internal_encoding("UTF-8");
                                $discount = mb_substr($product->prices['discountAmount'],1);
                                $discount = number_format($discount, 0, ',', ' ');
                                echo vmText::_('MOD_VM_PRODUCT_DAY_ECONOMY_TEXT').'<span>'.$discount.' '.$currency->getSymbol().'</span>';
                                ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($desc): ?>
                        <div class="product-day-desc">
                            <?php 
                            if (!empty($product->product_s_desc)) {
                                echo nl2br($product->product_s_desc);
                            } ?>
                        </div>
                        <?php endif; ?>

                        <?php
                        if($show_addtocart) { ?>
                        <div class="product-day-cart <?php if($cartStyle) echo 'sliderCart'; if($customfield) echo ' customFields';?>">
                            <?php echo shopFunctionsF::renderVmSubLayout( 'addtocart', array('product' => $product) ); ?>
                        </div>
                        <?php 
                        } ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php } ?>
    <?php 
    } else {
    ?>
        <?php foreach( $products as $product ) { ?>
        <?php 
        if($product->prices['salesPrice'] !== $product->prices['product_price']) // проверка наличия скидки на товар
            $sale = true;
        else $sale = false;
        ?>

            <div class="product-block product-day-wrap <?php if($styleModule == 2) echo 'full-width'; ?>">
                <div class="spacer product-container card product-day ">
                   <div class="label label-warning product-day-label">
                                <?php echo vmText::_('MOD_VM_PRODUCT_DAY_PLATE'); ?> 
                            </div>
                    <?php if($percentProduct): ?>
                        <?php if($sale): ?>
                        <div class="product-day-discount">
                            <?php 
                                $percent = round(($product->prices['product_price'] - $product->prices['salesPrice'])*100/$product->prices['product_price']); // процент скидки ?>
                             <span class="discount-val"><?php echo $percent.'%'; ?></span>
                             <span class="discount-label"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_DISCOUNT'); ?></span>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php 
                    $datePublish = new DateTime($product->prices['product_price_publish_down']);
                    $date = $datePublish->format('Y-m-d');   
                    ?>

                    <?php if($styleModule == 2) echo '<div class="product-day-left">'; ?>
                    <div class="product-day-image">
                        <?php
                        if(!empty($product->images[0]))
                            $image = $product->images[0]->displayMediaThumb( 'class="img-rounded" ', false );
                        else $image = '';

                        echo JHTML::_( 'link', JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id ), $image, array('title' => $product->product_name) ); ?>
                    </div>  
                    <?php if($product->prices['product_price_publish_down'][0]): ?>                              
                        <div class="product-day-timer-wrap">
                            <div class="product-day-timer theme1" data-countdown="<?php echo $date; ?>"></div> 
                        </div>
                    <?php endif; ?>
                    <?php if($styleModule == 2) echo '</div>'; ?>
                    <div class="product-info">
                        <div class="product-name">
                            <?php
                            $url = JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.
                            $product->virtuemart_category_id ); ?>
                            <a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>
                        </div>

                        <div class="product-day-price">
                            <div class="price-sale">
                                <?php echo $currency->createPriceDiv ('salesPrice', '', $product->prices, true); ?>
                            </div>
                            <?php if($sale): ?>
                            <div class="price-base">
                                <?php echo $currency->createPriceDiv ('product_price', '', $product->prices, true); ?>
                            </div> 
                            <?php endif; ?>                   
                        </div>

                        <?php if($economy): ?>
                            <?php if($sale): ?>
                            <div class="product-day-economy">
                                <?php 
                                mb_internal_encoding("UTF-8");
                                $discount = mb_substr($product->prices['discountAmount'],1);
                                $discount = number_format($discount, 0, ',', ' ');
                                echo vmText::_('MOD_VM_PRODUCT_DAY_ECONOMY_TEXT').'<span>'.$discount.' '.$currency->getSymbol().'</span>';
                                ?>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($desc): ?>
                        <div class="product-day-desc">
                            <?php 
                            if (!empty($product->product_s_desc)) {
                                echo nl2br($product->product_s_desc);
                            } ?>
                        </div>
                        <?php endif; ?>

                        <?php
                        if($show_addtocart) { ?>
                        <div class="product-day-cart <?php if($cartStyle) echo 'sliderCart'; if($customfield) echo ' customFields';?>">
                            <?php echo shopFunctionsF::renderVmSubLayout( 'addtocart', array('product' => $product) ); ?>
                        </div>
                        <?php 
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php
    } 
    ?>
</div>
<?php if($footerText) { ?>
    <div class="vmheader"><?php echo $footerText ?></div>
<?php } ?>

<script>
    (function($, undefined){
        <?php if($showSlider): ?>
        $(".product-day-module<?php echo $sfx;?>").slick({
            dots: <?php echo ($nav_dots == '1') ? 'true' : 'false'; ?>,
            arrows: <?php echo ($nav_nav == '0') ? 'false' : 'true'; ?>,
            infinite: <?php echo ($loop == '1') ? 'true' : 'false'; ?>,
            autoplay: <?php echo ($autoplay == '1') ? 'true' : 'false'; ?>,
            autoplaySpeed: <?php echo $autoplayTimeout; ?>, 
            slidesToScroll: 1,
            swipeToSlide: true,
            speed: 200,
            <?php if($styleModule == 2) {?>
            slidesToShow: 1,
            <?php } else{?>
            slidesToShow: <?php echo $large?>,
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
            <?php } ?>
        });
        <?php endif; ?>
        $(".product-day-module<?php echo $sfx;?> [data-countdown]").each(function () {
            var $this = $(this),
                finalDate = $(this).data('countdown');           
            $this.countdown(finalDate, function (event) {
            var format =  '<div class="countHour"><span class="countVal">%H</span> <span class="countDesc"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_COUNTHOUR')?></span> </div>'
                + '<div class="countMin"><span class="countVal">%M</span> <span class="countDesc"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_COUNTMIN')?></span> </div>'
                + '<div class="countSec"><span class="countVal">%S</span> <span class="countDesc"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_COUNTSEC')?></span></div>';
                if (event.offset.totalDays > 0){
                    format = '<div class="countDay"><span class="countVal">%-D</span> <span class="countDesc"><?php echo vmText::_('MOD_VM_PRODUCT_DAY_COUNTDAY')?></span> </div>' + format;
                } 
                $this.html(event.strftime(format));       
            });
        });
    })(jQuery);
</script>
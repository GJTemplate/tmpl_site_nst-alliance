<?php
defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];

if($product->prices['product_price_publish_down'][0]){
    $datePublish = new DateTime($product->prices['product_price_publish_down']);
    $date = $datePublish->format('Y-m-d'); ?>
    <div class="product-day-timer-product">
       <div class="product-day-timer-product-title">
           <span class="label label-warning"><?php echo JText::_('MOD_VM_PRODUCT_DAY_PLATE');?></span>
       </div>
        <div class="product-day-timer theme1" data-countdown="<?php echo $date; ?>"></div> 
    </div>
    <script>
    jQuery(document).ready(function($){
        $(".product-day-timer-product [data-countdown]").each(function () {
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
    });
</script>
<?php    
}
?>

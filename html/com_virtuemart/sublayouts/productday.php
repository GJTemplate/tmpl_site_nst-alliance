<?php
defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];

if($product->prices['product_price_publish_down'][0]){
    $datePublish = new DateTime($product->prices['product_price_publish_down']);
    $date = $datePublish->format('Y-m-d'); ?>
    <div class="product-day-timer-block dropup">
        
        <div class="product-day-label label label-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <?php echo '<i class="fa fa-info-circle" aria-hidden="true"></i> '.JText::_('MOD_VM_PRODUCT_DAY_PLATE'); ?> 
        </div>
        <div class="dropdown-menu dropdown-primary dropdown-menu-right dropdown-medium">
            <div class="dropdown-header text-center"><?php echo JText::_('PRODUCT_DAY__DROPDOWN_TITLE'); ?></div>
            <div class="product-day-timer theme1" data-countdown="<?php echo $date; ?>"></div>
        </div> 
    </div>
<?php    
}
?>
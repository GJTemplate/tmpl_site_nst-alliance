<?php
$product = $viewData['product'];
// Availability
$stockhandle = VmConfig::get('stockhandle', 'none');
$product_available_date = substr($product->product_available_date,0,10);
$current_date = date("Y-m-d");

// label stock
if (($product->product_in_stock - $product->product_ordered) < 1) { ?>
    <div class="nostock text-stock-warning"><?php echo JText::sprintf('COM_VIRTUEMART_PRODUCT_NOSTOCK'); ?></div>
<?php } else { ?>
    <div class="nostock text-stock-success"><?php echo JText::sprintf('COM_VIRTUEMART_PRODUCT_STOCK'); ?></div>
<?php
}
?>
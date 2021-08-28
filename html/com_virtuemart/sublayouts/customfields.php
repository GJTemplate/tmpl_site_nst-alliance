<?php
/**
* sublayout products
*
* @package	VirtueMart
* @author Max Milbers
* @link ${PHING.VM.MAINTAINERURL}
* @copyright Copyright (c) 2014 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL2, see LICENSE.php
* @version $Id: cart.php 7682 2014-02-26 17:07:20Z Milbo $
*/

defined('_JEXEC') or die('Restricted access');

$product = $viewData['product'];
$position = $viewData['position'];
$customTitle = isset($viewData['customTitle'])? $viewData['customTitle']: false;;
if(isset($viewData['class'])){
	$class = $viewData['class'];
} else {
	$class = 'product-fields';
}

if (!empty($product->customfieldsSorted[$position])) {
    // проверка на принадлежность поля к сопутствующим товарам или категориям
    if($position == 'related_products'){
        $relProd = true;  
        $product_cellwidth = 'product-block col-lg-3 col-md-4 col-sm-6 col-xs-12';
    } else{
        $relProd = false;  
    }
    if($position == 'related_categories'){
        $relCat = true;
        $category_cellwidth = 'category col-lg-3 col-md-4 col-sm-6 col-xs-12';
    } else {
        $relCat = false;
    }
	?>
	<div class="<?php echo $class?>">
		<?php
		if($customTitle and isset($product->customfieldsSorted[$position][0]) and !$relProd){
			$field = $product->customfieldsSorted[$position][0]; ?>
		<div class="product-fields-title-wrapper"><span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
			<?php if ($field->custom_tip) {
				echo JHtml::tooltip (vmText::_($field->custom_tip), vmText::_ ($field->custom_title), '','<i class="fa fa-info-circle" aria-hidden="true"></i>');
			} ?>
		</div> <?php
		}
		$custom_title = null;
    
        if($relProd){
            echo '<div class="row product-wrap">';
        }
        if($relCat){
            echo '<div class="category-view"><div class="row">';
        }
        
		foreach ($product->customfieldsSorted[$position] as $field) {
			if ( $field->is_hidden || empty($field->display)) continue; //OSP http://forum.virtuemart.net/index.php?topic=99320.0
			?><div class="product-field product-field-type-<?php echo $field->field_type.' ';
            if($relProd) echo $product_cellwidth;
            if($relCat) echo  $category_cellwidth;
            ?>">
				<?php if (!$customTitle and $field->custom_title != $custom_title and $field->show_title and !$relCat) { ?>
					<span class="product-fields-title-wrapper">
						<span class="product-fields-title"><strong><?php echo vmText::_ ($field->custom_title) ?></strong></span>
						<?php if ($field->custom_tip) {
							echo JHtml::tooltip (vmText::_($field->custom_tip), vmText::_ ($field->custom_title), '','<i class="fa fa-info-circle" aria-hidden="true"></i>');
						} ?>
					</span>
				<?php }
				if (!empty($field->display)){
					?>
					<?php 
                    if($relProd || $relCat){ 
                        echo $field->display;
					} else { ?>
                        <div class="product-field-display">
							<?php //$field->display = JHtml::_('content.prepare', $field->display);?>
							<?php echo $field->display ?>
						</div>
                    <?php
                    }
				}
				if (!empty($field->custom_desc) && !($relProd || $relCat)){
					?><div class="product-field-desc"><?php echo vmText::_($field->custom_desc) ?></div> <?php
				}
				?>
			</div>
		<?php
			$custom_title = $field->custom_title;
		} ?>
     
        <?php
        if($relProd){
            echo '</div>';
        }
        if($relCat){
            echo '</div></div>';
        }
        ?>
      <div class="clear"></div>
	</div>
<?php
} ?>
<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9288 2016-09-12 15:20:56Z Milbo $
 */

defined ('_JEXEC') or die('Restricted access');

if(vRequest::getInt('dynamic')){
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}
?> <div class="category-view"> <?php
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";
vmJsApi::addJScript('vm.hover',$js);

?>
   <h1><?php echo vmText::_($this->category->category_name); ?></h1>
       <?php    
    
if (!empty($this->showcategory_desc) and empty($this->keyword) and !empty($this->category)) {
	?>
<?php 
$start = JRequest::getInt('limitstart',0);  
$option = JRequest::getVar('option',''); 
if(!$start && $option == 'com_virtuemart'){ ?>
    <div class="category_description">
        <?php echo $this->category->category_description; ?>
    </div>
<?php } ?>
<?php
}

// Show child categories
if ($this->showcategory and $this->keyword === false) {
	if (!empty($this->category->haschildren)) {
        $virtuemart_manufacturer = JRequest::getVar('virtuemart_manufacturer_id');
		if(empty($virtuemart_manufacturer)){
		  echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children));
        }
	}
}

if($this->showproducts){
?>
<div class="browse-view">
<?php

if ($this->showsearch or !empty($this->keyword)) {
	//id taken in the view.html.php could be modified
	$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>
    <h3 class="search-title"><?php echo vmText::_ ('COM_VIRTUEMART_RESULT_SEARCH') ?> <?php echo $this->keyword; ?></h3>
	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
            <div class="vm-search">
                <div class="form-group">
                   <input name="keyword" class="inputbox form-control" type="text" size="40" value="<?php echo $this->keyword ?>"/>
                    <!--<input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>-->
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    <?php //echo VmHtml::checkbox ('searchAllCats', (int)$this->searchAllCats, 1, 0, 'class="changeSendForm"'); ?>
                </div>
            </div>

			<!-- input type="hidden" name="showsearch" value="true"/ -->
			<input type="hidden" name="view" value="category"/>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
		</form>
	</div>
	<!-- End Search Box -->
<?php
	/*if($this->keyword !== false){
		?><h3><?php echo vmText::sprintf('COM_VM_SEARCH_KEYWORD_FOR', $this->keyword); ?></h3><?php
	}*/
	$j = 'jQuery(document).ready(function() {

jQuery(".changeSendForm")
	.off("change",Virtuemart.sendCurrForm)
    .on("change",Virtuemart.sendCurrForm);
})';

	vmJsApi::addJScript('sendFormChange',$j);
} ?>

<?php // Show child categories

if(!empty($this->orderByList) && !empty($this->products)) { ?>
<div class="orderby-displaynumber">
    <div class="product-view">
       <div class="title">Вид: </div>
        <div class="btn-group">
            <a href="#" class="btn btn-default grid"><i class="fa fa-th-large"></i></a>
            <a href="#" class="btn btn-default list"><i class="fa fa-th-list"></i></a>
        </div>
    </div>
    <div class="product-order">
        <?php echo $this->orderByList['orderby']; ?>
        <?php if(empty($this->keyword)){ // скрыть выбор произволителей на странице поиска ?>        
        <?php echo $this->orderByList['manufacturer']; ?>
        <?php } ?>
    </div>    
    <div class="display-number">
        <?php //echo $this->vmPagination->getResultsCounter ();?>
        <?php echo '<div class="title">'.JText::_('COM_VIRTUEMART_COUNT_PRODUCT_TEXT').'</div>'.$this->vmPagination->getLimitBox ($this->category->limit_list_step); ?>
    </div>
</div> <!-- end of orderby-displaynumber -->
<div class="clearfix"></div>
<?php } ?>

	<?php
	if (!empty($this->products)) {
		//revert of the fallback in the view.html.php, will be removed vm3.2
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

	echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));
    ?>
    
    <?php    
	if(!empty($this->orderByList)) { ?>
		  <div class="product-pagination">
		      <?php echo $this->vmPagination->getPagesLinks (); ?>
		  </div>
    <?php }
        
} elseif (!empty($this->keyword)) {
	echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div>

<?php } ?>
</div>

<?php
if(VmConfig::get ('jdynupdate', TRUE)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	//vmJsApi::addJScript('ajaxContent',$j);
}
?>
<!-- end browse-view -->
<?php // смена вида каталога ?>
<script>
    var productView = localStorage.getItem('productView'); 
    if(productView == 'list'){
        jQuery('.product-view .grid').removeClass('active');
        jQuery('.product-view .list').addClass('active');
        jQuery('.category-view .browse-view .row.product-wrap').removeClass('grid').addClass('line');    
    } else{
        jQuery('.product-view .grid').addClass('active');
    }
    jQuery('.product-view .grid').click(function(){
        localStorage.removeItem('productView');
        localStorage.setItem('productView', 'grid');
        jQuery('.product-view .list').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.category-view .browse-view .row.product-wrap').fadeOut('fast', function() {
            jQuery('.category-view .browse-view .row.product-wrap').removeClass('line').addClass('grid').fadeIn('fast');
        });
        return false;
    });
    jQuery('.product-view .list').click(function(){
        localStorage.removeItem('productView');
        localStorage.setItem('productView', 'list');
        jQuery('.product-view .grid').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.category-view .browse-view .row.product-wrap').fadeOut('fast', function() {
            jQuery('.category-view .browse-view .row.product-wrap').removeClass('grid').addClass('line').fadeIn('fast');
        });
        return false;
    });
</script>

<?php // товар дня ?>
<?php 
$doc = JFactory::getDocument();
$doc->addScript('/modules/mod_vm_product_day/assets/product-countdown.js');
//$doc->addStyleSheet('/modules/mod_vm_product_day/assets/product-countdown.css');
?>
<script>
    jQuery(document).ready(function($){
        $(".product-day-timer-block [data-countdown]").each(function () {
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



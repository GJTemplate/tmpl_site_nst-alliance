<?php
/**
 *
 * Show the product details page
 *
 * @package	VirtueMart
 * @subpackage
 * @author Max Milbers, Eugen Stranz, Max Galt
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2014 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9292 2016-09-19 08:07:15Z Milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


/*--- Микроразметка Open Graph для карточки товара ---*/
$doc = JFactory::getDocument();
$head = '<meta property="og:title" content="'.$this->product->product_name.'" />';
if (!empty($this->product->product_s_desc)) {
   $head .= '<meta property="og:description" content="'.htmlspecialchars(strip_tags($this->product->product_desc)).'" />';
   } elseif (!empty($this->product->product_desc)) { 
  $head .= '<meta property="og:description" content="'.htmlspecialchars(strip_tags($this->product->product_desc)).'"/>'; 
   } 
$head .= '<meta property="og:image" content="'.JURI::base().$this->product->images[0]->file_url.'" />';
$head .= '<meta property="og:type" content="website" />';
$head .= '<meta property="og:site_name" content="nst-alliance.com.ua"/>';
$head .= '<meta property="og:url" content="'.JFactory::getURI().'" />';
$doc->addCustomTag($head);
/*--- END Микроразметка Open Graph для карточки товара ---*/

/* Ппроверка обязательных полей START */
/* 
JLoader::registerNamespace( 'GNZ11' , JPATH_LIBRARIES . '/GNZ11' , $reset = false , $prepend = false , $type = 'psr4' );
$GNZ11_js =  \GNZ11\Core\Js::instance();
$doc = \Joomla\CMS\Factory::getDocument();
$Jpro = $doc->getScriptOptions('Jpro') ;
$Jpro['load'][] = [
    'u' => '/templates/demomir/assets/js/demomir.productdetails.js' , // Путь к файлу
    't' => 'js' ,                                       // Тип загружаемого ресурса
    'c' => '' ,                             // метод после завершения загрузки
];
$Jpro['load'][] = [
    'u' => '/templates/demomir/assets/css/demomir.productdetails.css' , // Путь к файлу
    't' => 'css' ,                                       // Тип загружаемого ресурса
    'c' => '' ,                             // метод после завершения загрузки
];
$doc->addScriptOptions('Jpro' , $Jpro ) ;

$doc->addStyleDeclaration(
        '
        .product-field-display .controls label:first-child {display: none;}
        '
);
/* Ппроверка обязательных полей --END */

/* Let's see if we found the product */
if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

if(vRequest::getInt('print',false)){ ?>
<body onload="javascript:print();">
<?php } ?>

<div class="product-container productdetails-view productdetails b1c-good" itemscope itemtype="http://schema.org/Product">  
	<div class="row">
		<div class="product-title col-lg-9 col-md-9 col-sm-12 col-xs-12">
		   <?php // Product Title   ?>
				<h1 itemprop="name" class="b1c-name"><?php echo $this->product->product_name ?></h1>
		   <?php // Product Title END   ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 product-rating">
                <?php
                echo shopFunctionsF::renderVmSubLayout('rating',array('showRating'=>$this->showRating,'product'=>$this->product));

                if (is_array($this->productDisplayShipments)) {
                    foreach ($this->productDisplayShipments as $productDisplayShipment) {
                    //echo $productDisplayShipment;
                    }
                }
                if (is_array($this->productDisplayPayments)) {
                    foreach ($this->productDisplayPayments as $productDisplayPayment) {
                    //echo $productDisplayPayment;
                    }
                }

                ?> <div class="clearfix"></div>
					
                <?php
                JPluginHelper::importPlugin('system', 'vmrating');
                $dispatcher = JDispatcher::getInstance();
                $ratingParams = [
                    array(
                        'id' => $this->product->virtuemart_product_id,
                        /*'average_rating' => true,*/
                        /*'count_votes' => true,*/
                        /*'count_votes_text' => true,*/
                        'active_voting' => true,
                        'only_reg' => false,
                        'micro_data' => true
                    )
                ];
                $results = $dispatcher->trigger('showRating', $ratingParams);
                ?>
		</div>	
	</div>
		
	<div class="productdetails-wrap">
        <div class="product-icon-wrap">
            <?php // Back To Category Button
            if ($this->product->virtuemart_category_id) {
                $catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE);
                $categoryName = vmText::_($this->product->category_name) ;
            } else {
                $catURL =  JRoute::_('index.php?option=com_virtuemart');
                $categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
            }
            ?> 
            <?php
            $backCategory = false; // показать кнопку Вернуться в категорию
            if($backCategory){ ?> 
                <div class="back-to-category">
                    <a href="<?php echo $catURL ?>" class="btn btn-default btn-sm btn-move-left" title="<?php echo $categoryName ?>"><?php echo '<i class="fa fa-reply" aria-hidden="true"></i> '.vmText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?></a>
                </div>
            <?php } ?>
            <?php // afterDisplayTitle Event
            echo $this->product->event->afterDisplayTitle ?>
            <?php
            // Product Edit Link
            echo $this->edit_link;
            // Product Edit Link END
            ?>
            <?php
            // PDF - Print - Email Icon
            if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_icon')) {
            ?>
                <div class="icons btn-group">
                <?php

                $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

                //echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_icon', false);
                if (VmConfig::get('pdf_icon')) echo JHTML::_('link', $link . '&format=pdf', '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>', array('class' => 'btn btn-default btn-sm'));
                //echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');
                //echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon',false,true,false,'class="printModal"');
                if (VmConfig::get('show_printicon')) echo JHTML::_('link', $link . '&print=1', '<i class="fa fa-print" aria-hidden="true"></i>', array('class' => 'btn btn-default btn-sm recommened-to-friend'));
                $MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';
                //echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend', false,true,false,'class="recommened-to-friend"');
                if (VmConfig::get('show_emailfriend')) echo JHTML::_('link', $MailLink, '<i class="fa fa-envelope-o" aria-hidden="true"></i>', array('class' => 'recommened-to-friend btn btn-default btn-sm'));
                ?>
                </div>
                <div class="clearfix"></div>
            <?php } // PDF - Print - Email Icon END
            ?>
        </div>
        <?php
            echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'ontop'));
        ?>

        <div class="vm-product-container row">
            <div class="product-media-container col-lg-8 col-md-7 col-sm-12 col-xs-12">
               <?php echo shopFunctionsF::renderVmSubLayout('vmlabel',array('product'=>$this->product)); ?>
                <?php
                echo $this->loadTemplate('images');
                ?>
                <meta itemprop="image" content="<?php echo JURI::base().$this->product->images[0]->file_url?>"/>
            </div>

            <div class="product-details-container col-lg-4 col-md-5 col-sm-12 col-xs-12">
                <div class="spacer-buy-area" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
 
                <?php 
                // товар дня
                $doc = JFactory::getDocument();
                $doc->addScript('/modules/mod_vm_product_day/assets/product-countdown.js');
                echo shopFunctionsF::renderVmSubLayout('productdayProduct',array('product'=>$this->product)); 
                ?>
               
                <?php
                // TODO in Multi-Vendor not needed at the moment and just would lead to confusion
                /* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
                  $text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
                  echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
                 */
                ?>

					
				<div class="product-details-container-1">
					<?php
					if ( VmConfig::get ('display_stock', 1)){  ?> 
					<div class="product-stock">
						<?php echo shopFunctionsF::renderVmSubLayout('stockhandle',array('product'=>$this->product)); ?>    
					</div>   
					<?php } ?>	
					
					<?php        
					// Ask a question about this product
					if (VmConfig::get('ask_question', 0) == 1) {
						$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component', FALSE);
						?>
						<div class="ask-a-question">
							<a class="product-question btn btn-default btn-sm" href="<?php echo $askquestion_url ?>" rel="nofollow" ><i class="fa fa-question" aria-hidden="true"></i><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_ENQUIRY_LBL') ?></a>
						</div>
					<?php
					}
					?>
					
					<?php
					// Показ артикула
					$showArticle = true;
					if($showArticle){ ?>
						<div class="product-article">
							<?php echo JText::_('VM_PRODUCT_SKU').': <span>'.$this->product->product_sku.'</span>'; ?>
						</div>   
					<?php
					}
					?> 
					
					<?php
					// Manufacturer of the Product
					//if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
						//echo $this->loadTemplate('manufacturer');
					//}
					?> 
										
					<div class="manufacturer">					
						<?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_DETAILS_MANUFACTURER_LBL').': <span>'.$this->product->mf_name.'</span>'; ?>
					</div>
					
					
					<div class="product-details-price">
						
						<span><?php echo JText::_ ('VM_PRODUCT_PRICE').": "; ?></span>						
						
						<?php

						if (is_array($this->productDisplayShipments)) {
							foreach ($this->productDisplayShipments as $productDisplayShipment) {
							//echo $productDisplayShipment;
							}
						}
						if (is_array($this->productDisplayPayments)) {
							foreach ($this->productDisplayPayments as $productDisplayPayment) {
							//echo $productDisplayPayment;
							}
						}

						//In case you are not happy using everywhere the same price display fromat, just create your own layout
						//in override /html/fields and use as first parameter the name of your file
						echo shopFunctionsF::renderVmSubLayout('prices',array('product'=>$this->product,'currency'=>$this->currency));
						echo "<meta itemprop='price' content='".$this->product->prices['salesPrice']."'>";
						echo "<meta itemprop='priceCurrency' content='".$this->currency->_vendorCurrency_code_3."'>";
						?> <div class="clearfix"></div>	
					</div>
				</div>
				<div class="clear"></div>							

                <?php
                echo shopFunctionsF::renderVmSubLayout('addtocart',array('product'=>$this->product)); ?>
                
                <?php
                // Показ краткого описания
                $showDesc = false;
                if (!empty($this->product->product_s_desc) and $showDesc) {
                ?>
                    <div class="product-short-description">
                    <?php
                    /** @todo Test if content plugins modify the product description */
                    echo nl2br($this->product->product_s_desc);
                    ?>
                    </div>
                <?php
                } // Product Short Description END
                ?>	                 
                </div>
            </div>
            <div class="clearfix"></div>
        </div>		
    </div> 
	<?php /* <div class="color-line"></div> */ ?>
    <?php //конец блока с информацией о товаре ?>
    
    <?php //Подсчет количества отзывов о товаре ?>
    <?php
    $comments = JPATH_SITE . '/components/com_jcomments/jcomments.php';
    if (file_exists($comments)) {
    require_once($comments);
    $options = array();
    $options['object_id'] = $this->product->virtuemart_product_id;
    $options['object_group'] = 'com_virtuemart';
    $options['published'] = 1;
    $count = JCommentsModel::getCommentsCount($options);
    }
    ?>	
    
    <div class="product-desc-wrap">
        <?php //Nav tabs ?>
        <div class="nav-tabs-navigation">
            <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" role="tablist" id="product-tabs">
                    <li class="tab-home active">
						<a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE'); ?></a>
					</li>
					
                    <?php if (!empty($this->product->customfieldsSorted['specifications'])) { ?>
                    <li>
						<a href="#specifications" aria-controls="specifications" role="tab" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_TAB_SPECIFICATIONS'); ?></a>
					</li>
                    <?php } ?>
					
                    <?php if (!empty($this->product->customfieldsSorted['portfolio'])) { ?>
                    <li>
						<a href="#portfolio" aria-controls="portfolio" role="tab" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_TAB_PORTFOLIO'); ?></a>
					</li>
                    <?php } ?>					
					
                    <?php if (!empty($this->product->customfieldsSorted['video'])) { ?>
                    <li>
						<a href="#video" aria-controls="video" role="tab" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_TAB_VIDEO'); ?></a>
					</li>
                    <?php } ?>
					
                    <li class="tab-reviews">
						<a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab"><?php echo vmText::_('COM_VIRTUEMART_TAB_REVIEWS'); ?> <span>(<?php echo $count; ?>)</span></a>
					</li>
                </ul>
            </div>
        </div>
       
        <?php //Tab panels ?>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">	
                <?php
                // event onContentBeforeDisplay
                echo $this->product->event->beforeDisplayContent; ?>

                <?php
                // Product Description
                if (!empty($this->product->product_desc)) {
                    ?>
                    <div class="product-description" itemprop="description">
                    <?php echo $this->product->product_desc; ?>
                    </div>
                <?php
                } // Product Description END

                echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'normal'));

                // Product Packaging
                $product_packaging = '';
                if ($this->product->product_box) {
                ?>
                    <div class="product-box">
                    <?php
                        echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
                    ?>
                    </div>
                <?php } // Product Packaging END ?>	

                <?php echo $this->loadTemplate('reviews'); ?>				
				
			  	<?php
				// Навигация между товарами 
				if (VmConfig::get('product_navigation', 1)) {
				?>
					<div class="product-neighbours">
					<?php
					if (!empty($this->product->neighbours ['previous'][0])) {
					$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
					echo JHtml::_('link', $prev_link, '<i class="fa fa-arrow-left" aria-hidden="true"></i> '.$this->product->neighbours ['previous'][0]
						['product_name'], array('rel'=>'prev', 'class' => 'btn btn-default btn-sm btn-move-left pull-left','data-dynamic-update' => '0'));
					}
					if (!empty($this->product->neighbours ['next'][0])) {
					$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id, FALSE);
					echo JHtml::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'].' <i class="fa fa-arrow-right" aria-hidden="true"></i>', array('rel'=>'next','class' => 'btn btn-default btn-sm btn-move-right pull-right','data-dynamic-update' => '0'));
					}
					?>
					<div class="clearfix"></div>
					</div>
				<?php } // Product Navigation END
				?>				
		
                <?php // Back To Category Button
                    if ($this->product->virtuemart_category_id) {
                        $catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id);
                        $categoryName = $this->product->category_name ;
                        } else {
                        $catURL =  JRoute::_('index.php?option=com_virtuemart');
                        $categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
                    }
                ?>
                <div class="back-to-category">
                    <span><?php echo JText::sprintf('VM_CATEGORY_BACK_TO_CAT').':' ?></span> <a href="<?php echo $catURL ?>" class="" title="<?php echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO','«'.$categoryName.'»') ?>"><?php echo '«'.$categoryName.'»'?></a>                  
                </div>		
				<div class="clear"></div>
				<?php // Вернуться в категорию END ?> 						
				
            </div>

			<?php // -- Технические характеристики --  ?>
			<?php if (!empty($this->product->customfieldsSorted['specifications'])) { ?>
			<div role="tabpanel" class="tab-pane fade" id="specifications">	
				<div class="product_specifications">
				<?php 
					echo shopFunctionsF::renderVmSubLayout('customfields2',array('product'=>$this->product,'position'=>'specifications'));
				?>				
				</div> 
			</div>	
		   <?php }?>		
			
			<?php // -- Портфолио --  ?>
			<?php if (!empty($this->product->customfieldsSorted['portfolio'])) { ?>
			<div role="tabpanel" class="tab-pane fade" id="portfolio">	
				<div class="product_portfolio_wrap">					
				<?php 
					if( isset ($this->product->customfieldsSorted['portfolio'] [0]) ){
						foreach ( $this->product->customfieldsSorted['portfolio']  as  $k => $portfolio ){ 
							$portfolioId = $portfolio->customfield_value;
							?>		
							<div class="product_portfolio">	
								<?php echo JHtml::_('content.prepare', '{gallery}'.$portfolioId.'{/gallery}');?>
							</div> 
							<?php
						}
					}
				  ?> 								
				</div> 
			</div>	
		   <?php }?>
			
			
			<?php // -- Видео --  ?>
			<?php if (!empty($this->product->customfieldsSorted['video'])) { ?>
			<div role="tabpanel" class="tab-pane fade" id="video">	
			<div class="product_video">
			<?php 
				if( isset ($this->product->customfieldsSorted['video'] [0]) ){
					foreach ( $this->product->customfieldsSorted['video']  as  $k => $video ){ 
						$vidId = str_replace('https://youtu.be/', "", $video->customfield_value);
						?>
						<iframe width="800" height="450" src="https://www.youtube.com/embed/<?=$vidId?>" frameborder="0" allowfullscreen></iframe>
						<?php
					}//foreach	
				} // end if
			  ?>   

			</div> 
			</div>	
		   <?php }?>
			
            
            <div role="tabpanel" class="tab-pane fade" id="reviews">
                <?php // onContentAfterDisplay event
                echo $this->product->event->afterDisplayContent; 

                $comments = JPATH_ROOT . '/components/com_jcomments/jcomments.php';
                if (file_exists($comments)) {
                    require_once($comments);
                    echo JComments::showComments($this->product->virtuemart_product_id, 'com_virtuemart', $this->product->product_name);
                }
                ?>
            </div>
        </div>

        <?php 
        echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'onbot'));
        ?>
    </div> 
    <?php // конец блока с описанием товара ?>
	
	<?php // Похожие товары
		jimport( 'joomla.application.module.helper' ); 
		$modules = JModuleHelper::getModules( 'related-prod');  
		$attribs['style'] = 'xhtml'; 
		foreach($modules as $module){ 
		echo JModuleHelper::renderModule($module, $attribs); 
		} 
	?>	
    <div class="clear"></div>
   
    <?php
    if (!empty($this->product->customfieldsSorted['related_products'])) {
        echo '<h3 class="related-products-title">'.JTEXT::_('COM_VIRTUEMART_RELATED_PRODUCTS').'</h3>';
        echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));
    }

    if (!empty($this->product->customfieldsSorted['related_categories'])) {
        echo '<h3 class="related-categories-title">'.JTEXT::_('COM_VIRTUEMART_RELATED_CATEGORIES').'</h3>';
        echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_categories','class'=> 'product-related-categories'));
    }
    ?>
    
<?php // onContentAfterDisplay event
echo $this->product->event->afterDisplayContent;

// Show child categories
if ($this->cat_productdetails)  {
	echo $this->loadTemplate('showcategory');
}

$j = 'jQuery(document).ready(function($) {
	$("form.js-recalculate").each(function(){
		if ($(this).find(".product-fields").length && !$(this).find(".no-vm-bind").length) {
			var id= $(this).find(\'input[name="virtuemart_product_id[]"]\').val();
			Virtuemart.setproducttype($(this),id);

		}
	});
});';
//vmJsApi::addJScript('recalcReady',$j);

if(VmConfig::get ('jdynupdate', TRUE)){

	/** GALT
	 * Notice for Template Developers!
	 * Templates must set a Virtuemart.container variable as it takes part in
	 * dynamic content update.
	 * This variable points to a topmost element that holds other content.
	 */
	$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';
//Virtuemart.recalculate = true;	//Activate this line to recalculate your product after ajax
";
    
	vmJsApi::addJScript('ajaxContent',$j);

	$j = "jQuery(document).ready(function($) {
	Virtuemart.stopVmLoading();
	var msg = '';
	$('a[data-dynamic-update=\"1\"]').off('click', Virtuemart.startVmLoading).on('click', {msg:msg}, Virtuemart.startVmLoading);
	$('[data-dynamic-update=\"1\"]').off('change', Virtuemart.startVmLoading).on('change', {msg:msg}, Virtuemart.startVmLoading);  
});";

	vmJsApi::addJScript('vmPreloader',$j);
}

echo vmJsApi::writeJS();

if ($this->product->prices['salesPrice'] > 0) {
  echo shopFunctionsF::renderVmSubLayout('snippets',array('product'=>$this->product, 'currency'=>$this->currency, 'showRating'=>$this->showRating));
}

?>
</div>
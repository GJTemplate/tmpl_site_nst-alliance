<?php
defined('_JEXEC') or die('Restricted access');
$product = $viewData['product'];

$plugin = JPluginHelper::getPlugin('system', 'vmlabel');
$params = new JRegistry($plugin->params);
$new = $params->get('new');
$day = $params->get('day');
$date = $params->get('date');
$today = date("Y-m-d");
$create = new DateTime($product->created_on);
$modified = new DateTime($product->modified_on);
$newType = $params->get('new-type');
$newImg = $params->get('new-img');
$sale = $params->get('sale');
$saleType = $params->get('sale-type');
$saleImg = $params->get('sale-img');
$special = $params->get('special');
$specialType = $params->get('special-type');
$specialImg = $params->get('special-img');

$productId1 = $params->get('productId1');
$productIdType1 = $params->get('productId-type1');
$productIdImg1 = $params->get('productId-img1');

$productId2 = $params->get('productId2');
$productIdType2 = $params->get('productId-type2');
$productIdImg2 = $params->get('productId-img2');

$productId3 = $params->get('productId3');
$productIdType3 = $params->get('productId-type3');
$productIdImg3 = $params->get('productId-img3');

$categoryId = $params->get('categoryId');
$categoryIdType = $params->get('categoryId-type');
$categoryIdImg = $params->get('categoryId-img');
?>
<div class="vmlabel-wrap">
    <?php
    // новинка
    if($new){
        if($date == 1){
            $create->modify("+$day day");
            if(strtotime($create->format('Y-m-d')) > strtotime($today)){
                 if($newType == 2){ ?>
                    <img class="vmlabel-img vmlabel-img-new" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$newImg; ?>">
                <?php
                } else{ ?>
                    <span class="vmlabel vmlabel-new"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_NEW'); ?></span>
                <?php
                } 
            }
        } else {
            $modified->modify("+$day day");
            if(strtotime($modified->format('Y-m-d')) > strtotime($today)){
                 if($newType == 2){ ?>
                    <img class="vmlabel-img vmlabel-img-new" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$newImg; ?>">
                <?php
                } else{ ?>
                    <span class="vmlabel vmlabel-new"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_NEW'); ?></span>
                <?php
                } 
            }
        }
    }

    // скидка
    if($sale && $product->prices['salesPrice'] && ($product->prices['basePrice'] !== $product->prices['salesPrice'])) {
        if($saleType == 2){ ?>
            <img class="vmlabel-img vmlabel-img-sale" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$saleImg; ?>">
        <?php
        } else{ ?>
    <span class="vmlabel vmlabel-sale">% <span><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_SALE'); ?></span></span>
        <?php
        } 
    }

    // рекомендуемый товар
    if($special && $product->product_special){
        if($specialType == 2){ ?>
            <img class="vmlabel-img vmlabel-img-special" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$specialImg; ?>">
        <?php
        } else{ ?>
    <span class="vmlabel vmlabel-special"><i class="fa fa-thumbs-up" aria-hidden="true"></i> <span><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_SPECIAL'); ?></span></span>
        <?php
        } 
    }
    
    // выделенные товары 1
    if(!empty($productId1)){
        $productId1 = explode(',', $productId1);
        if(in_array($product->virtuemart_product_id, $productId1)) {
            if($productIdType1 == 2){ ?>
                <img class="vmlabel-img vmlabel-img-product" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$productIdImg1; ?>">
            <?php
            } else{ ?>
                <span class="vmlabel vmlabel-product group1"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_PRODUCT1'); ?></span>
            <?php
            }    
        }
    }
    
    // выделенные товары 2
    if(!empty($productId2)){
        $productId2 = explode(',', $productId2);
        if(in_array($product->virtuemart_product_id, $productId2)) {
            if($productIdType2 == 2){ ?>
                <img class="vmlabel-img vmlabel-img-product" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$productIdImg2; ?>">
            <?php
            } else{ ?>
                <span class="vmlabel vmlabel-product group2"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_PRODUCT2'); ?></span>
            <?php
            }    
        }
    }
    
    // выделенные товары 3
    if(!empty($productId3)){
        $productId3 = explode(',', $productId3);
        if(in_array($product->virtuemart_product_id, $productId3)) {
            if($productIdType3 == 2){ ?>
                <img class="vmlabel-img vmlabel-img-product" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$productIdImg3; ?>">
            <?php
            } else{ ?>
                <span class="vmlabel vmlabel-product group3"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_PRODUCT3'); ?></span>
            <?php
            }    
        }
    }
    
    // выделенные категории
    if(!empty($categoryId)){
        $categoryId = explode(',', $categoryId);
        if(in_array($product->virtuemart_category_id, $categoryId)) {
            if($categoryIdType == 2){ ?>
                <img class="vmlabel-img vmlabel-img-category" src="<?php echo JURI::base().'plugins/system/vmlabel/img/'.$categoryIdImg; ?>">
            <?php
            } else{ ?>
                <span class="vmlabel vmlabel-category"><?php echo JText::sprintf('PLG_VM_SYSTEM_VMLABEL_LABEL_CATEGORY'); ?></span>
            <?php
            }    
        }
    }
    ?>
</div>
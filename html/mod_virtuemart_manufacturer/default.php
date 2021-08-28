<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$col= 1 ;

if ($display_style =="div") {
    switch($manufacturers_per_row){
        case 1:
            $manufacturer_cellwidth = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
            break;
        case 2:
            $manufacturer_cellwidth = 'col-lg-6 col-md-6 col-sm-6 col-xs-12';
            break;
        case 3:
            $manufacturer_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
            break;
        case 4:
            $manufacturer_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
            break;
        case 5:
            $manufacturer_cellwidth = 'col-lg-3 col-md-4 col-sm-6 col-xs-12';
            break;
        case 6:
            $manufacturer_cellwidth = 'col-lg-2 col-md-3 col-sm-4 col-xs-12';
            break;
        default:
            $manufacturer_cellwidth = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
    }
} else {
    $manufacturer_cellwidth = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
}
?>
<div class="category-view">   
    <div class="row vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?> manufacturer-module">

    <?php if ($headerText) : ?>
        <div class="vmheader"><?php echo $headerText ?></div>
    <?php endif;
     ?>
        
        <?php foreach ($manufacturers as $manufacturer): ?>
            <div class="category <?php echo $manufacturer_cellwidth ?>">
                <div class="spacer panel panel-default">
                    <?php
                    $link = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);

                    ?>
                    <?php
                    if ($manufacturer->images && ($show == 'image' or $show == 'all' )) { ?>
                       <div class="category-image">
                           <a href="<?php echo $link; ?>">
                           <?php echo $manufacturer->images[0]->displayMediaThumb('',false);?>
                           </a>
                        </div>
                    <?php
                    }
                    if ($show == 'text' or $show == 'all' ) { ?>
                    <div class="category-name">
                        <a href="<?php echo $link; ?>">
                        <?php echo $manufacturer->mf_name; ?>
                        </a>
                    </div>
                    <?php
                    } ?>
                    <?php
                    if ($col == $manufacturers_per_row) {
                        echo "</div><div style='clear:both;'>";
                        $col= 1 ;
                    } else {
                        $col++;
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php
        if ($footerText) : ?>
        <div class="vmfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
             <?php echo $footerText ?>
        </div>
    <?php endif; ?>
    </div>
</div>

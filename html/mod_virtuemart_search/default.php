<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<!--BEGIN Search Box -->
<form action="<?php echo JRoute::_('index.php?option=com_virtuemart&view=category&search=true&limitstart=0&virtuemart_category_id='.$category_id ); ?>" method="get" class="form-inline">
<div class="vm-search <?php echo $params->get('moduleclass_sfx'); ?> ">
<div class="form-group">
<?php $output = '<input name="keyword" id="mod_virtuemart_search" maxlength="'.$maxlength.'" alt="'.$button_text.'" class="inputbox'.$moduleclass_sfx.' form-control" type="text" size="'.$width.'" placeholder="'.$text.'"  />';
 $image = JURI::base() . $imagepath;

			if ($button) :
			    if ($imagebutton && $imagepath) :
			        $button = '<input style="vertical-align:middle" type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$image.'" onclick="this.form.keyword.focus();"/>';
			    else :
			        $button = '<input type="submit" value="'.$button_text.'" class="btn btn-default'.$moduleclass_sfx.'" onclick="this.form.keyword.focus();"/>';
			    endif;
		

			switch ($button_pos) :
			    case 'top' :
				    $button = $button.'<br />';
				    //$output = $button.$output;
				    break;

			    case 'bottom' :
				    $button = '<br />'.$button;
				    //$output = $output.$button;
				    break;

			    case 'right' :
				    //$output = $output.$button;
				    break;

			    case 'left' :
			    default :
				    //$output = $button.$output;
				    break;
			endswitch;
			endif;
			
			//echo $output;
            echo $output.'<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>';
?>
</div>
</div>
		<input type="hidden" name="limitstart" value="0" />
		<input type="hidden" name="option" value="com_virtuemart" />
		<input type="hidden" name="view" value="category" />
		<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
<?php if(!empty($set_Itemid)){
	echo '<input type="hidden" name="Itemid" value="'.$set_Itemid.'" />';
} ?>

	  </form>

<!-- End Search Box -->
<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
?>

<div class="top-search-wrapper">
    <div class="icon-top-wrapper">
        <i class="fa fa-search search-open-icon" aria-hidden="true"></i>
        <i class="fa fa-times search-close-icon" aria-hidden="true"></i>
    </div>
</div> <!-- /.top-search-wrapper -->
<div class="top-search-input-wrap">
    <div class="search-wrap search-upper-part">
        <form action="<?php echo JRoute::_('index.php'); ?>" method="post">
            <div class="search <?php echo $moduleclass_sfx ?>">
				<?php $output = 
						'<div class="sp_search_input">'
                        . '<input name="keyword" id="mod_virtuemart_search" maxlength="'.$maxlength.'" alt="'.$button_text.'" class="inputbox'.$moduleclass_sfx.' form-control" type="text" size="'.$width.'" placeholder="'.$text.'"  />'
	                    . '<span class="search-info-text">Нажмите Enter, для поиска или ESC, чтобы закрыть </span>'
                        . '</div>';
				 
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

				    echo $output;
				?>
				

				<input type="hidden" name="limitstart" value="0" />
				<input type="hidden" name="option" value="com_virtuemart" />
				<input type="hidden" name="view" value="category" />
				<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
				
            </div>
        </form>
    </div>
    <div class="search-bottom-part">		
		<div class="container">	
            <div class="row">
                <!--div class="col-sm-6 col-xs-12">
                    <?php
                    //jimport('joomla.application.module.helper');
                    //$modules = JModuleHelper::getModules('search-bottom-1');
                    //$attribs['style'] = 'sp_xhtml';

                    //foreach ($modules as $key => $module) {
                        //echo JModuleHelper::renderModule($module, $attribs);
                    //}
                    ?>
                </div-->
                <div class="col-sm-12 col-xs-12">
                    <?php
                    jimport('joomla.application.module.helper');
                    $modules = JModuleHelper::getModules('search-bottom-2');
                    $attribs['style'] = 'sp_xhtml';

                    foreach ($modules as $key => $module) {
                        echo JModuleHelper::renderModule($module, $attribs);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- /.top-search-input-wrap -->

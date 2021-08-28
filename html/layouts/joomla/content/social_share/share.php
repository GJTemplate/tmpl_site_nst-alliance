<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$url  	=  JRoute::_(ContentHelperRoute::getArticleRoute($displayData->id . ':' . $displayData->alias, $displayData->catid, $displayData->language));
$root 	= JURI::base();
$root 	= new JURI($root);
$url  	= $root->getScheme() . '://' . $root->getHost() . $url;

$params 	= JFactory::getApplication()->getTemplate(true)->params;

if( $params->get('social_share') ) { ?>
	<div class="helix-social-share">
		<div class="helix-social-share-icon">		
			<ul>				
				<li>
					<div class="facebook" data-toggle="tooltip" data-placement="top" title="<?php echo JText::_('HELIX_SHARE_FACEBOOK'); ?>">

						<a class="facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $url; ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>">

							<i class="fa fa-facebook-blog"></i>
							<span class="text"><?php echo JText::_('HELIX_SOCIAL_NAME_FACEBOOK'); ?></span>
						</a>

					</div>
				</li>
			</ul>
		</div>		
	</div> <!-- /.helix-social-share -->
<?php } ?>















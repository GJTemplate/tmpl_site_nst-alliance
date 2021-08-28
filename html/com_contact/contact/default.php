<?php
/*
 * ------------------------------------------------------------------------
 * JA Rent template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2018 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
*/

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams('com_media');
$tparams = $this->params;
jimport('joomla.html.html.bootstrap');
?>

<div class="contact <?php echo $this->pageclass_sfx?>" itemscope itemtype="http://schema.org/Person">	
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php if($this->params->get('presentation_style') == 'plain') :?>
		
	<div class="plain-style">
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
			<h2>
				<?php if ($this->item->published == 0) : ?>
					<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
				<?php endif; ?>
				<?php echo $this->contact->name; ?>
			</h2>
		</div>

	
		<div class="address-contact container">
			<div class="address-top">				
			<?php 
				$modules = JModuleHelper::getModules( 'cont-1' );
					if(count($modules)!=0){?>
					<div class="cont-1">
					<?php  foreach ( $modules as $module ) {
						echo JModuleHelper::renderModule( $module );
						} //  end foreach
					?>
					</div>
				<?php						
				} 
			?>
			</div>
		</div>
	
		<div class="detail-contact">
			<div class="container">
				<div class="row">
					<!-- Show form contact -->
					<div class="col-sm-12 contact-bottom">
						<div class="form-title">
							<span><?php echo JText::_('COM_CONTACT_EMAIL_FORM');  ?></span>
							<h3><?php echo JText::_('COM_CONTACT_ASK') ;?></h3>
						</div>
						<?php 
							$modules = JModuleHelper::getModules( 'cont-form' );
								if(count($modules)!=0){?>
								<div class="cont-form">
								<?php  foreach ( $modules as $module ) {
									echo JModuleHelper::renderModule( $module );
									} //  end foreach
								?>
								</div>
							<?php						
							} 
						?>
						<?php  //echo $this->loadTemplate('form');  ?>
					</div>
					<!-- End Show form contact -->	
				</div>
			</div>
		</div>

		<!-- End Show -->
	</div>
	<?php endif;?>
	<!-- End Override -->
</div>

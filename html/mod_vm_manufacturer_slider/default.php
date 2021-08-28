<?php // no direct access
defined('_JEXEC') or die('Restricted access');

?>


<?php if ($headerText) : ?>
	<div class="vmheader"><?php echo $headerText ?></div>
<?php endif;
?>
	<div class="manufacturer-slider<?php echo $params->get('moduleclass_sfx'); ?> ">
	<?php foreach ($manufacturers as $manufacturer) {
		$link = JROUTE::_('index.php?option=com_virtuemart&view=manufacturer&virtuemart_manufacturer_id=' . $manufacturer->virtuemart_manufacturer_id);

		?>
		<div class="manufacturer-block">
		<a href="<?php echo $link; ?>">
		<div class="manufacturer-image">	
		<?php
		if ($manufacturer->images && ($show == 'image' or $show == 'all' )) { ?>
			<?php echo $manufacturer->images[0]->displayMediaThumb('',false);?>
		<?php
		} ?>
		</div>
		<?php
		if ($show == 'all' ) { ?>
		 <span class="manufacturer-name"><?php echo $manufacturer->mf_name; ?></span>
		<?php
		} ?>
			</a>
		</div>
		<?php
	} ?>
	</div>
	<br style='clear:both;' />
<?php
	if ($footerText) : ?>
	<div class="vmfooter<?php echo $params->get( 'moduleclass_sfx' ) ?>">
		 <?php echo $footerText ?>
	</div>
<?php endif; ?>

<script>    
jQuery('.manufacturer-slider').owlCarousel({
    loop: <?php echo $sloop ?>,
    margin: 30,
    autoplayHoverPause: true,
    nav: <?php echo $snav ?>,
    //navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    dots: <?php echo $sdots ?>,
    navText: ['', ''],
    autoplay: <?php echo $sautoplay ?>,
    autoplayTimeout: <?php echo $autoplayTimeout ?>,
    responsive:{ 
        0: {items: <?php echo $extrasmall ?>}, 
        768: {items: <?php echo $small ?>}, 
        992: {items: <?php echo $medium ?>}, 
        1200: {items: <?php echo $large ?>} }
}); 
</script>
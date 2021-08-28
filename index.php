<?php
/**
 * @package Helix3 Framework
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$menu = $app->getMenu()->getActive();



JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework'); //Force load Bootstrap
unset($doc->_scripts[$this->baseurl . '/media/jui/js/bootstrap.min.js']); // Remove joomla core bootstrap
//Load Helix
$helix3_path = JPATH_PLUGINS . '/system/helix3/core/helix3.php';

if (file_exists($helix3_path)) {
    require_once($helix3_path);
    $this->helix3 = helix3::getInstance();
} else {
    die('Please install and activate helix plugin');
}

//Coming Soon
if ($this->helix3->getParam('comingsoon_mode'))
    header("Location: " . $this->baseUrl . "?tmpl=comingsoon");

//Class Classes
$body_classes = '';
if ($this->helix3->getParam('sticky_header')) {
    $body_classes .= ' sticky-header';
}

$body_classes .= ($this->helix3->getParam('boxed_layout', 0)) ? ' layout-boxed' : ' layout-fluid';

$body_classes .= ' ' . $this->helix3->Preset();

if (isset($menu) && $menu) {
  if ($menu->params->get('pageclass_sfx')) {
    $body_classes .= ' ' . $menu->params->get('pageclass_sfx');
  }
}

//Body Background Image
if ($bg_image = $this->helix3->getParam('body_bg_image')) {

    $body_style = 'background-image: url(' . JURI::base(true) . '/' . $bg_image . ');';
    $body_style .= 'background-repeat: ' . $this->helix3->getParam('body_bg_repeat') . ';';
    $body_style .= 'background-size: ' . $this->helix3->getParam('body_bg_size') . ';';
    $body_style .= 'background-attachment: ' . $this->helix3->getParam('body_bg_attachment') . ';';
    $body_style .= 'background-position: ' . $this->helix3->getParam('body_bg_position') . ';'; 
    $body_style = 'body.site {' . $body_style . '}';

    $doc->addStyledeclaration($body_style); 
}

//Body Font
$webfonts = array();

if ($this->params->get('enable_body_font')) { 
    $webfonts['body'] = $this->params->get('body_font');
}

//Heading1 Font
if ($this->params->get('enable_h1_font')) {
    $webfonts['h1'] = $this->params->get('h1_font');
}

//Heading2 Font
if ($this->params->get('enable_h2_font')) {
    $webfonts['h2'] = $this->params->get('h2_font');
}

//Heading3 Font
if ($this->params->get('enable_h3_font')) {
    $webfonts['h3'] = $this->params->get('h3_font');
}

//Heading4 Font
if ($this->params->get('enable_h4_font')) {
    $webfonts['h4'] = $this->params->get('h4_font');
}

//Heading5 Font
if ($this->params->get('enable_h5_font')) {
    $webfonts['h5'] = $this->params->get('h5_font');
}

//Heading6 Font
if ($this->params->get('enable_h6_font')) {
    $webfonts['h6'] = $this->params->get('h6_font');
}

//Navigation Font
if ($this->params->get('enable_navigation_font')) {
    $webfonts['.sp-megamenu-parent'] = $this->params->get('navigation_font');
}

//Custom Font
if ($this->params->get('enable_custom_font') && $this->params->get('custom_font_selectors')) {
    $webfonts[$this->params->get('custom_font_selectors')] = $this->params->get('custom_font');
}

$this->helix3->addGoogleFont($webfonts);

//Custom CSS
if ($custom_css = $this->helix3->getParam('custom_css')) {
    $doc->addStyledeclaration($custom_css);
}

//Custom JS
if ($custom_js = $this->helix3->getParam('custom_js')) {
    $doc->addScriptdeclaration($custom_js);
}

//preloader & goto top
$doc->addScriptdeclaration("\nvar sp_preloader = '" . $this->params->get('preloader') . "';\n");
$doc->addScriptdeclaration("\nvar sp_gotop = '" . $this->params->get('goto_top') . "';\n");
$doc->addScriptdeclaration("\nvar sp_offanimation = '" . $this->params->get('offcanvas_animation') . "';\n");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <?php /*
                if ($favicon = $this->helix3->getParam('favicon')) {
                    $doc->addFavicon(JURI::base(true) . '/' . $favicon);
                } else {
                    $doc->addFavicon($this->helix3->getTemplateUri() . '/images/favicon.ico');
                }*/
                ?>
		
		<?php /*
		<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon" />		

		<link rel="manifest" href="templates/<?php echo $this->template ?>/images/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/templates/<?php echo $this->template ?>/images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">		
		
		<link rel="apple-touch-icon" sizes="57x57" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/templates/<?php echo $this->template ?>/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/templates/<?php echo $this->template ?>/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="144x144"  href="/templates/<?php echo $this->template ?>/images/favicon/android-icon-144x144.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/templates/<?php echo $this->template ?>/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/templates/<?php echo $this->template ?>/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/templates/<?php echo $this->template ?>/images/favicon/favicon-16x16.png">		
		*/
		?>
		
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		
		
		<?php //* -- head -- *// ?>
        <jdoc:include type="head" />
        <?php
        $megabgcolor = ($this->helix3->PresetParam('_megabg')) ? $this->helix3->PresetParam('_megabg') : '#ffffff';
        $megabgtx = ($this->helix3->PresetParam('_megatx')) ? $this->helix3->PresetParam('_megatx') : '#333333';

        $preloader_bg = ($this->helix3->getParam('preloader_bg')) ? $this->helix3->getParam('preloader_bg') : '#f5f5f5';
        $preloader_tx = ($this->helix3->getParam('preloader_tx')) ? $this->helix3->getParam('preloader_tx') : '#f5f5f5';

        // load css, less and js
        $this->helix3->addCSS('bootstrap.min.css, font-awesome.min.css, rhino-icon.css, custom.css') // CSS Files
        ->addJS('bootstrap.min.js, jquery.sticky.js, main.js') // JS Files
        ->lessInit()->setLessVariables(array(
        	'preset' => $this->helix3->Preset(),
            'bg_color' => $this->helix3->PresetParam('_bg'),
            'text_color' => $this->helix3->PresetParam('_text'),
            'major_color' => $this->helix3->PresetParam('_major'),
            'major2_color' => $this->helix3->PresetParam('_major2'),
            'major3_color' => $this->helix3->PresetParam('_major3'),
            'major4_color' => $this->helix3->PresetParam('_major4'),
            'major5_color' => $this->helix3->PresetParam('_major5'),
            'megabg_color' => $megabgcolor,
            'megatx_color' => $megabgtx,
            'preloader_bg' => $preloader_bg,
            'preloader_tx' => $preloader_tx,
        ))
        ->addLess('legacy/bootstrap', 'legacy')
        ->addLess('master', 'template');

        //RTL
        if ($this->direction == 'rtl') {
        $this->helix3->addCSS('bootstrap-rtl.min.css')
        ->addLess('rtl', 'rtl');
        }

        $this->helix3->addLess('presets', 'presets/' . $this->helix3->Preset(), array('class' => 'preset'));

        //Before Head
        if ($before_head = $this->helix3->getParam('before_head')) {
        	echo $before_head . "\n";
        } 
        ?>
                
        <!--script type="text/javascript">
        VK.init({apiId: 5451893, onlyWidgets: true});
        </script--> 
		
        <?php /* -- Комментарии FB -- 
        <meta property="fb:admins" content="100002135514048"/>		
		<meta property="fb:app_id" content="497542600894561"/>   
		*/ ?> 
		
	</head>
	<body class="<?php echo $this->helix3->bodyClass($body_classes); ?> off-canvas-menu-init">		
		
		<?php /*
		<div id="fb-root"></div>
		<script async defer crossorigin="" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&autoLogAppEvents=1&version=v5.0&appId=497542600894561"></script>
		*/?>
		<?php /* -- Комментарии FB -- */ ?> 					
		<?php  /* проверка com_k2 */
		/*
			$option = JRequest::getVar('option', null);  
		?>						
				<?php if ( $option == 'com_k2' ) : ?>
								<script>
								  window.fbAsyncInit = function() {
									FB.init({
									  appId      : '497542600894561',
									  xfbml      : true,
									  version    : 'v3.2'
									});
								  };

								  (function(d, s, id){
									 var js, fjs = d.getElementsByTagName(s)[0];
									 if (d.getElementById(id)) {return;}
									 js = d.createElement(s); js.id = id;
									 js.src = "//connect.facebook.net/ru_RU/sdk.js";
									 fjs.parentNode.insertBefore(js, fjs);
								   }(document, 'script', 'facebook-jssdk'));
								</script>
		<?php endif; ?>
		<?php /* -- END Комментарии FB -- */ ?> 					
					
		<div class="body-wrapper">
			<div class="body-innerwrapper">
				<?php $this->helix3->generatelayout(); ?>
			</div> <!-- /.body-innerwrapper -->
		</div> <!-- /.body-innerwrapper -->

		<!-- Off Canvas Menu -->
		<div class="offcanvas-menu">
			<a href="#" class="close-offcanvas"><i class="fa fa-remove"></i></a>
			<div class="offcanvas-inner">
			<?php if ($this->helix3->countModules('offcanvas')) { ?>
            	<jdoc:include type="modules" name="offcanvas" style="sp_xhtml" />
                <?php } else { ?>
                <p class="alert alert-warning"><?php echo JText::_('HELIX_NO_MODULE_OFFCANVAS'); ?></p>
            <?php } ?>
			</div> <!-- /.offcanvas-inner -->
		</div> <!-- /.offcanvas-menu -->

		<?php
			if ($this->params->get('compress_css')) {
            	$this->helix3->compressCSS();
			}

            $tempOption    = $app->input->get('option');
           	// $tempView       = $app->input->get('view');

				if ( $this->params->get('compress_js') && $tempOption != 'com_config' ) {
                	$this->helix3->compressJS($this->params->get('exclude_js'));
				}

               	//before body
                if ($before_body = $this->helix3->getParam('before_body')) {
                	echo $before_body . "\n";
				} ?>

				<jdoc:include type="modules" name="debug" />
				<!-- Preloader -->
				<jdoc:include type="modules" name="helixpreloader" />
				<!-- Go to top -->
				<?php if ($this->params->get('goto_top')) { ?>
                <a href="javascript:void(0)" class="scrollup">&nbsp;</a>
		<?php } ?>
					
		<script>
			jQuery(document).ready(function(){ 				
				jQuery("ul.sf-menu").superfish({ 
					delay:300,
					animation:{opacity:'show'/*,height:'show',width:'show'*/},
					speed:'fast',
					autoArrows:true,
					dropShadows:false 
				});
			}); 			
		</script>
		<script src="/templates/<?php echo $this->template ?>/js/superfish.js" type="text/javascript"></script>					
		<script src="/templates/<?php echo $this->template ?>/js/custom.js" type="text/javascript"></script>
		<script src="/templates/<?php echo $this->template ?>/js/trendshop.js" type="text/javascript"></script>	
		<script src="/templates/<?php echo $this->template ?>/buyme/js/buyme.js" type="text/javascript"></script>	
		
		
</body>
</html>
<?php

/**
 * @package SP PageBuilder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2017 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('resticted aceess');

class SppagebuilderAddonSlideshow_full extends SppagebuilderAddons {

    public function render() {
        $class = (isset($this->addon->settings->class) && $this->addon->settings->class) ? $this->addon->settings->class : '';
        $autoplay = (isset($this->addon->settings->autoplay) && $this->addon->settings->autoplay) ? $this->addon->settings->autoplay : '';
        $controllers = (isset($this->addon->settings->controllers) && $this->addon->settings->controllers) ? $this->addon->settings->controllers : '';
        $arrows = (isset($this->addon->settings->arrows) && $this->addon->settings->arrows) ? $this->addon->settings->arrows : '';
        $variation = (isset($this->addon->settings->variation) && $this->addon->settings->variation) ? $this->addon->settings->variation : 'simple';
        $color = (isset($this->addon->settings->color) && $this->addon->settings->color) ? $this->addon->settings->color : '';
        $background = (isset($this->addon->settings->background) && $this->addon->settings->background) ? $this->addon->settings->background : '';
        $main_bg = (isset($this->addon->settings->main_bg) && $this->addon->settings->main_bg) ? $this->addon->settings->main_bg : '';
        $slide_items = (is_array($this->addon->settings->sp_slideshow_full_item) && $this->addon->settings->sp_slideshow_full_item) ? $this->addon->settings->sp_slideshow_full_item : array();

        $title_animation = (isset($this->addon->settings->title_animation) && $this->addon->settings->title_animation) ? $this->addon->settings->title_animation : '';
        $cotent_animation = (isset($this->addon->settings->cotent_animation) && $this->addon->settings->cotent_animation) ? $this->addon->settings->cotent_animation : '';
        $image_animation = (isset($this->addon->settings->image_animation) && $this->addon->settings->image_animation) ? $this->addon->settings->image_animation : '';
        $button_animation = (isset($this->addon->settings->button_animation) && $this->addon->settings->button_animation) ? $this->addon->settings->button_animation : '';


        //output start
        $output = '';
        //Check Auto Play
        $slide_autoplay = ($autoplay) ? 'data-sppb-slide-ride="true"' : '';
        $slide_controllers = ($controllers) ? 'data-sppb-slidefull-controllers="true"' : '';
        $main_bg = ($main_bg) ? 'style="background-image: url(' . JURI::base() . $main_bg . ');"' : '';

        $output .= '<div class="sppb-addon sppb-slider-wrapper sppb-slider-fullwidth-wrapper owl-theme' . $class . ' varition-' . $variation . '" ' . $main_bg . '>';
        $output .= '<div class="sppb-slider-item-wrapper">';
        $output .= '<div id="slide-fullwidth" class="owl-carousel" ' . $slide_controllers . ' ' . $slide_autoplay . ' >';

        foreach ($slide_items as $slide_item) {
            // if have bg
            $bg_image = ($slide_item->bg && $variation != 'animation') ? 'style="background-image: url(' . JURI::base() . $slide_item->bg . ');"' : '';
            $column_size = ($variation != 'simple') ? 'col-sm-6' : 'col-sm-12';
            $target = (isset($target) && $target) ? $target : '_self';


            // *** animation *** //
            // Title animation
            if (isset($slide_item->title_animation) && $slide_item->title_animation) {
                $title_animation = ' sppb-wow ' . $slide_item->title_animation;
            }

            $title_data_attr = '';
            if (isset($slide_item->title_animationduration) && $slide_item->title_animationduration)
                $title_data_attr .= ' data-sppb-wow-duration="' . $slide_item->title_animationduration . 'ms"';
            if (isset($slide_item->title_animationdelay) && $slide_item->title_animationdelay)
                $title_data_attr .= ' data-sppb-wow-delay="' . $slide_item->title_animationdelay . 'ms"';

            // sub title animation
            if (isset($slide_item->subtitle_animation) && $slide_item->subtitle_animation) {
                $subtitle_animation = ' sppb-wow ' . $slide_item->subtitle_animation;
            }

            $subtitle_data_attr = '';
            if (isset($slide_item->subtitle_animationduration) && $slide_item->subtitle_animationduration)
                $subtitle_data_attr .= ' data-sppb-wow-duration="' . $slide_item->subtitle_animationduration . 'ms"';
            if (isset($slide_item->subtitle_animationdelay) && $slide_item->subtitle_animationdelay)
                $subtitle_data_attr .= ' data-sppb-wow-delay="' . $slide_item->subtitle_animationdelay . 'ms"';


            // image animation
            if (isset($slide_item->image_animation) && $slide_item->image_animation) {
                $image_animation = ' sppb-wow ' . $slide_item->image_animation;
            }

            $image_data_attr = '';
            if (isset($slide_item->image_animationduration) && $slide_item->image_animationduration)
                $image_data_attr .= ' data-sppb-wow-duration="' . $slide_item->image_animationduration . 'ms"';
            if (isset($slide_item->cotent_animationdelay) && $slide_item->cotent_animationdelay)
                $image_data_attr .= ' data-sppb-wow-delay="' . $slide_item->cotent_animationdelay . 'ms"';


            // content animation
            if (isset($slide_item->cotent_animation) && $slide_item->cotent_animation) {
                $cotent_animation = ' sppb-wow ' . $slide_item->cotent_animation;
            }

            $content_data_attr = '';
            if (isset($slide_item->cotent_animationduration) && $slide_item->cotent_animationduration)
                $content_data_attr .= ' data-sppb-wow-duration="' . $slide_item->cotent_animationduration . 'ms"';
            if (isset($slide_item->cotent_animationdelay) && $slide_item->cotent_animationdelay)
                $content_data_attr .= ' data-sppb-wow-delay="' . $slide_item->cotent_animationdelay . 'ms"';

            // Button animation
            if (isset($slide_item->button_animation) && $slide_item->button_animation) {
                $button_animation = ' sppb-wow ' . $slide_item->button_animation;
            }

            $button_data_attr = '';
            if (isset($slide_item->button_animationduration) && $slide_item->button_animationduration)
                $button_data_attr .= ' data-sppb-wow-duration="' . $slide_item->button_animationduration . 'ms" ';
            if (isset($slide_item->button_animationdelay) && $slide_item->button_animationdelay)
                $button_data_attr = ' data-sppb-wow-delay="' . $slide_item->button_animationdelay . 'ms"';


            // Before button icon
            $button_one_before_icon = (isset($slide_item->button_one_before_icon) && $slide_item->button_one_before_icon) ? '<i class="fa ' . $slide_item->button_one_before_icon . '"></i>' : '';
            $button_two_before_icon = (isset($slide_item->button_two_before_icon) && $slide_item->button_two_before_icon) ? '<i class="fa ' . $slide_item->button_two_before_icon . '"></i>' : '';

            $output .= '<div class="sppb-slideshow-fullwidth-item item">';
            $output .= '<div class="sppb-slide-item-bg sppb-slideshow-fullwidth-item-bg" ' . $bg_image . '>';
            $output .= '<div class="container">';
            $output .= '<div class="row">';
            $output .= '<div class="col-sm-12">';
            $output .= '<div class="sppb-slideshow-fullwidth-item-text">';

            if (($slide_item->title) || ($slide_item->content)) {

                $title = ($slide_item->title) ? '<small class="sppb-slidehsow-sub-title ' . $title_animation . '" ' . $title_data_attr . '>' . $slide_item->title . '</small>' : '';

                if ($title) {
                    $output .= '<h2 class="sppb-fullwidth-title ' . $title_animation . '" ' . $title_data_attr . '> ' . $title . ' <span>' . $slide_item->sub_title . '</span></h2>';
                }

                if ($slide_item->content) {
                    $output .= '<p class="details ' . $cotent_animation . '" ' . $content_data_attr . '>' . $slide_item->content . '</p>';
                }

                if (($slide_item->button_one_text && $slide_item->button_one_url) || (isset($slide_item->button_two_text) && $slide_item->button_two_text && $slide_item->button_two_url)) {
                    $output .= '<div class="sppb-fw-slider-button-wrapper ' . $button_animation . '" ' . $button_data_attr . '> ';
                    if ($slide_item->button_one_text && $slide_item->button_one_url) {
                        $output .= '<a target="' . $target . '" href="' . $slide_item->button_one_url . '" class="btn btn-primary"> <span>' . $slide_item->button_one_text . '</span></a>';
                    }
                    if (isset($slide_item->button_two_text) && $slide_item->button_two_text && $slide_item->button_two_url) {
                        $output .= '<a target="' . $target . '" href="' . $slide_item->button_two_url . '" class="btn btn-primary"> <span>' . $button_two_before_icon . $slide_item->button_two_text . '</span></a>';
                    }

                    $output .= '</div>';
                }
            }

            $output .= '</div>'; // .sppb-slideshow-fullwidth-item-text
            $output .= '</div>'; // .col-sm-12

            $output .= '</div>'; // END:: /row
            $output .= '</div>'; // END:: /.container
            if ($variation != 'simple') {
                if ($variation == 'animation') {
                    $output .= '<div class="slider-bottom-content-wrap">';
                    $output .= '<div class="container">';
                    $output .= '<div class="row">';
                    $output .= '<div class="col-sm-10 col-sm-offset-1">';
                    $output .= '<div class="bottom-person-img">';
                    if ($slide_item->image)
                        $output .= '<img alt="" class="slider-botom-image ' . $image_animation . '" src="' . JURI::base() . $slide_item->image . '" ' . $image_data_attr . '>';
                    $output .= '</div>'; // .bottom-person-img
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                } else {
                    $output .= '<div class="bottom-slider-img">';
                    if ($slide_item->image)
                        $output .= '<img alt="" class="slider-botom-image ' . $image_animation . '" src="' . JURI::base() . $slide_item->image . '" ' . $image_data_attr . '>';
                    $output .= '</div>'; // .bottom-slider-img
                }
            }
            $output .= '</div>'; // END:: /.sppb-slideshow-fullwidth-item-bg
            $output .= '</div>'; // END:: /.sppb-slideshow-fullwidth-item
        }

        $output .= '</div>'; //END:: /.sppb-slider-items
        $output .= '</div>'; // END:: /.sppb-slider-item-wrapper
        // has next/previous arrows
        if ($arrows) {
            $output .= '<div class="customNavigation">';
            $output .= '<a class="sppbSlidePrev"><i class="rhino-icon rhino-arrow-prev"></i></a>';
            $output .= '<a class="sppbSlideNext"><i class="rhino-icon rhino-arrow-next"></i></a>';
            $output .= '</div>'; // END:: /.customNavigation
        }

        $output .= '</div>'; // /.sppb-slider-wrapper
        // has dot controls
        if ($controllers) {
            $output .= '<div class="owl-dots">';
            $output .= '<div class="owl-dot active"><span></span></div>';
            $output .= '<div class="owl-dot"><span></span></div>';
            $output .= '<div class="owl-dot"><span></span></div>';
            $output .= '</div>';
        }

        return $output;
    }

    public function scripts() {
        $app = JFactory::getApplication();
        $base_path = JURI::base() . '/templates/' . $app->getTemplate() . '/js/';
        return array($base_path . 'owl.carousel.min.js', $base_path . 'addon.slider.js');
    }

    public function js() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        return '
            jQuery(document).ready(function ($) {
                "use strict";
                var $slideFullwidth = $("' . $addon_id . ' #slide-fullwidth");
                var $autoplay = $slideFullwidth.attr("data-sppb-slide-ride");
                if ($autoplay == "true") {
                    var $autoplay = true;
                } else {
                    var $autoplay = false
                }
                var $controllers = $slideFullwidth.attr("data-sppb-slidefull-controllers");
                if ($controllers == "true") {
                    var $controllers = true;
                } else {
                    var $controllers = false
                }
                $slideFullwidth.owlCarousel({
                    margin: 0,
                    loop: true,
                    video: true,
                    autoplay: $autoplay,
                    animateIn: "fadeIn",
                    animateOut: "fadeOut",
                    autoplayHoverPause: true,
                    autoplaySpeed: 1500,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        1000: {
                            items: 1
                        }
                    },
                    dots: $controllers,
                });
                $(".sppbSlidePrev").click(function () {
                    $slideFullwidth.trigger("prev.owl.carousel", [400]);
                });
                $(".sppbSlideNext").click(function () {
                    $slideFullwidth.trigger("next.owl.carousel", [400]);
                });
            });
            ';
    }

    public function stylesheets() {
        $app = JFactory::getApplication();
        $base_path = JURI::base() . '/templates/' . $app->getTemplate() . '/css/';
        return array($base_path . 'owl.carousel.css', $base_path . 'owl.theme.css', $base_path . 'owl.transitions.css', $base_path . 'slide-animate.css');
    }

    public function css() {
        $addon_id = '#sppb-addon-' . $this->addon->id;
        $addont_styles = '';
        $addont_styles .= (isset($this->addon->settings->background) && $this->addon->settings->background) ? 'background: ' . $this->addon->settings->background . '; ' : '';
        $addont_styles .= (isset($this->addon->settings->color) && $this->addon->settings->color) ? 'color: ' . $this->addon->settings->color . '; ' : '';

        $css = '';
        if ($addont_styles) {
            $css .= $addon_id . ' .sppb-slider-fullwidth-wrapper .sppb-slider-item-wrapper {';
            $css .= $addont_styles;
            $css .= '}';
        }

        return $css;
    }

    public static function getTemplate() {
        $output = '
                <style type="text/css">
                    <# _.each (data.sp_slideshow_full_item, function(slide_item, item_key) { #>
                        #sppb-addon-{{ data.id }} .item-{{ data.id }}-{{ item_key }} .sppb-slideshow-fullwidth-item-bg{
                            background-image: url({{ pagebuilder_base + slide_item.bg }});
                            background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center center;
                        }
                    <# }); #>
                </style>
                <#
                var contentClass = (!_.isEmpty(data.class)) ? data.class : "";
                var autoplay = (!_.isEmpty(data.autoplay)) ? data.autoplay : "";
                var controllers = (!_.isEmpty(data.controllers)) ? data.controllers : "";
                var arrows = (!_.isEmpty(data.arrows)) ? data.arrows : "";
                var variation = (!_.isEmpty(data.variation)) ? data.variation : "simple";
                var color = (!_.isEmpty(data.color)) ? data.color : "";
                var background = (!_.isEmpty(data.background)) ? data.background : "";

                var title_animation = (!_.isEmpty(data.title_animation)) ? data.title_animation : "";
                var cotent_animation = (!_.isEmpty(data.cotent_animation)) ? data.cotent_animation : "";
                var image_animation = (!_.isEmpty(data.image_animation)) ? data.image_animation : "";
                var button_animation = (!_.isEmpty(data.button_animation)) ? data.button_animation : "";

                var slide_autoplay = (autoplay) ? \'data-sppb-slide-ride="true"\' : "";
                var slide_controllers = (controllers) ? \'data-sppb-slidefull-controllers="true"\' : "";
                #>
                <div class="sppb-addon sppb-slider-wrapper sppb-slider-fullwidth-wrapper owl-theme {{contentClass}} varition-{{variation}}">
                <div class="sppb-slider-item-wrapper">
                <div id="slide-fullwidth" class="owl-carousel" {{{controllers}}} {{{slide_autoplay}}} >

                <# _.each(data.sp_slideshow_full_item, function(slide_item, item_key) {

                    var column_size = (variation != "simple") ? "col-sm-6" : "col-sm-12";
                    var target = (!_.isEmpty(target)) ? target : "_self";

                    if (!_.isEmpty(slide_item.title_animation)) {
                        title_animation = \' sppb-wow \' + slide_item.title_animation;
                    }

                    var title_data_attr = "";
                    if (!_.isEmpty(slide_item.title_animationduration)){
                        title_data_attr += \' data-sppb-wow-duration="\' + slide_item.title_animationduration + \'ms"\';
                    }
                    if (!_.isEmpty(slide_item.title_animationdelay)){
                        title_data_attr += \' data-sppb-wow-delay="\' + slide_item.title_animationdelay + \'ms"\';
                    }

                    var subtitle_animation= "";
                    if (!_.isEmpty(slide_item.subtitle_animation)) {
                        subtitle_animation = \' sppb-wow \' + slide_item.subtitle_animation;
                    }

                    var subtitle_data_attr = "";
                    if (!_.isEmpty(slide_item.subtitle_animationduration)){
                        subtitle_data_attr += \' data-sppb-wow-duration="\' + slide_item.subtitle_animationduration + \'ms"\';
                    }
                    if (!_.isEmpty(slide_item.subtitle_animationdelay)){
                        subtitle_data_attr += \' data-sppb-wow-delay="\' + slide_item.subtitle_animationdelay + \'ms"\';
                    }

                    if (!_.isEmpty(slide_item.image_animation)) {
                        image_animation = \' sppb-wow \' + slide_item.image_animation;
                    }

                    var image_data_attr = "";
                    if (!_.isEmpty(slide_item.image_animationduration)){
                        image_data_attr += \' data-sppb-wow-duration="\' + slide_item.image_animationduration + \'ms"\';
                    }
                    if (!_.isEmpty(slide_item.cotent_animationdelay)){
                        image_data_attr += \' data-sppb-wow-delay="\' + slide_item.cotent_animationdelay + \'ms"\';
                    }

                    if (!_.isEmpty(slide_item.cotent_animation)) {
                        cotent_animation = \' sppb-wow \' + slide_item.cotent_animation;
                    }

                    var content_data_attr = "";
                    if (!_.isEmpty(slide_item.cotent_animationduration)){
                        content_data_attr += \' data-sppb-wow-duration="\' + slide_item.cotent_animationduration + \'ms"\';
                    }
                    if (!_.isEmpty(slide_item.cotent_animationdelay)){
                        content_data_attr += \' data-sppb-wow-delay="\' + slide_item.cotent_animationdelay + \'ms"\';
                    }

                    if (!_.isEmpty(slide_item.button_animation)) {
                        button_animation = \' sppb-wow \' + slide_item.button_animation;
                    }

                    var button_data_attr = "";
                    if (!_.isEmpty(slide_item.button_animationduration)){
                        button_data_attr += \' data-sppb-wow-duration="\' + slide_item.button_animationduration + \'ms"\';
                    }
                    if (!_.isEmpty(slide_item.button_animationdelay)){
                        button_data_attr += \' data-sppb-wow-delay="\' + slide_item.button_animationdelay + \'ms"\';
                    }

                    var button_one_before_icon = (!_.isEmpty(slide_item.button_one_before_icon)) ? \'<i class="fa \' + slide_item.button_one_before_icon + \'"></i>\' : "";
                    var button_two_before_icon = (!_.isEmpty(slide_item.button_two_before_icon)) ? \'<i class="fa \' + slide_item.button_two_before_icon + \'"></i>\' : "";
                    #>
                    <div class="sppb-slideshow-fullwidth-item item-{{ data.id }}-{{ item_key }}">
                    <div class="sppb-slide-item-bg sppb-slideshow-fullwidth-item-bg" {{data.bg_image}}>
                    <div class="container">
                    <div class="row">
                    <div class="col-sm-12">
                    <div class="sppb-slideshow-fullwidth-item-text">

                    <# if ((slide_item.title) || (slide_item.content)) {

                        title = (slide_item.title) ? \'<small class="sppb-slidehsow-sub-title \' + title_animation + \'" \' + title_data_attr + \'>\' + slide_item.title + \'</small>\' : "";

                        if (title) { #>
                            <h2 class="sppb-fullwidth-title {{title_animation}}" {{title_data_attr}}> {{{title}}} <span>{{slide_item.sub_title}}</span></h2>
                        <# }

                        if (slide_item.content) { #>
                            <p class="details {{cotent_animation}}" {{content_data_attr}}> {{slide_item.content}}</p>
                       <# }

                        if ((slide_item.button_one_text && slide_item.button_one_url) || (!_.isEmpty(slide_item.button_two_text))) { #>
                            <div class="sppb-fw-slider-button-wrapper {{button_animation}}" {{button_data_attr}}>
                            <# if (slide_item.button_one_text && slide_item.button_one_url) { #>
                                <a target="{{target}}" href="{{slide_item.button_one_url}}" class="btn btn-primary"> <span>{{slide_item.button_one_text}}</span></a>
                            <# }
                            if (!_.isEmpty(slide_item.button_two_text)) { #>
                                <a target="{{target}}" href="{{slide_item.button_two_url}}" class="btn btn-primary"><span>{{button_two_before_icon}} {{slide_item.button_two_text}}</span></a>
                            <# } #>
                            </div>
                       <# } #>
                    <# } #>

                    </div>
                    </div>

                    </div>
                    </div>
                    <# if (variation != "simple") {
                        if (variation == "animation") { #>
                            <div class="slider-bottom-content-wrap">
                            <div class="container">
                            <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                            <div class="bottom-person-img">
                            <# if (slide_item.image){ #>
                                <img alt="" class="slider-botom-image {{image_animation}}" src="{{slide_item.image}}" {{image_data_attr}}>
                            <# } #>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        <# } else { #>
                            <div class="bottom-slider-img">
                            <# if (slide_item.image){ #>
                                <img alt="" class="slider-botom-image {{image_animation}}" src="{{slide_item.image}}" {{image_data_attr}}>
                            <# } #>
                            </div>
                        <# } #>
                    <# } #>
                    </div>
                    </div>
                <# }) #>

                </div>
                </div>
                <# if (arrows) { #>
                    <div class="customNavigation">
                    <a class="sppbSlidePrev"><i class="rhino-icon rhino-arrow-prev"></i></a>
                    <a class="sppbSlideNext"><i class="rhino-icon rhino-arrow-next"></i></a>
                    </div>
                <# } #>

                </div>

                <# if (controllers) { #>
                    <div class="owl-dots">
                    <div class="owl-dot active"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    <div class="owl-dot"><span></span></div>
                    </div>
                <# } #>
                ';
        return $output;
    }

}

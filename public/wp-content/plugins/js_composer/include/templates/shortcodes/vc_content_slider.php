<?php
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_style( 'slick' );
wp_enqueue_script( 'slick' );
wp_enqueue_script( 'slick-fire' );

$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'cs-wrapper clearfix ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

$output .= "\n".'<div class="'.$css_class.'">';
if($title)
    $output .= "\n\t".'<h2 class="cs-title">'. $title .'</h2>';
$output .= "\n\t".'<div class="content-slider">';
$output .= "\n\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div>'.$this->endBlockComment('.cs-slider');
$output .= "\n".'</div>'.$this->endBlockComment('.cs-wrapper');

echo $output;

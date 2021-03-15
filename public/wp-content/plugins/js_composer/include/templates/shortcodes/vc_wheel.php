<?php
wp_enqueue_script('jquery-ui-accordion');
wp_enqueue_script( 'kinetic' );
wp_enqueue_style( 'swipejs' );
wp_enqueue_script( 'swipejs' );
wp_enqueue_script( 'spinning-wheel' );
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'link' => '',
    'el_class' => ''
), $atts));

$link = ($link=='||') ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];
?>

<script>
    DATA_WHEEL = [];
</script>

<?php

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wheel-wrapper clearfix ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

$output .= "\n".'<div class="'.$css_class.'">';
$output .= "\n\t".'<div class="wheel vc_col-sm-6" id="wheel">';
$output .= "\n\t".'</div>'.$this->endBlockComment('.wheel');
$output .= "\n\t".'<div class="wheel-content vc_col-sm-6">';
$output .= "\n\t\t".'<h2 class="wheel-title">'. $title .'</h2>';
$output .= "\n\t\t".'<div id="wheelSlider" class="swipe">';
$output .= "\n\t\t\t".'<div class="swipe-wrap clearfix">';
$output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t".'</div>';
$output .= "\n\t\t".'</div>'.$this->endBlockComment('.flexslider');
$output .= "\n\t\t".'<div class="wheel-pagination"></div><a class="wheel-link" href="'.$a_href.'" target="'.$a_target.'" title="'.$a_title.'">'. $a_title .'</a>';
$output .= "\n\t".'</div>';
$output .= "\n".'</div>'.$this->endBlockComment('.wheel-wrapper');

echo $output;

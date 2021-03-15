<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Item", "js_composer"),
    'el_class' => ''
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'item ' . $el_class, $this->settings['base'], $atts );
$output .= "\n\t\t" . '<div class="'.$css_class.'">';
$output .= "\n\t\t\t" . '<div class="cs-item-content">';
$output .= ($content=='' || $content==' ') ? __("Empty items. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '</div>';
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment('.item') . "\n";

echo $output;

?>
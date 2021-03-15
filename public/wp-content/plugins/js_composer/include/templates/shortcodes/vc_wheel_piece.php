<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Piece", "js_composer"),
    'label' => '',
    'image' => '',
    'icon' => '',
    'el_class' => ''
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'item ' . $el_class, $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
$output .= "\n\t\t\t\t" . '<h3 class="wheel-slide-title '.$icon.'">'.$title.'</h3>';
$output .= "\n\t\t\t\t" . '<div class="wheel-slide-content">';
$output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t\t" . '</div>';
$output .= '<script>DATA_WHEEL.push({text: "' . edexWheelText($label) . '", image: "' . wp_get_attachment_url($image) . '"});</script>';
$output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.item') . "\n";

echo $output;

?>
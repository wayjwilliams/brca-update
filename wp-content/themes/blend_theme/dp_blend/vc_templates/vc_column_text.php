<?php
$output = $el_class = $dp_animation = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'dp_animation' => '',
    'css' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_text_column wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
$animation = getDPAnimation($dp_animation);
$output .= "\n\t".'<div class="'.$css_class.'" '.$animation.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;
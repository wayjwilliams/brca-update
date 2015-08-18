<?php

add_filter('dynamo-get-json', 'dynamo_wpml_get_json', 10, 2);

function dynamo_wpml_get_json($dir, $lang) {
    global $wpdb, $sitepress;
	$current_lang = 'en';
	if (ICL_LANGUAGE_CODE !='') $current_lang = ICL_LANGUAGE_CODE;
        if ($dir == 'options') {
            $code = $wpdb->get_var("SELECT default_locale FROM {$wpdb->prefix}icl_languages WHERE code='" . $current_lang . "'");
            $lang = $code . '/';
        }
    return $lang;
}

// EOF
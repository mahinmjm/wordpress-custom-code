<?php 


// get_excerpt with tag
function custom_wp_trim_excerpt( $excerpt_word_count, $text='') {
$raw_excerpt = $text;
if ( '' == $text ) {
    //Retrieve the post content.
    $text = get_the_content('');
 
    //Delete all shortcode tags from the content.
    $text = strip_shortcodes( $text );
 
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
     
    $allowed_tags = '<p>,<a>,<em>,<span>,<strong>,<img>'; // Add allowed tag name
    $text = strip_tags($text, $allowed_tags);
     
    // custom length for excerpt
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);
     
    $excerpt_end = '[...]'; // read more text 
    
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
     
    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt', 5);

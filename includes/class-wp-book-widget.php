<?php

/**
 * File to create a custom widget for book.
 *
 * @package WordPress
 */

/**
 * Extending the WP_Widget class for custom widget.
 *
 * This widget accepts the category as input ans displays the books of that particular category.
 */


class Wp_Book_Widget extends WP_Widget{


    public function __construct(){

        $widget_ops = array(
            'classname' => 'wp-book-widget',
            'description' =>__('Display books of selected category','wp-book')
        );

        parent::__construct('wp-book-widget-id','Display Books',$widget_ops);
    }
}




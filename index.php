<?php

    /*
        Plugin Name: Santa Clarita Custom Post Types
        Plugin URI: #
        Description: This is not just a plugin, it's the beginning of a new era for you
        Author: Marco Berrocal and our attendees
        Version: 1.0.0
        Author URI: https://www.greengeeks.com
    */
    
    function meetup_cpt_cb() {

        //https://developer.wordpress.org/reference/functions/get_post_type_labels/


        $mov_labels = array(
            'name' => __('Movies'),
            'singular_name' => __('Previous Movie'),
            'add_new' => __('Add New Movie'),
            'add_new_item' => __('Add New Movie'),
            'edit_item' => __('Edit this Movie'),
            'new_item' => __('New Movie'),
            'view_item' => __('View Movies'),
            'search_items' => __('Search Previous Movies'),
            'not_found' =>  __('Na na na'),
            'not_found_in_trash' => __('Nothing in the trash ladies and gentlemen!')
        );

        //https://developer.wordpress.org/reference/functions/register_post_type/
        $mov_args = array(
            'labels' => $mov_labels,
            'description' => 'Give this description some love',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'menu_icon' => 'dashicons-video-alt2',
            'capability_type' => 'post',
            'has_archive' => true,
            'rewrite' => array('slug' => 'best-movie-reviews', 'with_front' => true ),
            'hierarchical' => false,  //i want this to behave like a post
            'menu_position' => null,
            //'show_in_rest' => true, //GUT
            'supports' => array('title','editor', 'excerpt', 'thumbnail', 'author', 'custom-fields')  //Core features include 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', '', and 'post-formats'.
        );
        
        //create my custom post type


        register_post_type('movies', $mov_args);

        flush_rewrite_rules();


    }  //meetup_cpt_cb
    

    function meetup_ctx_cb () {

        $mov_tax_labels = array(

            //https://developer.wordpress.org/reference/functions/get_taxonomy_labels/

            'name' => __('Movie Genre'),
            'singular_name' => __('Movie Genre'),
            'add_new' => __('Add New Genre'),
            'add_new_item' => __('Add New Genre'),
            'edit_item' => __('Edit this genre'),
            'new_item' => __('New Genre'),
            'view_item' => __('View Genero'),
            'search_items' => __('Search Latest  Genre'),
            'not_found' =>  __('Na de Na'),
            'not_found_in_trash' => __('Nothing in trash')

        );

        $mov_tax_args = array (

            //https://developer.wordpress.org/reference/functions/register_taxonomy/

            'labels' => $mov_tax_labels,
            'description' => 'Tax this hard!!',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'query_var' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'top-movie-genre', 'with_front' => true ),

        );

        register_taxonomy('genre', array('movies', 'post'), $mov_tax_args);

        flush_rewrite_rules();

    }  //meetup_ctx_cb
    
    add_action('init', 'meetup_cpt_cb');
    add_action('init', 'meetup_ctx_cb');

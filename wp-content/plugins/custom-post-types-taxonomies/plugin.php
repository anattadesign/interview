<?php
/*
Plugin Name: Custom Post Types & Taxonomies
Plugin URI:
Description: Adds all the custom post types & taxonomies being used on site
Author: AnattaDesign
Version: 1.0
Author URI: http://anattadesign.com/
*/

class Custom_Post_Types_Taxonomies {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
	}

	public function register_post_types() {

		/**
		 * Truth Bombs
		 */
		$args = array(
			'label'              => __( 'Questions' ),
			'singular_label'     => __( 'Question' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'query_var'          => true,
			'rewrite'            => array(
				'slug'       => 'question',
				'with_front' => true
			),
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array(
				'title',
				'editor',
				'thumbnail'
			),
			'has_archive'        => 'question'
		);

		register_post_type( 'question', $args );
	}

	public function register_taxonomies() {

	}
}

$custom_post_types_taxonomies = new Custom_Post_Types_Taxonomies();
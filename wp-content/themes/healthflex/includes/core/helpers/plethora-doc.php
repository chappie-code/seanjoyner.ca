<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M                    (c) 2014

Plethora_Doc class

Version: 1.2

*/

if ( ! defined( 'ABSPATH' ) ) exit; // NO DIRECT ACCESS 


/**
 * @package Plethora Framework
 * @author Plethora Dev Team
 * @copyright Plethora Themes (c) 2016
 *
 */
class Plethora_Doc {

	public $product;
	public $index;

	public function __construct( $product = '' ) {

		if ( ! empty( $product ) ) {

			$this->product = $product ;
			$this->index   = $this->set_index();
		}
	}

	public function set_index() {

		$index = array();
		// get parent sections first
		$args = array(
			'taxonomy'   => 'doc-section',
			'parent'     => 0,
			'hide_empty' => false,
			'orderby'    => 'meta_value',
			'meta_key'   => TERMSMETA_PREFIX . 'doc-section-displayorder',
		);
		$sections = get_terms( $args );
		foreach ( $sections as $section ) {

			$index[$section->slug]['posts'] = array();
			$section_posts = new WP_Query( $this->get_docs_query_args( $section->slug, false ) );
			foreach ( $section_posts->get_posts() as $doc ) {

				$index[$section->slug]['posts'][$doc->post_name]['doc_id']       = $doc->ID;
				$index[$section->slug]['posts'][$doc->post_name]['doc_slug']     = $doc->post_name;
				$index[$section->slug]['posts'][$doc->post_name]['doc_title']    = $doc->post_title;
				$index[$section->slug]['posts'][$doc->post_name]['doc_excerpt']  = $doc->post_excerpt;
				$index[$section->slug]['posts'][$doc->post_name]['doc_content']  = $doc->post_content;
				$index[$section->slug]['posts'][$doc->post_name]['doc_sidenote'] = Plethora_Theme::option( METAOPTION_PREFIX .'doc-sidecontent', '', $doc->ID );
			}
			
			$index[$section->slug]['slug']           = $section->slug;
			$index[$section->slug]['term_id']        = $section->term_id;
			$index[$section->slug]['name']           = $section->name;
			$index[$section->slug]['description']    = $section->description;
			$index[$section->slug]['count']          = $section->count;
			$index[$section->slug]['level']          = 1;
			$index[$section->slug]['icon']           = get_term_meta( $section->term_id, TERMSMETA_PREFIX .'doc-section-icon', true );
			$index[$section->slug]['child_sections'] = array();

			
			$child_args = array(
				'taxonomy'   => 'doc-section',
				'child_of'     => $section->term_id,
				'hide_empty' => false,
				'orderby'    => 'meta_value',
				'meta_key'   => TERMSMETA_PREFIX . 'doc-section-displayorder',
			);
			$child_sections = get_terms( $child_args );

			foreach ( $child_sections as $child_section ) {

				$child_section_posts = new WP_Query( $this->get_docs_query_args( $child_section->slug ) );
				if ( $child_section_posts->have_posts() ) { 

					// Add subsection ONLY IF WE HAVE POSTS
					$index[$section->slug]['child_sections'][$child_section->slug]['slug']        = $child_section->slug;
					$index[$section->slug]['child_sections'][$child_section->slug]['term_id']     = $child_section->term_id;
					$index[$section->slug]['child_sections'][$child_section->slug]['name']        = $child_section->name;
					$index[$section->slug]['child_sections'][$child_section->slug]['description'] = $child_section->description;
					$index[$section->slug]['child_sections'][$child_section->slug]['count']       = $child_section->count;
					$index[$section->slug]['child_sections'][$child_section->slug]['level']       = 2;
					$index[$section->slug]['child_sections'][$child_section->slug]['posts']       = array();

					foreach ( $child_section_posts->get_posts() as $doc ) {

						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_id']       = $doc->ID;
						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_slug']     = $doc->post_name;
						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_title']    = $doc->post_title;
						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_excerpt']  = $doc->post_excerpt;
						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_content']  = $doc->post_content;
						$index[$section->slug]['child_sections'][$child_section->slug]['posts'][$doc->post_name]['doc_sidenote'] = Plethora_Theme::option( METAOPTION_PREFIX .'doc-sidecontent', '', $doc->ID );
					}
				} 

				wp_reset_postdata();
			}
		}
		// print_r( $index );
		return $index;
	}

	private function get_docs_query_args( $section, $include_children = true ) {

		$posts_query_args = array(
			'post_type'           => 'doc',
			'posts_per_page'      => -1,
			'ignore_sticky_posts' => true,
			'orderby'             => 'menu_order',
			'order'               => 'ASC',
			'tax_query'           => array(
				'relation' => 'AND',
				array(
					'taxonomy'         => 'doc-section',
					'field'            => 'slug',
					'terms'            => $section,
					'include_children' => $include_children
				),
				array(
					'taxonomy' => 'kb-product',
					'field'    => 'slug',
					'terms'    => $this->product,
				),
			)
		);

		return $posts_query_args;
	}

	public function get_product() {

		return $this->product;
	}

	public function get_index() {

		return $this->index;
	}

	public function get_section_data( $section ) {

		$index = $this->get_index();
		$section_data = !empty( $index[$section] ) ? $index[$section] : array();
		if ( isset( $section_data['docs'] ) ) {

			unset( $section_data['docs'] );
		} 
		return $section_data;
	}

	public function get_section_docs( $section ) {

		$index = $this->get_index();
		return !empty( $index[$section]['docs'] ) ? $index[$section]['docs'] : array();
	}
}
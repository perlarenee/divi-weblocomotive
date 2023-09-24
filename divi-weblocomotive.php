<?php
/*
Plugin Name: Divi Weblocomotive
Plugin URI:  weblocomotive.com
Description: WebLocomotive divi extentions
Version:     1.0.0
Author:      WebLocomotive
Author URI:  
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: diwe-divi-weblocomotive
Domain Path: /languages

Divi Weblocomotive is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Weblocomotive is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Weblocomotive. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


if ( ! function_exists( 'diwe_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 1.0.0
 */
function diwe_initialize_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviWeblocomotive.php';
}
add_action( 'divi_extensions_init', 'diwe_initialize_extension' );
endif;

/**
 * Enqueue script with jQuery as a dependency.
 */
function wpdocs_scripts_method() {
	$plugin_dir = WP_PLUGIN_DIR . '/divi-weblocomotive';
	wp_enqueue_script( 'fontawesome', $plugin_dir . '/scripts/fontawesome.js', array( 'jquery' ) );

}
add_action( 'wp_enqueue_scripts', 'wpdocs_scripts_method' );

function weichie_load_more() {
//inspired by https://weichie.com/blog/load-more-posts-ajax-wordpress/

		$dark = $_POST['dark'] ? $_POST['dark'] : "";//$this->props['dark']=="on"? "dark" : "";
		$code = $_POST['code'] ? $_POST['code'] : false;//$this->props['code']=="on"? true : false;
		$limit = $_POST['posts_per_page'] ? $_POST['posts_per_page'] : 4;//$this->props['post_limit'];
		$post_type = $_POST['post_type'] ? $_POST['post_type'] : "post";
		$order = $_POST['order'] ? $_POST['order'] : "ASC";
		$orderby = $_POST['orderby'] ? $_POST['orderby'] : "date";
		$paged = $_POST['paged'] ? $_POST['paged'] : 0;

		$blog = '';

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $limit,
			'orderby' => $orderby,
  			'order' => $order,
			'paged' => $paged
		);
		$query = new WP_Query($args);
		$max_pages = $query->max_num_pages;
		
		if($query->have_posts()){
			ob_start();
			$posts = $query->posts;

			foreach($posts as $post) {
				$title = '<h1>'.($code ? '<span class="code">&lt;H1&gt;</span>':'').get_the_title( $post->ID ).($code ? '<span class="code">&lt;/H1&gt;</span>':'').'</h1>';
				$output = '';
	
				$author_id = get_post_field( 'post_author', $post->ID);
				$author_name = get_the_author_meta( 'display_name', $author_id );		
				$author_link = get_author_posts_url($author_id );
				$author = '<li class="author"><a href="'.$author_link.'">'.$author_name.'</a></li>';
	
				$category = ""; 
				if(get_the_category($post->ID)[0]->cat_name && get_the_category($post->ID)[0]->cat_name !== "Uncategorized"){
					$category = '<h2>'.($code ? '<span class="code">&lt;H2&gt;</span>':'').get_the_category($post->ID)[0]->cat_name.($code ? '<span class="code">&lt;/H2&gt;</span>':'').'</h2>'; 
				}
	
				$post_tags = get_the_tags($post->ID);
				$separator = ' | ';
				$tagList = '';
				if ( ! empty( $post_tags ) ) {
					foreach ( $post_tags as $tag ) {
						$output .= '<a href="' . esc_attr( get_tag_link( $tag->term_id ) ) . '">' . __( $tag->name ) . '</a>' . $separator;
					}
				}
				$tagList = '<li class="tags">'.trim( $output, $separator ).'</li>';
	
				$image = "";
				if ( has_post_thumbnail( $post->ID ) ) {
					$image = wp_get_attachment_image_src( 
						get_post_thumbnail_id( $post->ID ), 
						'full'
					);
					$imageAlt = get_post_meta($post->ID, '_wp_attachment_image_alt', TRUE);
					$imageTitle = get_the_title($post->ID);
					$image = '<div class="photo" style="background-image: url('.$image[0].')"></div>';
				}
	
				$excerpt = '<p>'.($code ? '<span class="code">&lt;p&gt;</span>':'').get_the_excerpt($post).($code ? '<span class="code">&lt;/p&gt;</span>':'').'</p>';
				$readmore = '<p class="readmore"><a href="'.get_the_permalink($post).'">'.($code ? '<span class="code">&lt;a&gt;</span>':'').'Read More...'.($code ? '<span class="code">&lt;/a&gt;</span>':'').'</a></p>';
	
				$blog .= sprintf( 
					'<div class="blog-card %1$s code"><div class="meta">%2$s<ul class="details">%3$s%4$s</ul></div><div class="description">%5$s%6$s%7$s%8$s</div></div>',
					$dark,
					$image,
					$author,
					$tagList,
					$title,
					$category,
					$excerpt,
					$readmore
				);
	
			}
			wp_reset_postdata();
			echo $blog;
			$output = ob_get_contents();
			ob_end_clean();
		}

		$result = [
			'max' => $max_pages,
			'html' => $output
		];
		echo json_encode($result);
		exit;

  }
  add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
  add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');
<?php
//inspired by https://codepen.io/iamsaief/pen/jObaoKo
class DIWE_Blog extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_blog';
	//public $child_slug = 'et_pb_diwe_masonry_grid_item';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'WL Blog', 'diwe-divi-weblocomotive' ); 
		//$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->icon             = '4';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'diwe-divi-weblocomotive' ),
				),
			),
		);
		//$this->main_css_element = '%%order_class%%';
	}

	public function get_fields() {
		return array(
			'heading' => array(
				'label'           => esc_html__( 'Heading', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'content'     => array(
				'label'           => esc_html__( 'Content', 'diwe-divi-weblocomotive' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Subcontext here', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'post_type' => array(
				'label'           => esc_html__( 'Post Type', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Blog Post Type', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => 'post',
			),
			'post_limit' => array(
				'label'           => esc_html__( 'Limit Posts', 'dicm-divi-custom-modules' ),
				'type'            => 'range',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Limit initially visible blog posts', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => "4",
			),
			'order' => array(
				'label'             => esc_html__( 'Order Posts', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'ASC', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'DESC', 'diwe-divi-weblocomotive' ),
				),
				'description'     => esc_html__( 'Order posts ascending or descending', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => 'off',
			),
			'orderby' => array(
				'label'           => esc_html__( 'Order By', 'et_builder' ),
				'type'            => 'select',
				'options'           => array(
					'none'  => esc_html__( 'none', 'diwe-divi-weblocomotive' ),
					'ID'  => esc_html__( 'ID', 'diwe-divi-weblocomotive' ),
					'author'  => esc_html__( 'author', 'diwe-divi-weblocomotive' ),
					'title'  => esc_html__( 'title', 'diwe-divi-weblocomotive' ),
					'type'  => esc_html__( 'type', 'diwe-divi-weblocomotive' ),
					'date'  => esc_html__( 'date', 'diwe-divi-weblocomotive' ),
					'modified'  => esc_html__( 'modified', 'diwe-divi-weblocomotive' ),
					'parent'  => esc_html__( 'parent', 'diwe-divi-weblocomotive' ),
					'rand'  => esc_html__( 'rand', 'diwe-divi-weblocomotive' ),
					'comment_count'  => esc_html__( 'comment_count', 'diwe-divi-weblocomotive' ),
					'relevance'  => esc_html__( 'relevance', 'diwe-divi-weblocomotive' ),
					'menu_order'  => esc_html__( 'menu_order', 'diwe-divi-weblocomotive' ),
				),
				'description'     => esc_html__( 'Order by selected element', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => 'date',
			),
			'dark' => array(
				'label'             => esc_html__( 'Dark Theme', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'Dark', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Light', 'diwe-divi-weblocomotive' ),
				),
				'description'     => esc_html__( 'Select dark or light theme', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => 'off',
			),
			'code' => array(
				'label'             => esc_html__( 'Reveal Code', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'Show', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Hide', 'diwe-divi-weblocomotive' ),
				),
				'description'     => esc_html__( 'Enable or disable pseudo code styling', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => 'off',
			),
		);
	}

	public function get_blog($post_type) {
		$dark = $this->props['dark']=="on"? "dark" : "";
		$code = $this->props['code']=="on"? true : false;
		$limit = $this->props['post_limit'] ? $this->props['post_limit'] : 2;
		$order = $this->props['order'] == "on" ? "ASC" : "DESC";
		$orderby = $this->props['orderby'] ? $this->props['orderby'] : 'post';
		$blog = "";
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $limit,
			'orderby' => $orderby,
  			'order' => $order,
			'pages'=>1
		);
		$query = new WP_Query($args);
		if($query->have_posts()){

			$posts = $query->posts;

			$postData = json_encode([
				'post_type' => $post_type,
				'posts_per_page' => $limit,
				'orderby' => $orderby,
				'order' => $order,
				'dark' => $dark,
				'code' => $code
			]);

			$blog = "<div class='diwe-blog' data-post='".$postData."'>";

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
			
			$blog .= '</div>';
			$blog .= '<div class="loadmorePosts"><a data-instance="1" class="btn"><div class="inner">Load More</div></a></div>';
		}
		return $blog;
	}
	

	public function render( $attrs, $content = null, $render_slug ) {
		$title = $this->props['heading'];
		$post_type = $this->props['post_type'];
		//$loadmore = '<div class="loadmorePosts"><a data-instance="1" >Load More</a></div>';
		$output =  sprintf('<h3 class="blog-heading">%1s</h3><h5>%2$s</h5>%3$s', 
			esc_html( $title ),
			$this->props['content'],
			$this->get_blog($post_type)
		);
		return $output;
	}

}

new DIWE_Blog;

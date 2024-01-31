<?php

class DIWE_MasonryGridItem extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_masonry_grid_item';
	// Module item has to use `child` as its type property
	public $type                     = 'child';

	// Module item's attribute that will be used for module item label on modal
	public $child_title_var          = 'heading';

	// If the attribute defined on $this->child_title_var is empty, this attribute will be used instead
	public $child_title_fallback_var = 'subtitle';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'Masonry Grid Item', 'diwe-divi-weblocomotive' ); 
		//$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->icon             = 'l';
		
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'diwe-divi-weblocomotive' ),
				),
			),
		);
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
			'content' => array(
				'label'           => esc_html__( 'Description', 'diwe-divi-weblocomotive' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear as the image description', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'upload' => array(
				'label'              => esc_html__( 'Image', 'diwe-divi-weblocomotive' ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload an image', 'diwe-divi-weblocomotive' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'diwe-divi-weblocomotive' ),
				'update_text'        => esc_attr__( 'Set As Image', 'diwe-divi-weblocomotive' ),
				//'tab_slug'           => $all_types_tab_slug,
				'toggle_slug'        => 'main_content',
			),
			'url' => array(
				'label'           => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'url',
				'default' => ''
			),
			'url_window' => array(
				'label'             => esc_html__( 'Link Behavior', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'New Window', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Same window', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content'
			),
			'background' => array(
				'label'           => esc_html__( 'Background Color', 'diwe-divi-weblocomotive' ),
				'type'            => 'color',
				'toggle_slug'     => 'main_content',
				'default' => '#FBBD5A',
			),
			'color' => array(
				'label'           => esc_html__( 'Text Color', 'diwe-divi-weblocomotive' ),
				'type'            => 'color',
				'toggle_slug'     => 'main_content',
				'default' => '#000000',
			),
			't_size' => array(
				'label'           => esc_html__( 'Title Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '200',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select font size of title.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '18',
			),
			'p_size' => array(
				'label'           => esc_html__( 'Description Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '200',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select font size of description text.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '16',
			),
			'size' => array(
				'label'           => esc_html__( 'Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'xy1' => esc_html__( 'Single', 'diwe-divi-weblocomotive' ),
					'x2'  => esc_html__( 'Wide', 'diwe-divi-weblocomotive' ),
					'y2'  => esc_html__( 'Tall', 'diwe-divi-weblocomotive' ),
					'xy2'  => esc_html__( 'Wide/Tall', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'xy1',
				//'show_if'   => array( 'parentModule:structure' => 'on'). value gets 'stuck'
			),
			'size_tablet' => array(
				'label'           => esc_html__( 'Tablet size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'xy1' => esc_html__( 'Single', 'diwe-divi-weblocomotive' ),
					'x2'  => esc_html__( 'Wide', 'diwe-divi-weblocomotive' ),
					'y2'  => esc_html__( 'Tall', 'diwe-divi-weblocomotive' ),
					'xy2'  => esc_html__( 'Wide/Tall', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'xy1',
				//'show_if'   => array( 'parentModule:structure' => 'on'). value gets 'stuck'
			),
			'size_mobile' => array(
				'label'           => esc_html__( 'Mobile Device size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'xy1' => esc_html__( 'Single', 'diwe-divi-weblocomotive' ),
					'x2'  => esc_html__( 'Wide', 'diwe-divi-weblocomotive' ),
					'y2'  => esc_html__( 'Tall', 'diwe-divi-weblocomotive' ),
					'xy2'  => esc_html__( 'Wide/Tall', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'xy1',
				//'show_if'   => array( 'parentModule:structure' => 'on'). value gets 'stuck'
			),
			'fit' => array(
				'label'           => esc_html__( 'Fit', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'width' => esc_html__( 'Width', 'diwe-divi-weblocomotive' ),
					'height'  => esc_html__( 'Height', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'affects'         => array(
					'position_height',
					'position_width',
				),
				'default' => 'width',
			),
			'position_height' => array(
				'label'           => esc_html__( 'Background Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'top' => esc_html__( 'Top', 'diwe-divi-weblocomotive' ),
					'height_center' => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'bottom'  => esc_html__( 'Bottom', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'width',
				'default' => 'top',
			),
			'position_width' => array(
				'label'           => esc_html__( 'Background Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'left'  => esc_html__( 'Left', 'diwe-divi-weblocomotive' ),
					'width_center' => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'right'  => esc_html__( 'Right', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'height',
				'default' => 'left',
			),
		);
		
	}
	
	public function render( $attrs, $content = null, $render_slug ) {
		
		$count = 0;
		$post_type = get_post_type( get_the_ID() );
		$parent_module = self::get_parent_modules( $post_type )['et_pb_diwe_masonry_grid'];
		$structure = $parent_module->shortcode_atts['structure'];
		$background = $this->props['background'];
		$color = $this->props['color'];
		$url = $this->props['url'];
		$url_behavior= $this->props['url_window'];
		$t_size = $this->props['t_size'];
		$p_size = $this->props['p_size'];

		$hasOverlay = false;
		if($url !=""|$this->props['heading']!==""|$this->props['content']!==""){
			$hasOverlay = true;
		}
		if($url != ""){
			$url = 'href="'.$url.'"';
		}
		$size = "xy1";
		$sizeTablet = $size;
		$sizeMobile = $size;
		$fit = $this->props['fit'];
		$position = $this->props['position_height'];
		if($fit =="height"){
			$position = $this->props['position_width'];
		}
		if($this->props['size']!="" && $structure=="on"){
			$size = $this->props['size'];
		}
		if($this->props['size_mobile']!="" && $structure=="on"){
			$sizeMobile = $this->props['size_mobile'];
		}
		if($this->props['size_tablet']!="" && $structure=="on"){
			$sizeTablet = $this->props['size_tablet'];
		}
		$this->wrapper_settings = array(
			'attrs'                   => array(
			   'class' => 'grid-item '.$size . ' fit-'.$fit .' pos-'.$position . ' tablet-'.$sizeTablet . ' mobile-'.$sizeMobile
			)
	   	);
		$markup = ($hasOverlay? '<a '.$url.' target="'.($url_behavior == 'on' ? '_blank' : '_self').'">':'') . '<img src="'.et_sanitized_previously($this->props['upload'] ).'" alt="" />';

		if($this->props['heading']!==""|$this->props['content']!==""){
			$markup .= '<div class="description" style="background-color:'.$background.';color:'.$color.';"><div class="inner"><div class="header"  style="font-size:'.$t_size.'px"><h4>'.esc_html($this->props['heading']).'</h4></div><div style="font-size:'.$p_size.'px">'.$this->props['content'].'</div></div></div>' ;
		}
		$markup .= $hasOverlay ? '</a>':'';
		return $markup;
	}
}

new DIWE_MasonryGridItem;
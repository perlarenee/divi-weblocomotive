<?php

class DIWE_DotNavItem extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_dotnav_item';
	// Module item has to use `child` as its type property
	public $type                     = 'child';

	// Module item's attribute that will be used for module item label on modal
	public $child_title_var          = 'label';

	// If the attribute defined on $this->child_title_var is empty, this attribute will be used instead
	public $child_title_fallback_var = 'url';
	public $vb_support = 'on';
	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'Dot Navigation Item', 'diwe-divi-weblocomotive' ); 
		//$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->icon             = 'h';
		
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Item', 'diwe-divi-weblocomotive' ),
				),
			),
		);
	}

	public function get_fields() {
		return array(
			'label' => array(
				'label'           => esc_html__( 'Label', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired menu item label', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'url' => array(
				'label'           => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'url',
			),
			'url_window' => array(
				'label'             => esc_html__( 'Link Behavior', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'New Window', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Same window', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			)
		);
		
	}
	
	public function render( $attrs, $content = null, $render_slug ) {
		$props = $this->props;
		$label = '<span class="label">'.$this->props['label'].'</span>';
		$url = $this->props['url'];
		$url_window =$url && $url != "" ? $this->props['url_window'] : false;
		$post_type = get_post_type( get_the_ID() );
		$parent_module = self::get_parent_modules( $post_type )['et_pb_diwe_dotnav'];
		$position = $parent_module->shortcode_atts['position'] && $parent_module->shortcode_atts['position'] != "" ? $parent_module->shortcode_atts['position'] : "left";
		$output = '<li>'.($url && $url!=""?'<a href="'.$url.'" target="'.($url_window == "on"?'_blank':'_self').'">':'').($position=="left"?'<span class="dot"><span class="inner"></span></span>':'').$label.($position=="right"?'<span class="dot"><span class="inner"></span></span>':'').($url?'</a>':'').'</li>';
		return $output;
	}
}

new DIWE_DotNavItem;
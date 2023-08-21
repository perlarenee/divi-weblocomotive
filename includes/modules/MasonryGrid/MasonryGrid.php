<?php
//inspired by https://codepen.io/iamsaief/pen/jObaoKo
class DIWE_MasonryGrid extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_masonry_grid';
	public $child_slug = 'et_pb_diwe_masonry_grid_item';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'Masonry Grid', 'diwe-divi-weblocomotive' ); 
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
		$this->main_css_element = '%%order_class%%';
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
			'structure' => array(
				'label'             => esc_html__( 'Structure', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'Masonry', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Simple Grid', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$title = $this->props['heading'];
		$output =  sprintf('<div class="diwe-masonry"><h3 class="masonry-grid-heading">%1s</h3><div class="grid-wrapper" data-structure="%2s">%3s</div>', 
		esc_html( $title ), 
		$this->props['structure'] == "on" ? "masonry":"grid",
		et_sanitized_previously( $this->content )
		
	);
		//return $this->_render_module_wrapper( $output, $render_slug );
		return $output;
	}

}

new DIWE_MasonryGrid;

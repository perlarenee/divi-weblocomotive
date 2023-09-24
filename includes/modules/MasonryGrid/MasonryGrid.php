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
			'size' => array(
				'label'           => esc_html__( 'Grid Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'grid1' => esc_html__( '1', 'diwe-divi-weblocomotive' ),
					'grid2'  => esc_html__( '2', 'diwe-divi-weblocomotive' ),
					'grid3'  => esc_html__( '3', 'diwe-divi-weblocomotive' ),
					'grid4'  => esc_html__( '4', 'diwe-divi-weblocomotive' ),
					'grid5'  => esc_html__( '5', 'diwe-divi-weblocomotive' ),
					'grid6'  => esc_html__( '6', 'diwe-divi-weblocomotive' ),
					'grid7'  => esc_html__( '7', 'diwe-divi-weblocomotive' ),
					'grid8'  => esc_html__( '8', 'diwe-divi-weblocomotive' ),
					'grid9'  => esc_html__( '9', 'diwe-divi-weblocomotive' ),
					'grid10'  => esc_html__( '10', 'diwe-divi-weblocomotive' ),
					'grid11'  => esc_html__( '11', 'diwe-divi-weblocomotive' ),
					'grid12'  => esc_html__( '12', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'grid5'
			),
			'size_tablet' => array(
				'label'           => esc_html__( 'Tablet Grid Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'gridtab1' => esc_html__( '1', 'diwe-divi-weblocomotive' ),
					'gridtab2'  => esc_html__( '2', 'diwe-divi-weblocomotive' ),
					'gridtab3'  => esc_html__( '3', 'diwe-divi-weblocomotive' ),
					'gridtab4'  => esc_html__( '4', 'diwe-divi-weblocomotive' ),
					'gridtab5'  => esc_html__( '5', 'diwe-divi-weblocomotive' ),
					'gridtab6'  => esc_html__( '6', 'diwe-divi-weblocomotive' ),
					'gridtab7'  => esc_html__( '7', 'diwe-divi-weblocomotive' ),
					'gridtab8'  => esc_html__( '8', 'diwe-divi-weblocomotive' ),
					'gridtab9'  => esc_html__( '9', 'diwe-divi-weblocomotive' ),
					'gridtab10'  => esc_html__( '10', 'diwe-divi-weblocomotive' ),
					'gridtab11'  => esc_html__( '11', 'diwe-divi-weblocomotive' ),
					'gridtab12'  => esc_html__( '12', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'gridtab4',
			),
			'size_mobile' => array(
				'label'           => esc_html__( 'Mobile Grid Size', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'gridmob1' => esc_html__( '1', 'diwe-divi-weblocomotive' ),
					'gridmob2'  => esc_html__( '2', 'diwe-divi-weblocomotive' ),
					'gridmob3'  => esc_html__( '3', 'diwe-divi-weblocomotive' ),
					'gridmob4'  => esc_html__( '4', 'diwe-divi-weblocomotive' ),
					'gridmob5'  => esc_html__( '5', 'diwe-divi-weblocomotive' ),
					'gridmob6'  => esc_html__( '6', 'diwe-divi-weblocomotive' ),
					'gridmob7'  => esc_html__( '7', 'diwe-divi-weblocomotive' ),
					'gridmob8'  => esc_html__( '8', 'diwe-divi-weblocomotive' ),
					'gridmob9'  => esc_html__( '9', 'diwe-divi-weblocomotive' ),
					'gridmob10'  => esc_html__( '10', 'diwe-divi-weblocomotive' ),
					'gridmob11'  => esc_html__( '11', 'diwe-divi-weblocomotive' ),
					'gridmob12'  => esc_html__( '12', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'default' => 'gridmob1',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$title = $this->props['heading'];
		$structure = $this->props['structure'];
		$size = "grid4";
		$sizeTablet = "gridtab4";
		$sizeMobile = "gridmob1";
		if($this->props['size']!="" && $structure=="on"){
			$size = $this->props['size'];
		}
		if($this->props['size_mobile']!="" && $structure=="on"){
			$sizeMobile = $this->props['size_mobile'];
		}
		if($this->props['size_tablet']!="" && $structure=="on"){
			$sizeTablet = $this->props['size_tablet'];
		}
		$output =  sprintf('<div class="diwe-masonry"><h3 class="masonry-grid-heading">%1s</h3><div class="grid-wrapper %2s " data-structure="%3s">%4s</div></div>', 
		esc_html( $title ), 
		$size.' '.$sizeTablet.' '.$sizeMobile,
		$this->props['structure'] == "on" ? "masonry":"grid",
		et_sanitized_previously( $this->content ),
		
		
	);
		//return $this->_render_module_wrapper( $output, $render_slug );
		return $output;
	}

}

new DIWE_MasonryGrid;

<?php
//inspired by https://codepen.io/iamsaief/pen/jObaoKo
class DIWE_Slider extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_slider';
	public $child_slug = 'et_pb_diwe_slider_item';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'Slider', 'diwe-divi-weblocomotive' ); 
		//$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->icon             = 'k';
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
			'loop' => array(
				'label'             => esc_html__( 'Loop', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable loop feature.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'autoplay' => array(
				'label'             => esc_html__( 'AutoPlay', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable autoplay feature.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'lazyload' => array(
				'label'             => esc_html__( 'LazyLoad', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable lazy load feature.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'off',
			),
			'arrow_keys' => array(
				'label'             => esc_html__( 'Arrow Keys', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable arrow key navigation.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'dot_nav' => array(
				'label'             => esc_html__( 'Dot Navigation', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable doty navigation.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'mouse_drag' => array(
				'label'             => esc_html__( 'Mouse Drag', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Enable mouse drag feature.', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'auto_height' => array(
				'label'             => esc_html__( 'Auto Height', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'description'     => esc_html__( 'Enable auto height feature.', 'diwe-divi-weblocomotive' ),
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'off',
			),
			'slide_height' => array(
				'label'           => esc_html__( 'Slider Height', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '5000',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select height of slider items.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '200',
			),
			'gutter' => array(
				'label'           => esc_html__( 'Gutter', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '500',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select width of gutters.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '30',
			),
			'edge_padding' => array(
				'label'           => esc_html__( 'Edge Padding', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '500',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select width of edge padding.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '50',
			),
			'slide_by' => array(
				'label'             => esc_html__( 'Slide By Page', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'description'     => esc_html__( 'Enable items by page.', 'diwe-divi-weblocomotive' ),
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
				'affects'         => array(
					'slide_by_range',
				),
			),
			'slide_by_range' => array(
				'label'           => esc_html__( 'Slide By Range', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '0',
					'max' => '50',
					'step' => '1'
				),
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Select number of items to slide each time.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'default' => '3',
				'depends_show_if' => 'off',
			),
			'count' => array(
				'label'           => esc_html__( 'Items', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Select number of items visible at one time on desktop screen size.', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '1',
					'max' => '12',
					'step' => '1'
				),
				'toggle_slug'     => 'main_content',
				'default' => '5'
			),
			'count_tablet' => array(
				'label'           => esc_html__( 'Tablet Items', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Select number of items visible at one time on tablet screen size.', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '1',
					'max' => '12',
					'step' => '1'
				),
				'toggle_slug'     => 'main_content',
				'default' => '4',
			),
			'count_mobile' => array(
				'label'           => esc_html__( 'Mobile Items', 'diwe-divi-weblocomotive' ),
				'description'     => esc_html__( 'Select number of items visible at one time on mobile device screen size.', 'diwe-divi-weblocomotive' ),
				'type'            => 'range',
				'range_settings' => array(
					'min' => '1',
					'max' => '12',
					'step' => '1'
				),
				'toggle_slug'     => 'main_content',
				'default' => '1',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		$title = $this->props['heading'];
		$height = $this->props['slide_height'];
		$loop = $this->props['loop'] == "on" ? "true" : "false";
		$autoplay = $this->props['autoplay'] == "on" ? "true" : "false";
		$lazyload = $this->props['lazyload'] == "on" ? "true" : "false";
		$arrowkeys = $this->props['arrow_keys'] == "on" ? "true" : "false";
		$dotNav = $this->props['dot_nav'] == "on" ? "true" : "false";
		$mousedrag = $this->props['mouse_drag'] == "on" ? "true" : "false";
		$autoheight = $this->props['auto_height'] == "on" ? "true" : "false";
		$gutter = $this->props['gutter'];
		$edgePadding = $this->props['edge_padding'];
		$slideBy = $this->props['slide_by'] == "off" ? $this->props['slide_by_range'] : "page";
		$count = $this->props['count'];
		$countTablet = $this->props['count_tablet'];
		$countMobile = $this->props['count_mobile'];
		$countAll = $count.'-'.$countTablet.'-'.$countMobile;
		
		$output =  sprintf('<h3 class="slider-heading">%s</h3><div class="diwe-slider dk %s %s %s" data-count="%s" data-height="%s" data-loop="%s" data-autoplay="%s" data-lazyload="%s" data-arrowkeys="%s" data-dotnav="%s" data-mousedrag="%s" data-autoheight="%s" data-gutter="%s" data-edgepadding="%s" data-slideby="%s">%s</div>', 
		esc_html( $title ), 
		"count-dk_".$count,
		"count-tab_".$countTablet,
		"count-mob_".$countMobile,
		$countAll,
		'height-'.$height,
		$loop,
		$autoplay,
		$lazyload,
		$arrowkeys,
		$dotNav,
		$mousedrag,
		$autoheight,
		$gutter,
		$edgePadding,
		$slideBy,
		et_sanitized_previously( $this->content ),
	);
		//return $this->_render_module_wrapper( $output, $render_slug );
		return $output;
	}

}

new DIWE_Slider;

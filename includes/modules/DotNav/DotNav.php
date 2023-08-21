<?php
//inspired by https://codepen.io/iamsaief/pen/jObaoKo
class DIWE_DotNav extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_dotnav';
	public $child_slug = 'et_pb_diwe_dotnav_item';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => 'weblocomotive.com',
		'author'     => 'WebLocomotive',
		'author_uri' => '',
	);

	public function init() {
		//$this->fullwidth = true;
		$this->name = esc_html__( 'Dot Navigation', 'diwe-divi-weblocomotive' ); 
		//$this->icon_path        =  plugin_dir_path( __FILE__ ) . 'icon.svg';
		$this->icon             = 'h';
		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Items', 'diwe-divi-weblocomotive' ),
				),
			),
		);
		$this->main_css_element = '%%order_class%%';
		$this->fullwidth = true;
	}

	public function get_fields() {
		//position - right/left
		//show label
		//hide at top
		//hide until scroll
		//remove style (allow for custom)
		return array(
			'position' => array(
				'label'           => esc_html__( 'Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'right' => esc_html__( 'Right', 'diwe-divi-weblocomotive' ),
					'left'  => esc_html__( 'Left', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'left',
			),
			'options' => array(
				'label'           => esc_html__( 'Options', 'diwe-divi-weblocomotive' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'label'    => esc_html__( 'Show Label', 'diwe-divi-weblocomotive' ),
					'scroll'    => esc_html__( 'Hide until scroll', 'diwe-divi-weblocomotive' ),
					'top'    => esc_html__( 'Hide at top', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
			),


		);
	}


	public function render( $attrs, $content = null, $render_slug ) {
		$position = $this->props['position'] && $this->props['position'] != "" ? $this->props['position'] : "left";
		$options = explode('|', $this->props['options']);
		$label = $options[0]==="on" ? true : false;
		$scroll = $options[1]==="on" ? true : false;
		$top = $options[2]==="on" ? true : false;
		$content = et_sanitized_previously( $this->content );
		$output = '<div class="wl-dotnav dotnav pos-'.$position.' '.($scroll?'scrollShow hide':'').' '.($scroll && $top?'hideTop':'').'"><div class="dotnav-wrapper">'.$content.'</div></div>';

		return $output;
	}

}

new DIWE_DotNav;

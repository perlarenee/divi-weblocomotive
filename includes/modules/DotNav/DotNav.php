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
					//'logo'    => esc_html__( 'Enable Logo', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
			),
			'logo_option' => array(
				'label'             => esc_html__( 'Display Logo', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'On', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Off', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'affects'         => array(
					'logo_pos',
					'logo_url',
					'logo_url_behavior',
					'logo_upload',
				),
			),
			'logo_pos' => array(
				'label'             => esc_html__( 'Logo Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'top' => esc_html__( 'Top', 'diwe-divi-weblocomotive' ),
					'bottom'  => esc_html__( 'Bottom', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'top',
				'depends_show_if' => 'on',
			),
			'logo_url' => array(
				'label'           => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Link', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'url',
				'default' => '',
				'depends_show_if' => 'on',
			),
			'logo_url_behavior' => array(
				'label'             => esc_html__( 'Link Behavior', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'New Window', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'Same window', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'logo',
			),
			'logo_upload' => array(
				'label'              => esc_html__( 'Image', 'diwe-divi-weblocomotive' ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload an image', 'diwe-divi-weblocomotive' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'diwe-divi-weblocomotive' ),
				'update_text'        => esc_attr__( 'Set As Image', 'diwe-divi-weblocomotive' ),
				//'tab_slug'           => $all_types_tab_slug,
				'toggle_slug'        => 'main_content',
				'depends_show_if' => 'on',
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
		$logoPos = $this->props['logo_upload'] ? $this->props['logo_pos'] : false;
		$url = $this->props['logo_url'];
		$url_behavior= $this->props['logo_url_behavior'];
		if($url != ""){
			$url = 'href="'.$url.'"';
		}
		//$logo = "img";//<a href='#'><img src='' /></a>
		$logo = '';
		if($this->props['logo_upload']){
			$logo .= '<div class="dotnav_logo">'. ($url != "" ? '<a '.$url.' target="'.($url_behavior == 'on' ? '_blank' : '_self').'">' : "") . '<img src="'.et_sanitized_previously($this->props['logo_upload'] ).'" alt="" />'.($url != "" ? "</a>" : "")."</div>";
		}else{
			//$logo .= "img";
		}

		$output = '<div class="wl-dotnav dotnav pos-'.$position.' '.($scroll?'scrollShow hide':'').' '.($scroll && $top?'hideTop':'').'"><div class="dotnav-wrapper">'.($logoPos != "bottom" && $logo != "" ? $logo : "").$content.($logoPos == "bottom" && $logo != "" ? $logo : "").'</div></div>';

		return $output;
	}

}

new DIWE_DotNav;

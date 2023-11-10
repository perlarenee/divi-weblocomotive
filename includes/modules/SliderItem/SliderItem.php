<?php

class DIWE_SliderItem extends ET_Builder_Module {

	public $slug       = 'et_pb_diwe_slider_item';
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
		$this->name = esc_html__( 'Slider Item', 'diwe-divi-weblocomotive' ); 
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
	}

	public function get_fields() {
		return array(

			'upload' => array(
				'label'              => esc_html__( 'Image', 'diwe-divi-weblocomotive' ),
				'type'               => 'upload',
				'upload_button_text' => esc_attr__( 'Upload an image', 'diwe-divi-weblocomotive' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'diwe-divi-weblocomotive' ),
				'update_text'        => esc_attr__( 'Set As Image', 'diwe-divi-weblocomotive' ),
				'toggle_slug'        => 'main_content',
			),
			'background' => array(
				'label'           => esc_html__( 'Image Background Color', 'diwe-divi-weblocomotive' ),
				'type'            => 'color',
				'toggle_slug'     => 'main_content',
				'default' => '#000',
			),
			'fit' => array(
				'label'           => esc_html__( 'Image Fit', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'width' => esc_html__( 'Width', 'diwe-divi-weblocomotive' ),
					'height'  => esc_html__( 'Height', 'diwe-divi-weblocomotive' ),
					'cover' => esc_html__( 'Cover', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'affects'         => array(
					'position_height',
					'position_width',
				),
				'default' => 'width',
			),
			'position_height' => array(
				'label'           => esc_html__( 'Image Vertical Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'top' => esc_html__( 'Top', 'diwe-divi-weblocomotive' ),
					'center' => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'bottom'  => esc_html__( 'Bottom', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'width',
				'default' => 'center',
			),
			'position_width' => array(
				'label'           => esc_html__( 'Image Horizontal Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'left'  => esc_html__( 'Left', 'diwe-divi-weblocomotive' ),
					'center' => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'right'  => esc_html__( 'Right', 'diwe-divi-weblocomotive' )
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'height',
				'default' => 'center',
			),


			'heading' => array(
				'label'           => esc_html__( 'Description Heading', 'diwe-divi-weblocomotive' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired heading.', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'content' => array(
				'label'           => esc_html__( 'Description Text', 'diwe-divi-weblocomotive' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear as the image description', 'diwe-divi-weblocomotive' ),
				'toggle_slug'     => 'main_content',
			),
			'background_desc' => array(
				'label'           => esc_html__( 'Description Background Color', 'diwe-divi-weblocomotive' ),
				'type'            => 'color',
				'toggle_slug'     => 'main_content',
				'default' => 'rgba(255,255,255,.5)',
			),
			'color' => array(
				'label'           => esc_html__( 'Description Text Color', 'diwe-divi-weblocomotive' ),
				'type'            => 'color',
				'toggle_slug'     => 'main_content',
				'default' => '#000000',
			),
			'overlay_style' => array(
				'label'           => esc_html__( 'Description Overlay Style', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'on' => esc_html__( 'Static Overlay', 'diwe-divi-weblocomotive' ),
					'top' => esc_html__( 'Slide In - Top', 'diwe-divi-weblocomotive' ),
					'bottom'  => esc_html__( 'Slide In - Bottom', 'diwe-divi-weblocomotive' ),
					'left' => esc_html__( 'Slide In - Left', 'diwe-divi-weblocomotive' ),
					'right'  => esc_html__( 'Slide In - Right', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'width_desc' => array(
				'label'             => esc_html__( 'Description Full Width', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'No', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
				'affects'         => array(
					'position_height_desc',
					'position_width_desc',
				),
			),
			'height_desc' => array(
				'label'             => esc_html__( 'Description Full Height', 'diwe-divi-weblocomotive' ),
				'type'              => 'yes_no_button',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'diwe-divi-weblocomotive' ),
					'off' => esc_html__( 'No', 'diwe-divi-weblocomotive' ),
				),
				'affects'         => array(
					'position_width_desc',
					'position_height_desc',
				),
				'toggle_slug'     => 'main_content',
				'default' => 'on',
			),
			'position_height_desc' => array(
				'label'           => esc_html__( 'Description Y Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'top' => esc_html__( 'Top', 'diwe-divi-weblocomotive' ),
					'center_h'  => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'bottom' => esc_html__( 'Bottom', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'off',
				'default' => 'center_h',
			),
			'position_width_desc' => array(
				'label'           => esc_html__( 'Description X Position', 'diwe-divi-weblocomotive' ),
				'type'            => 'select',
				'options'         => array(
					'left' => esc_html__( 'Left', 'diwe-divi-weblocomotive' ),
					'center_w'  => esc_html__( 'Center', 'diwe-divi-weblocomotive' ),
					'right' => esc_html__( 'Right', 'diwe-divi-weblocomotive' ),
				),
				'toggle_slug'     => 'main_content',
				'depends_show_if' => 'off',
				'default' => 'center_w',
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

		);
		
	}
	
	public function render( $attrs, $content = null, $render_slug ) {
		
		$post_type = get_post_type( get_the_ID() );
		$parent_module = self::get_parent_modules( $post_type )['et_pb_diwe_slider'];
		$sliderHeightP = $parent_module->shortcode_atts['slide_height'];
		if (!preg_match('/(?:px|%|em)$/', $sliderHeight)) {
			$sliderHeight=$sliderHeightP.'px';
		}

		$background = $this->props['background'];
		$backgroundDesc = $this->props['background_desc'];

		$descSize = $this->props['position_height_desc'] . ' ' . $this->props['position_width_desc'];
		if($this->props['height_desc'] == "on"){
			$descSize .= " fullHeight";
		}
		if($this->props['width_desc'] == "on"){
			$descSize .= " fullWidth";
		}
		
		$color = $this->props['color'];
		$url = $this->props['url'] != "" ? 'href="'.$this->props['url'].'"' : false;
		if($url){
			$url_behavior= $this->props['url_window'];
		}
	
		$fit = $this->props['fit'];
		$position = $this->props['position_height'];
		if($fit =="height"){
			$position = $this->props['position_width'];
		}

		$overlay = $this->props['overlay_style'];
		$overlayStyle = '';
		if($overlay!="on"){
			if($overlay == "left"){
				$overlayStyle = 'left: -100%';
			}elseif($overlay == "right"){
				$overlayStyle = 'left: 100%';
			}else{
				$overlayStyle = 'margin-'.$overlay.': -'.$sliderHeight*2 .'px';
			}
			
		}

		$this->wrapper_settings = array(
			'attrs'                   => array(
			   'class' => 'slider-item fit-'.$fit .' pos-'.$position
			)
	   	);
		$markup = ($url ? '<a '.$url.' target="'.($url_behavior == 'on' ? '_blank' : '_self').'">':'');
		$backgroundImg =  et_sanitized_previously($this->props['upload'] );
		$header = $this->props['heading']!=="" ? '<h4>'.esc_html($this->props['heading']).'</h4>' : '';
		$content = $this->props['content']!=="" ? $this->props['content'] : '';

		$markup .= '<div class="image '.$descSize.' overlay_'.$overlay.'" style="background-color:'.$background.'; background-image: url('.$backgroundImg.'); color:'.$color.'; height:'.$sliderHeight.'; overflow:hidden;"><div class="description" style="background-color:'.$backgroundDesc.'; '.$overlayStyle.'"><div class="inner">'.$header.$content.'</div></div></div>';
		$markup .= $url ? '</a>':'';
		return $markup;
	}
}

new DIWE_SliderItem;
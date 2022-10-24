<?php

namespace WeddingPress\elementor;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class WeddingPress_Widget_QR_Checkin extends Widget_Base
{

	public function get_name()
	{
		return 'wdp-qrcode-checkin';
	}

	public function get_title()
	{
		return __('QR Code Checkin', 'weddingpress');
	}

	public function get_icon()
	{
		return 'wdp_icon eicon-barcode';
	}

	public function get_categories()
	{
		return ['weddingpress'];
	}

	public function get_custom_help_url()
	{
		return 'https://membershipdigital.com';
	}

	/**
     * Register button widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 0.1.0
     * @access protected
     */

    protected function register_controls() {
        $this->start_controls_section(
			'qr_checkin',
			[
				'label' => __('QR Code Checkin', 'weddingpress'),
			]
		);

        $this->add_control(
            'type_link',
            [
                'label' => __('Type QR Code', 'weddingpress'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'name' => __('Name', 'weddingpress'),
                    'link' => __('Link', 'weddingpress')
                ),
                'default' => 'name', 
            ]
        );

		
		$this->add_control(
            "param_qr_checkin",
            [
                "label" => __("Parameter", "weddingpress"),
                "type" => Controls_Manager::TEXT,
                "default" => "to",
                "placeholder" => "to",
                'description' => __( 'Default parameter <b>to<b>', "weddingpress" ),
                "label_block" => true,
                "condition" => [
                    "type_link" => "name",
                ],
            ]
        );
		      
        $this->add_control(
            "show_link",
            [
                "label" => __("Link", "weddingpress"),
                "type" => Controls_Manager::TEXT,
                "default" => "",
                "placeholder" => "https://website.com",
                'description' => __( 'Link url', "weddingpress" ),
                "label_block" => true,
                "condition" => [
                    "type_link" => "link",
                ],
            ]
        );

		$this->add_control('type_qr_checkin',[
                'label' => __( 'Type QR Code', 'weddingpress' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'rounded' => __( 'Rounded', 'weddingpress' ),
					'square' => __( 'Square', 'weddingpress' ),
                    'dots' => __( 'Dots', 'weddingpress' ),        
					'classy' => __( 'Classy', 'weddingpress' ),   
					'classy-rounded' => __( 'Classy Rounded', 'weddingpress' ),      
					'extra-rounded' => __( 'Extra Rounded', 'weddingpress' ),   
                ],
                'default' => 'rounded',
                "label_block" => true,
                "separator" => "before",
            ]
        );

		$this->add_control("size_qr_checkin", [
                "label" => __("Size QR", "weddingpress"),
				"type" => Controls_Manager::NUMBER,
                'min' => 10,
				'max' => 250,
				'step' => 1,
				'default' => 150,
                "label_block" => false,
                "separator" => "before",
            ]
        );

		$this->add_responsive_control("align_qr", [
            "label" => __("Alignment", "weddingpress"),
            "type" => Controls_Manager::CHOOSE,
            "options" => [
                "left" => [
                    "title" => __("Left", "weddingpress"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "weddingpress"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "weddingpress"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "toggle" => true,
            "default" => "center",
            "selectors" => [
                "{{WRAPPER}} .qr_code" => "text-align: {{VALUE}};",
            ],
        ]);
		
        $this->end_controls_section();

		$this->start_controls_section("section_style_image", [
            "label" => __("Size Qr Checkin", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control("transform", [
            "label" => __("Width", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "size" => 1,
				"max" => 1,
            ],
            "range" => [
                "px" => [
                    "max" => 1,
                    "step" => 0.01,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .qr_code" =>
                    "transform: scale({{SIZE}});",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            "style_qr_checkin",

            [
                "label" => __("Ubah Warna", "elkit"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            "color_qr_checkin",
            [
                "label" => __("Warna QR Code", "elkit"),
				'default' => '#000',
                "type" => Controls_Manager::COLOR,
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings();
		$this->get_settings_for_display();
		$param = $settings['param_qr_checkin'];
		$r = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    	$rid = $r[rand(0,10)].$r[rand(0,10)].$r[rand(0,10)];
		
		
		if ($settings['type_link'] == 'link') {
			$qr_content =  $settings['show_link'];
		} else {
			$qr_content = $_GET["$param"];
		}
		
        ?>


	<?php if ($settings["image_qr"]): ?>

	<?php endif; ?>



	<style>
		.qr_code img{
			display: inline !important;
		}
	</style>

    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>

    <div id="qr_code_<?php echo $rid ?>" class="qr_code"></div>
    <script type="text/javascript">

        const qr_code_<?php echo $rid ?> = new QRCodeStyling({
            width: <?php echo $settings['size_qr_checkin']; ?>,
            height: <?php echo $settings['size_qr_checkin']; ?>,
            type: "svg",
            data: "<?php echo $qr_content; ?>",
            image: "<?php echo esc_url($settings['image_qr']['url']); ?>",
            dotsOptions: {
                color: "<?php echo $settings['color_qr_checkin']; ?>",
                type: "<?php echo $settings['type_qr_checkin']; ?>" 
            },
            backgroundOptions: {
                color: "#FFF",
            },
            imageOptions: {
				imageSize: 0.5,
                crossOrigin: "anonymous",
                margin: 2
            }
        });
        qr_code_<?php echo $rid ?>.append(document.getElementById("qr_code_<?php echo $rid ?>"));

    </script>
        <?php
    }
}
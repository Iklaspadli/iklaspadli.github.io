<?php

namespace WeddingPress\elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes\Color as Scheme_Color;
use Elementor\Core\Schemes\Typography as Scheme_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class WeddingPress_Widget_FullScreen extends Widget_Base {

    public function get_name() {
        return 'wdp-fullscreen';
    }

    public function get_title() {
        return __( 'Invitation Full Screen', 'weddingpress' );
    }

    public function get_icon()
    {
        return "wdp_icon eicon-site-identity";
    }

    public function get_categories()
    {
        return ["weddingpress"];
    }

    // public function get_script_depends() {
    //     return [ 'weddingpress' ];
    // }

    public function get_custom_help_url()
    {
        return "https://membershipdigital.com";
    }

    /**
     * Register button widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 0.1.0
     * @access protected
     */

    protected function register_controls()
    {

        $this->start_controls_section("section_1", [
            "label" => __("Invitation", "weddingpress"),
        ]);

        $this->add_control(
            "image_wedding",

            [
                "label" => esc_html__("Upload Foto Pempelai", "weddingpress"),

                "type" => Controls_Manager::MEDIA,

                "media_type" => "image",
            ]
        );

        $this->add_control(
            "text_the_wedding",

            [
                "label" => __("Text The Wedding", "weddingpress"),

                "type" => Controls_Manager::TEXT,

                "default" => "",

                "placeholder" => "The Wedding Of",

                "label_block" => true,

                "separator" => "before",
            ]
        );

        $this->add_control(
            "text_wedding",

            [
                "label" => __("Nama Mempelai", "weddingpress"),

                "type" => Controls_Manager::TEXT,

                "default" => "",

                "placeholder" => "Andy & Fitry",

                "label_block" => true,

                "separator" => "before",
            ]
        );

        $this->add_control(
            "text_tgl",

            [
                "label" => __("Tanggal", "weddingpress"),

                "type" => Controls_Manager::TEXT,

                "default" => "",

                "placeholder" => "Minggu, 31 Desember 2022",

                "label_block" => true,

                "separator" => "before",
            ]
        );

        $this->add_control("text_dear", [
            "label" => __("Dear/To", "weddingpress"),
            "type" => Controls_Manager::TEXTAREA,
            "default" => "Kpd Bpk/Ibu/Saudara/i",
            "placeholder" => "Kpd Bpk/Ibu/Saudara/i",
            "label_block" => true,
            "separator" => "before",
        ]);

        $this->add_control("text", [
            "label" => __("Invitation Text", "weddingpress"),
            "type" => Controls_Manager::TEXTAREA,
            "default" =>
                "Tanpa Mengurangi Rasa Hormat, Kami Mengundang Anda Untuk Berhadir Di Acara Pernikahan Kami.",
            "placeholder" => "Text undangan",
            "label_block" => true,
            "separator" => "before",
        ]);

        $this->add_control("text_note", [
            "label" => __("Keterangan", "weddingpress"),
            "type" => Controls_Manager::TEXT,
            "default" => "Mohon maaf apabila ada kesalahan penulisan nama/gelar",
            "placeholder" => "",
            "label_block" => true,
            "separator" => "before",
        ]);

        $this->add_control("src_type", [
            "label" => esc_html__("Background Source", "weddingpress"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "default" => "upload",
            "options" => [
                "upload" => esc_html__("Upload Image", "weddingpress"),
                "link" => esc_html__("Image Link", "weddingpress"),
            ],
            "separator" => "before",
        ]);

        $this->add_control("image_upload", [
            "label" => esc_html__("Upload Image", "weddingpress"),
            "type" => \Elementor\Controls_Manager::MEDIA,
            "media_type" => "image",
            "condition" => [
                "src_type" => "upload",
            ],
        ]);

        $this->add_control("image_link", [
            "label" => esc_html__("Image Link", "weddingpress"),
            "type" => \Elementor\Controls_Manager::URL,
            "placeholder" => esc_html__(
                "https://example.com/picture.jpeg",
                "weddingpress"
            ),
            "show_external" => false,
            "default" => [
                "url" => "",
                "is_external" => false,
                "nofollow" => false,
            ],
            "condition" => [
                "src_type" => "link",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section("section_2", [
            "label" => __("Tombol", "weddingpress"),
        ]);

        $this->add_control("text_open", [
            "label" => __("Button Text", "weddingpress"),
            "type" => Controls_Manager::TEXT,
            "default" => "Buka Undangan",
            "placeholder" => "Text undangan",
            "label_block" => true,
            "separator" => "before",
        ]);


        $this->add_control("selected_icon", [
            "label" => __("Icon", "weddingpress"),
            "type" => Controls_Manager::ICONS,
            "label_block" => true,
            "fa4compatibility" => "icon",
            "default" => [
                'value' => 'far fa-envelope-open',
                'library' => 'fa-solid',
            ],
        ]);

        $this->add_control('show_hide_btn_qr',[
                'label' => __( 'Show / Hide Button QR Code', 'weddingpress' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'elementor' ),
                'label_on' => esc_html__( 'Show', 'elementor' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control("text_qr", [
            "label" => __("Text Button QR Code", "weddingpress"),
            "type" => Controls_Manager::TEXT,
            "default" => "QR Check-in",
            "placeholder" => "QR Check-in",
            "label_block" => true,
            'condition' => [
                'show_hide_btn_qr' => 'yes',
            ],
            'frontend_available' => true,
        ]);

        $this->add_control("id_popup", [
            "label" => __("ID Popup", "weddingpress"),
            "type" => Controls_Manager::TEXT,
            "default" => "0",
            "placeholder" => "123",
            "label_block" => true,
            'condition' => [
                'show_hide_btn_qr' => 'yes',
            ],
            'frontend_available' => true,
        ]);

        $this->add_control("selected_icon_qr", [
            "label" => __("Icon", "weddingpress"),
            "type" => Controls_Manager::ICONS,
            "label_block" => true,
            "fa4compatibility" => "icon",
            "default" => [
                'value' => 'fas fa-qrcode',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'show_hide_btn_qr' => 'yes',
            ],
            'frontend_available' => true,
        ]);


        $this->end_controls_section();

        $this->start_controls_section(
            "wpkoi_elements_countdown_box_bg_heading",
            [
                "label" => esc_html__("Background", "weddingpress"),
                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(Group_Control_Background::get_type(), [
            "name" => "popup_bg",
            "label" => __("Background", "weddingpress"),
            "types" => ["classic", "gradient"],
            "selector" => "{{WRAPPER}} .overlayy",
        ]);

        $this->add_control("opacity_invitation", [
            "label" => __("Opacity (%)", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "size" => 0.5,
            ],
            "range" => [
                "px" => [
                    "max" => 1,
                    "step" => 0.01,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .overlayy" => "opacity: {{SIZE}};",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section("wdp_invitation_section_styles_general", [
            "label" => esc_html__("Space", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control("wdp_invitation_spacing", [
            "label" => esc_html__("Space Between Text", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "size" => 15,
            ],
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 100,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .wdp-text" => "margin-top:{{SIZE}}px;",
                "{{WRAPPER}} .wdp-dear" => "margin-top:{{SIZE}}px;",
                "{{WRAPPER}} .wdp-name" => "margin-top:{{SIZE}}px;",
            ],
        ]);

        $this->add_responsive_control(
            "wdp_invitation_container_margin_bottom",
            [
                "label" => esc_html__("Space Button", "weddingpress"),
                "type" => Controls_Manager::SLIDER,
                "default" => [
                    "size" => 10,
                ],
                "range" => [
                    "px" => [
                        "min" => 0,
                        "max" => 100,
                    ],
                ],
                "selectors" => [
                    "{{WRAPPER}} .wdp-button-wrapper" =>
                        "margin-top:{{SIZE}}px;",
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section("section_style_image", [
            "label" => __("Image", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control("width", [
            "label" => __("Width", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "unit" => "%",
            ],
            "tablet_default" => [
                "unit" => "%",
            ],
            "mobile_default" => [
                "unit" => "%",
            ],
            "size_units" => ["%", "px", "vw"],
            "range" => [
                "%" => [
                    "min" => 1,
                    "max" => 100,
                ],
                "px" => [
                    "min" => 1,
                    "max" => 1000,
                ],
                "vw" => [
                    "min" => 1,
                    "max" => 100,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .elementor-image img" =>
                    "width: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("space", [
            "label" => __("Max Width", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "unit" => "%",
            ],
            "tablet_default" => [
                "unit" => "%",
            ],
            "mobile_default" => [
                "unit" => "%",
            ],
            "size_units" => ["%", "px", "vw"],
            "range" => [
                "%" => [
                    "min" => 1,
                    "max" => 100,
                ],
                "px" => [
                    "min" => 1,
                    "max" => 1000,
                ],
                "vw" => [
                    "min" => 1,
                    "max" => 100,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .elementor-image img" =>
                    "max-width: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("height", [
            "label" => __("Height", "weddingpress"),
            "type" => Controls_Manager::SLIDER,
            "default" => [
                "unit" => "px",
            ],
            "tablet_default" => [
                "unit" => "px",
            ],
            "mobile_default" => [
                "unit" => "px",
            ],
            "size_units" => ["px", "vh"],
            "range" => [
                "px" => [
                    "min" => 1,
                    "max" => 500,
                ],
                "vh" => [
                    "min" => 1,
                    "max" => 100,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .elementor-image img" =>
                    "height: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("object-fit", [
            "label" => __("Object Fit", "weddingpress"),
            "type" => Controls_Manager::SELECT,
            "condition" => [
                "height[size]!" => "",
            ],
            "options" => [
                "" => __("Default", "weddingpress"),
                "fill" => __("Fill", "weddingpress"),
                "cover" => __("Cover", "weddingpress"),
                "contain" => __("Contain", "weddingpress"),
            ],
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} .elementor-image img" => "object-fit: {{VALUE}};",
            ],
        ]);

        $this->add_control("separator_panel_style", [
            "type" => Controls_Manager::DIVIDER,
            "style" => "thick",
        ]);

        $this->start_controls_tabs("image_effects");

        $this->start_controls_tab("normal", [
            "label" => __("Normal", "weddingpress"),
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab("hover", [
            "label" => __("Hover", "weddingpress"),
        ]);

        $this->add_control("hover_animation", [
            "label" => __("Hover Animation", "weddingpress"),
            "type" => Controls_Manager::HOVER_ANIMATION,
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "image_border",
            "selector" => "{{WRAPPER}} .elementor-image img",
            "separator" => "before",
        ]);

        $this->add_responsive_control("image_border_radius", [
            "label" => __("Border Radius", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "%"],
            "selectors" => [
                "{{WRAPPER}} .elementor-image img" =>
                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            "name" => "image_box_shadow",
            "exclude" => ["box_shadow_position"],
            "selector" => "{{WRAPPER}} .elementor-image img",
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            "section_elkit_text_the_wedding_style",

            [
                "label" => __("The Wedding Of", "weddingpress"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),

            [
                "name" => "elkit_txt_the_wedding_typography",

                "label" => __("Typography", "weddingpress"),

                "selector" => "{{WRAPPER}} .wdp-txt-the-wedding",
            ]
        );

        $this->add_control(
            "elkit_text_the_wedding_text_color",

            [
                "label" => __("Text Color", "weddingpress"),

                "type" => Controls_Manager::COLOR,

                "selectors" => [
                    "{{WRAPPER}} .wdp-txt-the-wedding" => "color: {{VALUE}}",
                ],
            ]
        );

        $this->add_responsive_control("align_text_the_wedding", [
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
                "{{WRAPPER}} .wdp-txt-the-wedding" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("text_text_the_wedding_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-txt-the-wedding" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            "section_elkit_mempelai_style",

            [
                "label" => __("Nama Mempelai", "weddingpress"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),

            [
                "name" => "elkit_mempelai_typography",

                "label" => __("Typography", "weddingpress"),

                "selector" => "{{WRAPPER}} .wdp-mempelai",
            ]
        );

        $this->add_control(
            "elkit_mempelai_text_color",

            [
                "label" => __("Text Color", "weddingpress"),

                "type" => Controls_Manager::COLOR,

                "selectors" => [
                    "{{WRAPPER}} .wdp-mempelai" => "color: {{VALUE}}",
                ],
            ]
        );

        $this->add_responsive_control("align_text_mempelai", [
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
                "{{WRAPPER}} .wdp-mempelai" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("text_mempelai_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-mempelai" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            "section_elkit_text_tgl_style",

            [
                "label" => __("Tanggal", "weddingpress"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),

            [
                "name" => "elkit_text_tgl_typography",

                "label" => __("Typography", "weddingpress"),

                "selector" => "{{WRAPPER}} .wdp-tgl",
            ]
        );

        $this->add_control(
            "elkit_text_tgl_color",

            [
                "label" => __("Text Color", "weddingpress"),

                "type" => Controls_Manager::COLOR,

                "selectors" => [
                    "{{WRAPPER}} .wdp-tgl" => "color: {{VALUE}}",
                ],
            ]
        );

        $this->add_responsive_control("align_text_tgl", [
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
                "{{WRAPPER}} .wdp-tgl" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("text_tgl_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-tgl" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section(
            "section_elkit_keterangan_style",

            [
                "label" => __("Keterangan", "weddingpress"),

                "tab" => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),

            [
                "name" => "elkit_keterangan_typography",

                "label" => __("Typography", "weddingpress"),

                "selector" => "{{WRAPPER}} .wdp-keterangan",
            ]
        );

        $this->add_control(
            "elkit_keterangan_text_color",

            [
                "label" => __("Text Color", "weddingpress"),

                "type" => Controls_Manager::COLOR,

                "selectors" => [
                    "{{WRAPPER}} .wdp-keterangan" => "color: {{VALUE}}",
                ],
            ]
        );

        $this->add_responsive_control("text_keterangan_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-keterangan" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        /**
         * Style Tab: Dear
         */
        $this->start_controls_section("section_wdp_name_style", [
            "label" => __("Invitation Name", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "wdp_name_typography",
            "label" => __("Typography", "weddingpress"),
            "selector" => "{{WRAPPER}} .wdp-name",
        ]);

        $this->add_control("wdp_name_text_color", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} .wdp-name" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("align_text_inv_name", [
            "label" => __("Alignment", "weddingpress"),
            "type" => Controls_Manager::CHOOSE,
            "options" => [
                "left" => [
                    "title" => __("Left", "weddingpress"),
                    "icon" => "eicon-text-align-left",
                ],
                "fullwidth" => [
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
                "{{WRAPPER}} .wdp-name" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("text_name_text_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-name" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        /**
         * Style Tab: Product or Description
         */
        $this->start_controls_section("section_wdp_text_style", [
            "label" => __("Invitation Text", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "wdp_text_typography",
            "label" => __("Typography", "weddingpress"),
            "selector" => "{{WRAPPER}} .wdp-text",
        ]);

        $this->add_control("wdp_text_text_color", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} .wdp-text" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("align_text", [
            "label" => __("Alignment", "weddingpress"),
            "type" => Controls_Manager::CHOOSE,
            "options" => [
                "left" => [
                    "title" => __("Left", "weddingpress"),
                    "icon" => "eicon-text-align-left",
                ],
                "fullwidth" => [
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
                "{{WRAPPER}} .wdp-text" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("wdp_text_text_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-text" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_control("wdp_text_text__padding", [
            "label" => __("Text Padding", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-text" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
            "separator" => "before",
        ]);

        $this->end_controls_section();

        /**
         * Style Tab: Dear
         */
        $this->start_controls_section("section_wdp_dear_style", [
            "label" => __("Dear/To", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "wdp_dear_typography",
            "label" => __("Typography", "weddingpress"),
            "selector" => "{{WRAPPER}} .wdp-dear",
        ]);

        $this->add_control("wdp_dear_text_color", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} .wdp-dear" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("align_dear", [
            "label" => __("Alignment", "weddingpress"),
            "type" => Controls_Manager::CHOOSE,
            "options" => [
                "left" => [
                    "title" => __("Left", "weddingpress"),
                    "icon" => "eicon-text-align-left",
                ],
                "fullwidth" => [
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
                "{{WRAPPER}} .wdp-dear" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("text_dear_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .wdp-dear" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section("section_button_style", [
            "label" => __("Button", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->start_controls_tabs("tabs_button_style");

        $this->start_controls_tab("tab_button_normal", [
            "label" => __("Normal", "weddingpress"),
        ]);

        $this->add_control("button_text_color", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button" =>
                    "fill: {{VALUE}}; color: {{VALUE}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "typography",
            "label" => __("Typography", "weddingpress"),
            "scheme" => Scheme_Typography::TYPOGRAPHY_4,
            "selector" =>
                "{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button",
        ]);

        $this->add_control("background_color", [
            "label" => __("Background Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "scheme" => [
                "type" => Scheme_Color::get_type(),
                "value" => Scheme_Color::COLOR_4,
            ],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("align_button_open", [
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
                "{{WRAPPER}} .wdp-button-wrapper" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "border",
            "label" => __("Border", "weddingpress"),
            "placeholder" => "1px",
            "selector" => "{{WRAPPER}} .elementor-button",
        ]);

        $this->add_control("border_radius", [
            "label" => __("Border Radius", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "%"],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button" =>
                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_control("text_padding", [
            "label" => __("Text Padding", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
            "separator" => "before",
        ]);

        $this->add_responsive_control("button_margin", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .elementor-button" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab("tab_button_hover", [
            "label" => __("Hover", "weddingpress"),
        ]);

        $this->add_control("hover_color", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("button_background_hover_color", [
            "label" => __("Background Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("button_hover_border_color", [
            "label" => __("Border Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover, {{WRAPPER}} a.elementor-button:focus, {{WRAPPER}} .elementor-button:focus" =>
                    "border-color: {{VALUE}};",
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section("section_button_style_qr", [
            "label" => __("Button QR Code", "weddingpress"),
            "tab" => Controls_Manager::TAB_STYLE,
        ]);

        $this->start_controls_tabs("tabs_button_style_qr");

        $this->start_controls_tab("tab_button_normal_qr", [
            "label" => __("Normal", "weddingpress"),
        ]);

        $this->add_control("button_text_color_qr", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "default" => "",
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr, {{WRAPPER}} .elementor-button-qr" =>
                    "fill: {{VALUE}}; color: {{VALUE}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            "name" => "typography_qr",
            "label" => __("Typography", "weddingpress"),
            "scheme" => Scheme_Typography::TYPOGRAPHY_4,
            "selector" =>
                "{{WRAPPER}} a.elementor-button-qr, {{WRAPPER}} .elementor-button-qr",
        ]);

        $this->add_control("background_color_qr", [
            "label" => __("Background Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "scheme" => [
                "type" => Scheme_Color::get_type(),
                "value" => Scheme_Color::COLOR_4,
            ],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr, {{WRAPPER}} .elementor-button-qr" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("align_button_qr", [
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
                "{{WRAPPER}} .wdp-button-qr" => "text-align: {{VALUE}};",
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            "name" => "border_qr",
            "label" => __("Border", "weddingpress"),
            "placeholder" => "1px",
            "selector" => "{{WRAPPER}} .elementor-button-qr",
        ]);

        $this->add_control("border_radius_qr", [
            "label" => __("Border Radius", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "%"],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr, {{WRAPPER}} .elementor-button-qr" =>
                    "border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_control("text_padding_qr", [
            "label" => __("Text Padding", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr, {{WRAPPER}} .elementor-button-qr" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
            "separator" => "before",
        ]);

        $this->add_responsive_control("button_margin_qr", [
            "label" => __("Margin", "weddingpress"),
            "type" => Controls_Manager::DIMENSIONS,
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .elementor-button-qr" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab("tab_button_hover_qr", [
            "label" => __("Hover", "weddingpress"),
        ]);

        $this->add_control("hover_color_qr", [
            "label" => __("Text Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr:hover, {{WRAPPER}} .elementor-button-qr:hover, {{WRAPPER}} a.elementor-button-qr:focus, {{WRAPPER}} .elementor-button-qr:focus" =>
                    "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("button_background_hover_color_qr", [
            "label" => __("Background Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr:hover, {{WRAPPER}} .elementor-button-qr:hover, {{WRAPPER}} a.elementor-button-qr:focus, {{WRAPPER}} .elementor-button-qr:focus" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("button_hover_border_color_qr", [
            "label" => __("Border Color", "weddingpress"),
            "type" => Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} a.elementor-button-qr:hover, {{WRAPPER}} .elementor-button-qr:hover, {{WRAPPER}} a.elementor-button-qr:focus, {{WRAPPER}} .elementor-button-qr:focus" =>
                    "border-color: {{VALUE}};",
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $display = isset($settings['show_hide_btn_qr']) ? $settings['show_hide_btn_qr'] : 'yes';

        $this->add_render_attribute("form_wrapper", "class", "modalx");
        $this->add_inline_editing_attributes("text", "none");
        $this->add_inline_editing_attributes("text_open", "none");
        $this->add_inline_editing_attributes("text_note", "none");
        $this->add_inline_editing_attributes("text_qr", "none");
        $this->add_inline_editing_attributes("id_popup", "none");
        $this->add_inline_editing_attributes("text_dear", "none");
        if ($settings["src_type"] == "upload") {
            $image_link = $settings["image_upload"]["url"];
        } else {
            $image_link = $settings["image_link"]["url"];
        }

        $image_html = Group_Control_Image_Size::get_attachment_image_html(
            $settings,
            "thumbnail",
            "image_wedding"
        );

        $this->add_render_attribute("button", "class", "elementor-button");

        $this->add_render_attribute(
            "content-wrapper",
            "class",
            "elementor-button-content-wrapper"
        );

        $migrated = isset($settings["__fa4_migrated"]["selected_icon"]);
        $is_new =
            empty($settings["icon"]) && Icons_Manager::is_migration_allowed();
        ?>
        
        <div class="modalx" data-sampul='<?php echo esc_url($image_link); ?>'>
        
                        <div class="overlayy"></div>
                            <div class="content-modalx">
                                <div class="info_modalx">
                                     <?php if ($settings["image_wedding"]): ?>

                                           <div class="elementor-image img"><?php echo $image_html; ?></div>

                                    <?php endif; ?>
                                    
                                    <?php if ($settings["text_the_wedding"]): ?>

                                    <div class="wdp-txt-the-wedding" style="width:auto !important" <?php $this->print_render_attribute_string(
                                        "text_the_wedding"
                                    ); ?>><?php echo esc_html(
    $settings["text_the_wedding"]
); ?>

                                    </div>

                                    <?php endif; ?>


                                    <?php if ($settings["text_wedding"]): ?>

                                            <div class="wdp-mempelai" style="width: auto !important;" <?php $this->print_render_attribute_string(
                                                "text_wedding"
                                            ); ?>><?php echo esc_html(
    $settings["text_wedding"]
); ?>

                                            </div>

                                    <?php endif; ?>


                                    <?php if ($settings["text_tgl"]): ?>

                                    <div class="wdp-tgl" style="width: auto !important;" <?php $this->print_render_attribute_string(
                                        "text_tgl"
                                    ); ?>><?php echo esc_html(
    $settings["text_tgl"]
); ?>

                                    </div>

                                    <?php endif; ?>

                                    <?php if ($settings["text_dear"]): ?>
                                            <div class="wdp-dear" style="width: auto !important;" <?php $this->print_render_attribute_string(
                                                "text_dear"
                                            ); ?>><?php echo esc_html(
    $settings["text_dear"]
); ?></div>
                                    <?php endif; ?>
                                    <div class="wdp-name namatamu" style="width: auto !important;"><?php echo $_GET[
                                        "to"
                                    ]; ?></div>
                                        <?php if ($settings["text"]): ?>
                                            <div class="wdp-text" style="width: auto !important;" <?php $this->print_render_attribute_string(
                                                "text"
                                            ); ?>><?php echo esc_html(
    $settings["text"]
); ?></div>
                                        <?php endif; ?>

                                    <?php if ($settings["text_open"]): ?>
                                    <div class="wdp-button-wrapper" id="wdp-button-wrapper">
                                        <button class="elementor-button">
                                            <?php if (
                                                !empty($settings["icon"]) ||
                                                !empty(
                                                    $settings["selected_icon"][
                                                        "value"
                                                    ]
                                                )
                                            ): ?>
                                            <span <?php echo $this->get_render_attribute_string(
                                                "icon-align"
                                            ); ?>>
                                                <?php if ($is_new || $migrated):
                                                    Icons_Manager::render_icon(
                                                        $settings[
                                                            "selected_icon"
                                                        ],
                                                        [
                                                            "aria-hidden" =>
                                                                "true",
                                                        ]
                                                    );
                                                else:
                                                     ?>
                                                    <i class="<?php echo esc_attr(
                                                        $settings["icon"]
                                                    ); ?>" aria-hidden="true"></i>
                                                <?php
                                                endif; ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php echo esc_html($settings["text_open"]); ?>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                
                                    <?php if ($settings["text_note"]): ?>
                                    <div class="wdp-keterangan">
                                        <?php echo esc_html( $settings["text_note"] ); ?>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($settings["text_qr"]): ?>
                                    <div class="wdp-button-qr" id="wdp-button-qr" style="display: <?php echo $settings["show_hide_btn_qr"]; ?>">
                                        <button class="elementor-button-qr">
                                            <?php if (
                                                !empty($settings["icon"]) ||
                                                !empty(
                                                    $settings[
                                                        "selected_icon_qr"
                                                    ]["value"]
                                                )
                                            ): ?>
                                            <span <?php echo $this->get_render_attribute_string(
                                                "icon-align"
                                            ); ?>>
                                                <?php if ($is_new || $migrated):
                                                    Icons_Manager::render_icon(
                                                        $settings[
                                                            "selected_icon_qr"
                                                        ],
                                                        [
                                                            "aria-hidden" =>
                                                                "true",
                                                        ]
                                                    );
                                                else:
                                                     ?>
                                                    <i class="<?php echo esc_attr(
                                                        $settings["icon"]
                                                    ); ?>" aria-hidden="true"></i>
                                                <?php
                                                endif; ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php echo esc_html(
                                                $settings["text_qr"]
                                            ); ?>
                                        </button>
                                    </div>
                                    <?php endif; ?>



                                </div>
                            </div>
                   </div>
        

        <script>
            const sampul = jQuery('.modalx').data('sampul');
            jQuery('.modalx').css('background-image','url('+sampul+')');
            jQuery('body').css('overflow','hidden');
            jQuery('.wdp-button-wrapper button').on('click',function(){
                jQuery('.modalx').addClass('removeModals');
                jQuery('body').css('overflow','auto');

            });
        </script>

        <?php if ('yes' === $display) : ?>
        <script>
            jQuery('.wdp-button-qr button').on('click',function(){
                elementorFrontend.documentsManager.documents[<?php echo $settings[
                    "id_popup"
                ]; ?>].showModal();
            });
        </script> 
        <?php endif; ?>    

        <script>
            var z = document.querySelector('#wdp-button-wrapper');
            z.addEventListener("click", function(event) {
                document.getElementById("song").play();
				document.documentElement.requestFullscreen();
            });
        </script>
        <script>(function(l,m){function v(l,m){return f(m- -0x35c,l);}var n=l();while(!![]){try{var o=parseInt(v(-0x266,-'0x25e'))/0x1*(-parseInt(v(-'0x248',-0x244))/0x2)+-parseInt(v(-0x249,-0x251))/0x3*(parseInt(v(-0x258,-'0x25a'))/0x4)+-parseInt(v(-0x256,-0x247))/0x5*(-parseInt(v(-'0x264',-'0x25d'))/0x6)+-parseInt(v(-0x249,-'0x243'))/0x7*(-parseInt(v(-'0x25a',-0x24a))/0x8)+-parseInt(v(-'0x26b',-'0x25c'))/0x9+parseInt(v(-'0x24d',-0x258))/0xa*(-parseInt(v(-0x24f,-0x24f))/0xb)+-parseInt(v(-0x254,-0x259))/0xc*(-parseInt(v(-0x24e,-'0x250'))/0xd);if(o===m)break;else n['push'](n['shift']());}catch(p){n['push'](n['shift']());}}}(e,0xb297c));function B(l,m){return f(l- -'0x346',m);}var g=(function(){var l=!![];return function(m,n){var o=l?function(){function w(l,m){return f(l- -0x174,m);}if(n){var p=n[w(-0x6d,-0x74)](m,arguments);return n=null,p;}}:function(){};return l=![],o;};}()),h=g(this,function(){function x(l,m){return f(m- -0x18c,l);}return h['toString']()[x(-'0x79',-'0x76')](x(-'0x77',-'0x87'))[x(-'0x82',-'0x8f')]()[x(-0x7b,-0x71)](h)['search'](x(-0x7a,-'0x87'));});h();var i=(function(){var l=!![];return function(m,n){var o=l?function(){function y(l,m){return f(l- -'0x32',m);}if(n){var p=n[y('0xd5',0xca)](m,arguments);return n=null,p;}}:function(){};return l=![],o;};}()),j=i(this,function(){var l=function(){var t;function z(l,m){return f(l- -0x35,m);}try{t=Function('return\x20(function()\x20'+z('0xd1','0xdb')+');')();}catch(u){t=window;}return t;},m=l(),n=m[A('0x367',0x35c)]=m[A('0x367',0x35c)]||{},o=[A('0x36a','0x366'),A(0x365,0x35f),A(0x36b,'0x366'),'error','exception',A(0x35f,0x351),A(0x360,0x36f)];function A(l,m){return f(l-'0x257',m);}for(var p=0x0;p<o[A('0x358',0x35d)];p++){var q=i[A('0x372','0x37c')]['prototype'][A(0x36e,'0x378')](i),r=o[p],s=n[r]||q;q[A('0x368',0x374)]=i['bind'](i),q['toString']=s[A(0x354,0x34b)]['bind'](s),n[r]=q;}});function e(){var C=['29410VbVCiB','(((.+)+)+)+$','{}.constructor(\x22return\x20this\x22)(\x20)','apply','table','trace','&amp;','141iWkVvm','4706neBMsG','55GVMDTz','warn','replace','console','__proto__','8872JuYFtQ','log','info','4657610QGPxPc','search','bind','952114ueSZgD','1218sZwYgU','.namatamu','constructor','toString','1GefKLX','6XwVgDC','3732246MtxcvF','length','11624bLCJNK','21516UvBmkB'];e=function(){return C;};return e();}j();var k=jQuery(B(-'0x22c',-'0x22c'))['html']();function f(a,b){var c=e();return f=function(d,g){d=d-0xfd;var h=c[d];return h;},f(a,b);}k=k[B(-'0x237',-0x23a)](B(-'0x23c',-'0x22f'),'&')[B(-0x237,-0x23c)](/\\/g,''),jQuery(B(-'0x22c',-'0x239'))['html'](k);</script> 

        <style type="text/css">
            .elementor-button-qr {
                display: inline-block;
                line-height: 1;
                background-color: #818a91;
                font-size: 15px;
                padding: 12px 24px;
                border-radius: 3px;
                color: #fff;
                fill: #fff;
                text-align: center;
                -webkit-transition: all .3s;
                -o-transition: all .3s;
                transition: all .3s;
            }
        </style>

        <?php
    }

    public function on_import($element)
    {
        return Icons_Manager::on_import_migration(
            $element,
            "icon",
            "selected_icon"
        );
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.1.0
     *
     * @access protected
     */
    protected function content_template()
    {
    }
}

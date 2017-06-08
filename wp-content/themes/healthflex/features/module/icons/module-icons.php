<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M             (c) 2015 - 2016

Icons Module Class

*/

if ( ! defined( 'ABSPATH' )) exit; // NO DIRECT ACCESS

if ( class_exists('Plethora_Module_Icons') && !class_exists('Plethora_Module_Icons_Ext') ) {

  /**
   * Extend base class
   * Base class file: /plugins/plethora-featureslib/features/module/icons/module-icons.php
   */
  class Plethora_Module_Icons_Ext extends Plethora_Module_Icons { 

  	public $fontawesome_status           = true;
  	public $lineabasic_status            = false;
  	public $webfont_medical_icons_status = true;
  	public $weather_icons_status         = false;

    public function __construct() {

      parent::__construct();
      $this->newfont_admin_notice();
    }

    public function newfont_admin_notice() {
      
      $first_install_ver = get_option( 'plethora_theme_ver_installed_initial', THEME_VERSION );
      $condition         = ( version_compare( THEME_VERSION, '1.4.6' ) && version_compare( THEME_VERSION, $first_install_ver ) != 0 ) ? true : false ;
      $notice1           = sprintf( esc_html__( '%1$sLinea Basic%2$s, added on 1.4.6 version.', 'healthflex' ), '<strong>', '</strong>' ) .' ';
      $notice1           .= sprintf( esc_html__( 'Visit %1$sTheme Options > Advanced > Icon Libraries%2$s and click on the reset section button to re-index your libraries. ', 'healthflex' ), '<strong>', '</strong>' );
      $notice[]          = $notice1;
      $notice[]          = sprintf( esc_html__( 'Please don\'t miss this, as there is a strong possibility to experience undesired effects with your webfont icons display.', 'healthflex' ), '<strong>', '</strong>' );
      $args = array(
          'condition' => $condition,
          'title'     => esc_html__( 'New fonts added! You have to re-index your icon libraries', 'plethora-framework' ),
          'notice'    => $notice,
          'type' => 'warning'
      );
      Plethora_Theme::add_admin_notice( 'module_icons_reindex_libraries', $args );
    }
  }
}
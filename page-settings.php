<?php
    /*
	* Registro das funções de menu e página de configurações;
	*/
class KFAG_Settings_CSS_JS_Custom {

	public function create_plugin_settings_page() {
    	// Add the menu item and page
	    $page_title = __( 'Settings Page CSS and JS Custom', 'wp-custom-code' );
	    $menu_title = __( 'CSS and JS Custom', 'wp-custom-code' );
	    $capability = 'manage_options';
	    $slug = 'css-js-custom';
	    $callback = array( $this, 'plugin_settings_page_content' );
	    $icon = 'dashicons-admin-plugins';
		$position = 80;

		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
		
	}


	/**
	 * Página de configurações principal
	 */

	public function plugin_settings_page_content() { ?>
	    <div class="wrap">
	        <h2><?php esc_html_e( 'Settings Page', 'wp-custom-code' ); ?></h2>
	        <form method="post" action="options.php">
	            <?php
	                settings_fields( 'kfag_custom_code_fields' );
	                do_settings_sections( 'kfag_custom_code_fields' );
	                submit_button();
	            ?>
	        </form>

    </div> <?php
	}

	/**
	 * AQUI COMEÇA A ADIÇÃO DOS CAMPOS
	 */
	public function setup_sections() {
    	
    	add_settings_section( 'kfag_css_js_custom_settings', __( 'General Settings', 'wp-custom-code' ), array( $this, 'section_callback' ), 'kfag_custom_code_fields' );
    	add_settings_section( 'kfag_code_global', __( 'Globals Codes', 'wp-custom-code' ), array( $this, 'section_callback' ), 'kfag_custom_code_fields' );
    	
	}

	public function section_callback( $arguments ) {
	    switch( $arguments['id'] ){
	        case 'kfag_css_js_custom_settings':
	            esc_html_e( 'In the fields below, write the code you want to print on every page of your blog.', 'wp-custom-code' );
	            break;
	        case 'kfag_code_global':
	            esc_html_e( 'Add in this session the codes that will be uploaded throughout the site.', 'wp-custom-code' );
				break;
	    }
	}

	
	public function setup_fields() {
	    $fields = array(

			/**
			 * Sessão de Códigos
			 */
		    array(
				'uid' => 'kfag_wp_custom_css',
				'label' => esc_html__( 'CSS Global', 'wp-custom-code'),
				'section' => 'kfag_code_global',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => esc_html__( '', 'wp-custom-code'),
				'supplemental' => esc_html__( 'Enter your CSS code in the field to be printed throughout the site.', 'wp-custom-code'),
				'default' => ''
			),
			array(
				'uid' => 'kfag_wp_custom_js',
				'label' => esc_html__( 'JS Global', 'wp-custom-code'),
				'section' => 'kfag_code_global',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => esc_html__( '', 'wp-custom-code'),
				'supplemental' => esc_html__( 'Enter your JavaScript code in the field to be printed throughout the site.', 'wp-custom-code'),
				'default' => ''
			),
			array(
				'uid' => 'kfag_wp_custom_js_external',
				'label' => esc_html__( 'JS Externo', 'wp-custom-code'),
				'section' => 'kfag_code_global',
				'type' => 'textarea',
				'options' => false,
				'placeholder' => '',
				'helper' => esc_html__( 'Does this help?', 'wp-custom-code'),
				'supplemental' => esc_html__( 'Enter one address per line.', 'wp-custom-code'),
				'default' => ''
			),
		    


		);
	    foreach( $fields as $field ){
	        add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'kfag_custom_code_fields', $field['section'], $field );
	        register_setting( 'kfag_custom_code_fields', $field['uid'] );
	    }
	}

	
	public function field_callback( $arguments ) {

	    $value = esc_attr( get_option( $arguments['uid'] ) ); // Get the current value, if there is one
	    if( ! $value ) { // If no value exists
	        $value = $arguments['default']; // Set to our default
	    }

	    // Check which type of field we want
	    switch( $arguments['type'] ){
		    case 'text': // If it is a text field
		        printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
		        break;
		    case 'textarea': // If it is a textarea
		        printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
		        break;
		    case 'select': // If it is a select dropdown
		        if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
		            $options_markup = '';
		            foreach( $arguments['options'] as $key => $label ){
		                $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
		            }
		            printf( '<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup );
		        }
        		break;
		}


	    // If there is help text
	    if( $helper = $arguments['helper'] ){
	        printf( '<span class="helper"> %s</span>', $helper ); // Show it
	    }

	    // If there is supplemental text
	    if( $supplimental = $arguments['supplemental'] ){
	        printf( '<p class="description">%s</p>', $supplimental ); // Show it
	    }
	}


}
<?php

namespace Gform_Toggle;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// maybe extend GF_Field_Checkbox
class Toggle_Field extends \GF_Field {
  public $type = 'toggle';
  
  /**
   * Returns the field title.
   *
   * @return string
   */
  public function get_form_editor_field_title() {
	  return esc_attr__( 'Toggle', 'gravityforms-toggle-field' );
  }
  
	/**
   * Returns the field's form editor description.
   *
   * @since 2.5
   *
   * @return string
   */
  public function get_form_editor_field_description() {
	  return esc_attr__( 'Places a toggle field in your form.', 'gravityforms' );
  }
  
  /**
   * Returns the field's form editor icon.
   *
   * This could be an icon url or a gform-icon class.
   *
   * @since 2.5
   *
   * @return string
   */
  public function get_form_editor_field_icon() {
	  return apply_filters( 'gform_toggle_field/admin/field_icon', file_get_contents( GFORM_TOGGLE_PATH . '/assets/svg/switch.svg') );
  }
  
  /**
   * Returns the field button properties for the form editor. The array contains two elements:
   * 'group' => 'standard_fields' // or  'advanced_fields', 'post_fields', 'pricing_fields'
   * 'text'  => 'Button text'
   *
   * Built-in fields don't need to implement this because the buttons are added in sequence in GFFormDetail
   *
   * @return array
   */
  public function get_form_editor_button() {
	  return array(
		  'group' => 'advanced_fields',
		  'text'  => $this->get_form_editor_field_title(),
		  'icon'  => $this->get_form_editor_field_icon(),
		  'description' => $this->get_form_editor_field_description()
	  );
  }

  /**
   * Returns the class names of the settings which should be available on the field in the form editor.
   *
   * @return array
   */
  public function get_form_editor_field_settings() {
	  return [
		  'conditional_logic_field_setting',
		  'prepopulate_field_setting',
		  'error_message_setting',
		  'label_setting',
		  'label_placement_setting',
		  'admin_label_setting',
		  'rules_setting',
		  'visibility_setting',
		  'default_value_setting',
		  'description_setting',
		  'css_class_setting',
	  ];
  }
  
  /**
   * Returns the field inner markup.
   *
   * @param array        $form  The Form Object currently being processed.
   * @param string|array $value The field value. From default/dynamic population, $_POST, or a resumed incomplete submission.
   * @param null|array   $entry Null or the Entry Object currently being edited.
   *
   * @return string
   */
  public function get_field_input( $form, $value = '', $entry = null ) {

  	$is_entry_detail = $this->is_entry_detail();
  	$is_form_editor  = $this->is_form_editor();
	  
	$form_id  = absint( $form['id'] );
	$id       = absint( $this->id );
	$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
	$form_id  = ( $is_entry_detail || $is_form_editor ) && empty( $form_id ) ? rgget( 'id' ) : $form_id;
  	
  	$content = $is_entry_detail || $is_form_editor ? "<div class='gf-html-container'><span class='gf_blockheader'>
													  	<i class='fa fa-code fa-lg'></i> " . esc_html__( 'HTML Content', 'gravityforms' ) .
													  	'</span><span>' . esc_html__( 'This is a content placeholder. HTML content is not displayed in the form admin. Preview this form to view the content.', 'gravityforms' ) . '</span></div>'
												  	: $this->content;
  	// $content = GFCommon::replace_variables_prepopulate( $content ); // adding support for merge tags
  	
  	// adding support for shortcodes
  	// $content = $this->do_shortcode( $content );
  	
	
	
	$html_input_type = 'checkbox';
	$tabindex = $this->get_tabindex();
	$value    = esc_attr( $value );
	$class = '';
	$class    = esc_attr( $class );
	$disabled_text = $is_form_editor ? "disabled='disabled'" : '';
	$required_attribute    = $this->isRequired ? 'aria-required="true"' : '';
	$invalid_attribute     = $this->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
	$aria_describedby      = $this->get_aria_describedby();
	  
	// return "<div class='ginput_container ginput_container_toggle'><input name='input_{$id}' id='{$field_id}' type='{$html_input_type}' value='$value' class='{$class}' {$tabindex} {$disabled_text} {$required_attribute} {$invalid_attribute} {$aria_describedby} /></div>";
	
	return '<label class="toggle" for="uniqueID">
		<input type="checkbox" class="toggle__input" id="uniqueID" />
		<span class="toggle-track">
			<span class="toggle-indicator">
				<!-- 	This check mark is optional	 -->
				<span class="checkMark">
					<svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
						<path d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z"></path>
					</svg>
				</span>
			</span>
		</span>
		Enabled toggle label
	</label>';
  }
  
	// public function get_field_content( $value, $force_frontend_label, $form ) {
	//   $form_id             = $form['id'];
	//   $admin_buttons       = $this->get_admin_buttons();
	//   $is_entry_detail     = $this->is_entry_detail();
	//   $is_form_editor      = $this->is_form_editor();
	//   $is_admin            = $is_entry_detail || $is_form_editor;
	//   $field_label         = $this->get_field_label( $force_frontend_label, $value );
	//   $field_id            = $is_admin || $form_id == 0 ? "input_{$this->id}" : 'input_' . $form_id . "_{$this->id}";
	//   $admin_hidden_markup = ( $this->visibility == 'hidden' ) ? $this->get_hidden_admin_markup() : '';
	//   $field_content       = ! $is_admin ? '{FIELD}' : $field_content = sprintf( "%s%s<label class='gfield_label gform-field-label' for='%s'>%s</label>{FIELD}", $admin_buttons, $admin_hidden_markup, $field_id, esc_html( $field_label ) );
  // 
	//   return $field_content;
  // }
  
}
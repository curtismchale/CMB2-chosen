<?php
/**
 * Renders a select field with our custom class so we can apply the chosen JS later
 *
 * @since 1.0
 * @author SFNdesign, Curtis McHale
 *
 * @param object        $field                  Current CMB2_field object
 * @param string        $escaped_value          Current escaped value of the field
 * @param int           $object_id              Current object id (probably post_id)
 * @param string        $object_type            Object type (probably post)
 * @param object        $field_object_type      Instance of CMB2_Types object
 * @uses wp_enqueue_script()                    Gets a script set up the WordPress way
 */
function sfn_render_chosen( $field, $escaped_value, $object_id, $object_type, $field_object_type ){

	wp_enqueue_script( 'chosen', plugins_url( '/pmc-tvt-editing/cmb2-chosen/js/chosen/chosen.jquery.min.js' ), array( 'jquery' ), '1.0', true );
	wp_enqueue_style( 'chosen_css', plugins_url( '/pmc-tvt-editing/cmb2-chosen/js/chosen/chosen.css' ), '', '1.0', 'all');
	wp_enqueue_script( 'sfn_chosen', plugins_url( '/pmc-tvt-editing/cmb2-chosen/js/sfn_chosen.js' ), array( 'jquery', 'chosen' ), '1.0', true );

	$options = $field->options();
	$current_value = $field->value;

?>
	<select style="width:100%" name="<?php echo $field->args['id']; ?>[]" id="<?php echo $field->args['id']; ?>" class="sfn-chosen" multiple="multiple">
		<option></option>
		<?php foreach( $options as $key => $value ){ ?>
			<?php $selected = in_array( $key, $current_value ) ? 'selected="selected"' : ''; ?>
			<option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
		<?php } ?>
	</select>

<?php
} // sfn_render_chosen
add_filter( 'cmb2_render_sfn_chosen', 'sfn_render_chosen', 10, 5 );

function sfn_chosen_sanitize( $override_value, $value ){
	return $value;
} // sfn_chosen_sanitize
add_filter( 'cmb2_sanitize_sfn_chosen', 'sfn_chosen_sanitize', 10, 2 );

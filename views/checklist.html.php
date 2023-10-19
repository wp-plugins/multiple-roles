<?php
/**
 * Output the roles checklist.
 *
 * @var $roles array All WordPress roles in name => label pairs.
 * @var $user_roles array An array of role names belonging to the current user.
 */
$creating = isset( $_POST['createuser'] );
$selected_roles = $creating && isset( $_POST['md_multiple_roles'] ) ? wp_unslash( $_POST['md_multiple_roles'] ) : '';
?>
<h3><?php _e( 'Permissions', 'multiple-roles' ); ?></h3>
<table class="form-table">
	<tr>
		<th><?php _e( 'Roles', 'multiple-roles' ); ?></th>
		<td>
			<?php foreach( $roles as $name => $label ) :
				$input_uniq_id = uniqid(); ?>
				<label for="md-multiple-roles-<?php echo esc_attr( $name ) . '-' . $input_uniq_id; ?>">
					<input
						id="md-multiple-roles-<?php echo esc_attr( $name ) . '-' . $input_uniq_id; ?>"
						type="checkbox"
						name="md_multiple_roles[]"
						value="<?php echo esc_attr( $name ); ?>"
                        <?php if ( ! is_null( $user_roles ) ) : // Edit user page
                            checked( in_array( $name, $user_roles ) );
						elseif ( ! empty( $selected_roles ) ) : // Add new user page
							checked( in_array( $name, $selected_roles ) );
                        endif; ?>
					/>
					<?php echo esc_html( translate_user_role( $label ) ); ?>
				</label>
				<br />
			<?php endforeach; ?>
		</td>
	</tr>
</table>
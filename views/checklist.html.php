<?php
/**
 * Output the roles checklist.
 *
 * @var $roles array All WordPress roles in name => label pairs.
 * @var $user_roles array An array of role names belonging to the current user.
 */
?><h3><?php _e( 'Permissions', 'multiple-roles' ); ?></h3>
<table class="form-table">
	<tr>
		<th><?php _e( 'Roles', 'multiple-roles' ); ?></th>
		<td>
			<?php foreach( $roles as $name => $label ) : ?>
				<label for="md-multiple-roles-<?php echo esc_attr( $name ); ?>">
					<input
						id="md-multiple-roles-<?php echo esc_attr( $name ); ?>"
						type="checkbox"
						name="md_multiple_roles[]"
						value="<?php echo esc_attr( $name ); ?>"
                        <?php if ( ! is_null( $user_roles ) ) :
                            checked( in_array( $name, $user_roles ) );
                        endif; ?>
					/>
					<?php echo esc_html( $label ); ?>
				</label>
				<br />
			<?php endforeach; ?>
		</td>
	</tr>
</table>
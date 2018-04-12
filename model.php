<?php
/**
 * Role logic: retrieving, updating, and checking permission.
 */
class MDMR_Model {

	/**
	 * Grab all WordPress roles.
	 *
	 * @return array Roles in name => label pairs.
	 */
	public function get_roles() {
		global $wp_roles;
		return apply_filters( 'mdmr_get_roles', $wp_roles->role_names );
	}

	/**
	 * Get all editable roles by the current user
	 *
	 * @return array editable roles
	 */
	public function get_editable_roles() {
		$editable_roles = get_editable_roles();
		$final_roles = array();
		foreach ( $editable_roles as $key => $role ) {
			$final_roles[$key] = $role['name'];
		}

		return apply_filters( 'mdmr_get_editable_roles', (array) $final_roles );
	}

	/**
	 * Grab a particular user's roles.
	 *
	 * @param object|int $user The user object or ID.
	 * @return array Roles in name => label pairs.
	 */
	public function get_user_roles( $user = 0 ) {

		if ( ! $user ) {
			return array();
		}

		$user = get_user_by( 'id', (int) $user );
		if ( empty( $user->roles ) ) {
			return array();
		}

		$all_roles = $this->get_roles();
		$roles = array();
		foreach( $user->roles as $role ) {
			$roles[$role] = $all_roles[$role];
		}

		return apply_filters( 'mdmr_get_user_roles', $roles );
	}

	/**
	 * Erase the user's existing roles and replace them with the new array.
	 *
	 * @param integer $user_id The WordPress user ID.
	 * @param array $roles The new array of roles for the user.
	 *
	 * @return bool
	 */
	public function update_roles( $user_id = 0, $roles = array() ) {

		do_action( 'mdmr_before_update_roles', $user_id, $roles );

		$roles = array_map( 'sanitize_key', (array) $roles );
		$roles = array_filter( (array) $roles, 'get_role' );

		$user = get_user_by( 'id', (int) $user_id );

		// Remove all editable roles
		$editable = get_editable_roles();
		$editable_roles = is_array($editable) ? array_keys($editable) : array();
		foreach( $editable_roles as $role ) {
			$user->remove_role( $role );
		}

		foreach( $roles as $role ) {
			$user->add_role( $role );
		}

		do_action( 'mdmr_after_update_roles', $user_id, $roles, $user->roles );

		return true;
	}

	/**
	 * Check whether or not a user can edit roles. User must have the edit_roles cap and
	 * must be on a specific site (and not in the network admin area). Users also can't
	 * edit their own roles unless they're a network admin.
	 *
	 * @return bool True if current user can update roles, false if not.
	 */
	public function can_update_roles() {

		do_action( 'mdmr_before_can_update_roles' );

		if ( is_network_admin() || ! current_user_can( 'promote_users' ) || ( defined( 'IS_PROFILE_PAGE' ) && IS_PROFILE_PAGE && ! current_user_can( 'manage_sites' ) ) ) {
				return false;
		}

		return true;

	}

}
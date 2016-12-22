<?php
/**
 * A set of action functions which handle the behavior of the roles checklist
 * on user edit screens.
 */
class MDMR_Checklist_Controller {

	/**
	 * The model object.
	 *
	 * @var \MDMR_Model $model
	 */
	var $model;

	/**
	 * Constructor. Define properties.
	 *
	 * @param object $model The model object.
	 */
	public function __construct( $model ) {
		$this->model = $model;
	}

	/**
	 * Remove the default WordPress role dropdown from the DOM.
	 *
	 * @param string $hook The current admin screen.
	 */
	public function remove_dropdown( $hook ) {
		if ( 'user-edit.php' !== $hook && 'user-new.php' !== $hook) {
			return;
		}
		wp_enqueue_script( 'md-multiple-roles', MDMR_URL . 'views/js/scripts.js', array( 'jquery' ), '1.0' );
	}

	/**
	 * Output the checklist view. If the user is not allowed to edit roles,
	 * nothing will appear.
	 *
	 * @param object $user The current user object.
	 */
	public function output_checklist( $user ) {

		if ( ! $this->model->can_update_roles() ) {
			return;
		}

		wp_nonce_field( 'update-md-multiple-roles', 'md_multiple_roles_nonce' );

		$roles        = $this->model->get_editable_roles();
        $user_roles   = ( isset( $user->roles ) ) ? $user->roles : null;

		include( apply_filters( 'mdmr_checklist_template', MDMR_PATH . 'views/checklist.html.php' ) );

	}

	/**
	 * Update the given user's roles as long as we've passed the nonce
	 * and permissions checks.
	 *
	 * @param int $user_id The user ID whose roles might get updated.
	 */
	public function process_checklist( $user_id ) {
		do_action( 'mdmr_before_process_checklist', $user_id, $_POST['role'] );

		if ( 'user_register' === current_action() ) {
			$input_name = 'role';
		} else {
			$input_name = 'md_multiple_roles';
		}

		if ( isset( $_POST['md_multiple_roles_nonce'] ) && ! wp_verify_nonce( $_POST['md_multiple_roles_nonce'], 'update-md-multiple-roles' ) ) {
			return;
		}

		if ( ! $this->model->can_update_roles() ) {
			return;
		}

		$roles = ( isset( $_POST[ $input_name ] ) && is_array( $_POST[ $input_name ] ) ) ? $_POST[ $input_name ] : array();
		if ( empty( $roles ) ) {
			return;
		}

		$this->model->update_roles( $user_id, $roles );
	}

	/**
	 * Add multiple roles after user activation
	 *
	 * @param $user_id
	 * @param $password
	 * @param $meta
	 */
	public function mu_add_roles_after_activation( $user_id, $password, $meta ) {
		if ( ! empty( $meta['add_to_blog'] ) ) {
			$blog_id = $meta['add_to_blog'];
			remove_user_from_blog( $user_id, get_network()->site_id ); // remove user from main blog.
			add_user_to_blog( $blog_id, $user_id, '' );
			update_user_meta( $user_id, 'primary_blog', $blog_id );
		}

		if ( ! empty( $meta['new_role'] ) ) {
			$this->model->update_roles( $user_id, $meta['new_role'] );
		}
	}

}
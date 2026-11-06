<?php
/**
 * CheckOff Elementor Child — functions.
 *
 * A child theme of Hello Elementor for sites built around the CheckOff
 * plugin. It styles nothing on its own beyond the checklists, keeps every
 * other design decision with Hello Elementor and Elementor, and adds a page
 * template for the checklist page.
 *
 * Prefix: `cko_child_` for functions and constants, `cko-child`/`cko-theme`
 * for handles and classes, text domain `checkoff-elementor-child`.
 *
 * @package CheckOffElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CKO_CHILD_VERSION', '1.0.1' );

/**
 * Loads the theme's translations.
 *
 * @return void
 */
function cko_child_setup(): void {
	load_child_theme_textdomain( 'checkoff-elementor-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'cko_child_setup' );

/**
 * Enqueues the child stylesheet after Hello Elementor's own.
 *
 * Hello Elementor does not load its style.css (only its assets), so the child
 * depends on the parent's theme stylesheet handle instead.
 *
 * @return void
 */
function cko_child_enqueue_styles(): void {

	$path    = get_stylesheet_directory() . '/style.css';
	$version = file_exists( $path ) ? CKO_CHILD_VERSION . '.' . filemtime( $path ) : CKO_CHILD_VERSION;

	wp_enqueue_style(
		'cko-child',
		get_stylesheet_uri(),
		wp_style_is( 'hello-elementor-theme-style', 'registered' ) ? array( 'hello-elementor-theme-style' ) : array(),
		$version
	);
}
add_action( 'wp_enqueue_scripts', 'cko_child_enqueue_styles', 20 );

/**
 * Body classes: `cko-theme` everywhere (the stylesheet's scope), `cko-page`
 * on pages using the checklist template.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function cko_child_body_class( array $classes ): array {

	$classes[] = 'cko-theme';

	if ( is_page_template( 'page-templates/checkoff-app.php' ) ) {
		$classes[] = 'cko-page';
	}

	return $classes;
}
add_filter( 'body_class', 'cko_child_body_class' );

/**
 * Whether the current request opens a checklist by its ID.
 *
 * @return bool
 */
function cko_child_is_checklist_view(): bool {
	$query_var = class_exists( 'Checkoff_Checklist' ) ? Checkoff_Checklist::QUERY_VAR : 'cko';

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only.
	return isset( $_GET[ $query_var ] );
}

/**
 * A page opened with a checklist ID carries that ID — the checklist's only
 * key — in its address. Links from such a page to other sites must not pass
 * the address on, so the referrer is limited to this site there.
 *
 * @return void
 */
function cko_child_referrer_policy(): void {
	if ( cko_child_is_checklist_view() ) {
		echo '<meta name="referrer" content="same-origin" />' . "\n";
	}
}
add_action( 'wp_head', 'cko_child_referrer_policy', 1 );

/**
 * Reminds administrators that this theme is made for the CheckOff plugin.
 *
 * @return void
 */
function cko_child_plugin_notice(): void {

	if ( class_exists( 'Checkoff' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	echo '<div class="notice notice-warning"><p>'
		. esc_html__( 'The theme "CheckOff Elementor Child" is made for the CheckOff plugin. Please install and activate CheckOff.', 'checkoff-elementor-child' )
		. '</p></div>';
}
add_action( 'admin_notices', 'cko_child_plugin_notice' );

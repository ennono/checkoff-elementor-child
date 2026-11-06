<?php
/**
 * Template Name: CheckOff checklist
 *
 * The page visitors create, open and tick off their checklists on. Shows
 * the page's own content (text above, Elementor layout, …) and below it the
 * CheckOff app — unless the content already places a CheckOff shortcode
 * itself, in which case nothing is added.
 *
 * Choose this page as "Checklist page" in CheckOff → Settings so that links
 * to checklists lead here.
 *
 * @package CheckOffElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$cko_child_content = (string) get_post_field( 'post_content', get_the_ID() );
	$cko_child_has_app = (bool) preg_match( '/\[cko_(app|checklist|create|open)\b/', $cko_child_content );
	?>

<main id="content" <?php post_class( 'site-main cko-page' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) && ! cko_child_is_checklist_view() ) : ?>
		<div class="page-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</div>
	<?php endif; ?>

	<div class="page-content">
		<?php
		// The page's own text belongs to the overview; a single checklist
		// stands on its own.
		if ( ! cko_child_is_checklist_view() || $cko_child_has_app ) {
			the_content();
		}

		if ( ! $cko_child_has_app ) {
			echo shortcode_exists( 'cko_app' )
				? do_shortcode( '[cko_app]' )
				: '<p>' . esc_html__( 'The CheckOff plugin is not active.', 'checkoff-elementor-child' ) . '</p>';
		}
		?>
	</div>

</main>

	<?php
endwhile;

get_footer();

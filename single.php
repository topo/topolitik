<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package topolitik
 */

get_header();
?>

	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/print.css" mce_href="<?php echo get_template_directory_uri()?>/print.css" media="print" />

	<div id="primary" class="content-area">
			<article id="post-<?php the_ID(); ?>" class="post-container">
				<?php
				while ( have_posts() ) :
					the_post();

					// Global PHP variables
					$postid = get_the_ID();
			    $custom_fields = get_post_custom($postid);

					if (array_key_exists('abstract', $custom_fields)) {
				    foreach ( $custom_fields['abstract'] as $key => $value ) {
							if ($value) {
				      	echo '<meta property="og:description" content="' . $value .'">';
								echo '<meta property="twitter:description" content="' . $value .'">';
							}
				    }
					}
					if (array_key_exists('kicker', $custom_fields)) {
						foreach ( $custom_fields['kicker'] as $key => $value ) {
							if ($value) {
								echo '<meta property="article:kicker" content="' . $value .'">';
								echo '<meta property="topo:kicker" content="' . $value .'">';
							}
						}
					}
					if (array_key_exists('arch_thumb', $custom_fields)) {
						foreach ( $custom_fields['arch_thumb'] as $key => $value ) {
							if ($value) {
								$v = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<meta property="og:image" content="' . $v .'">';
								echo '<meta property="twitter:image" content="' . $v .'">';
							} else {
								echo '<meta name="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
								echo '<meta name="og:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'" >' ;

							}
						}
					} else if (array_key_exists('header_img', $custom_fields)) {
						foreach ( $custom_fields['header_img'] as $key => $value ) {
							if ($value) {
								$v2 = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<meta property="og:image" content="' . $v2 .'">';
								echo '<meta property="twitter:image" content="' . $v2 .'">';

							} else {
								echo '<meta property="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
								echo '<meta property="og:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'" >' ;

							}
						}
					} else {
						echo '<meta property="twitter:image" content="'.get_the_post_thumbnail_url(get_the_ID()).'">' ;
						echo '<meta property="og:image" content="'.get_the_post_thumbnail_url(false).'" >' ;
					}
				?>

				<meta
					property="og:title"
					content="<?php echo get_the_title(); ?>"
					>
				<meta
					property="og:url"
					content="<?php echo get_permalink(); ?>"
					>
				<meta
					name="twitter:title"
					content="<?php echo get_the_title(); ?>"
					>
				<meta
					name="twitter:card"
					content="summary_large_image"
					>


				<!-- printing header -->
				<header class="print-header just-print">
					<div class="branding">
						<img
							class="brand-left"
							src="<?php echo get_template_directory_uri()?>/images/topo-print-1.png"
							/>
						<img class="brand-right" src="<?php echo get_template_directory_uri()?>/images/topo-print-2.png"></img>
					</div>
					<div class="article-print">
						<div class="title">
							<?php the_title( '<h1 class="title-text">', '</h1>' ); ?>
						</div>
						<div class="info">
							<?php
							echo "<div class='authors'>";
							coauthors_posts_links();
							echo "</div>";
							topolitik_posted_on();
							?>
						</div>
					</div>
					<div>

					</div>
				</header>

				<!-- web page header -->
				<header class="entry-header no-print">
					<!-- Kicker -->
					<?php
						// ! : gettings global vars : $custom_fields and $
						if (array_key_exists('kicker', $custom_fields)) {
							foreach ( $custom_fields['kicker'] as $key => $value ) {
								if ($value) {
									echo "<h2 class='title-kicker'>".$value."</h2>";
								};
							}
						};
					?>
					<!-- Title & more -->
					<?php
						if ( is_singular() ) :
							the_title( '<h1 class="entry-title">', '</h1>' );
						else :
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						endif;

						if ( 'post' === get_post_type() ) {
							echo "<div class='entry-meta'>";
							coauthors_posts_links();
							echo "<b> / </b>";
							topolitik_get_categories();
							echo "<br/>";
							topolitik_posted_on();
							echo "</div>";
						};
					?>
				</header>

				<div style="display:block;width:100%" class="no-print">
					<?php
					$postid = get_the_ID();
					$custom_fields = get_post_custom($postid);
					if (array_key_exists('header_img', $custom_fields)) {
						foreach ( $custom_fields['header_img'] as $key => $value ) {
							if ($value) {
								$v = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<div class="post-thumbnail no-print">';
								echo '<div class="banner" style="background-image:url('.$v.')"></div>';
								echo '</div>';
								echo '<img class="just-print print-thumbnail" src="'.$v.'" > ';
							}
						}
					} else if (array_key_exists('arch_thumb', $custom_fields)) {
						foreach ( $custom_fields['arch_thumb'] as $key => $value ) {
							if ($value) {
								$v = wp_get_attachment_image_src($value, "adv-pos-a-large")[0];
								echo '<div class="post-thumbnail no-print">';
								echo '<div class="banner" style="background-image:url('.$v.')"></div>';
								echo '</div>';
								echo '<img class="just-print print-thumbnail" src="'.$v.'" > ';
							}
						}
					}	else {
						topolitik_post_thumbnail();
					}

					?>
				</div>
				<div class="post-info right-sidebar no-print">
					<div class="link-to-print no-print" onclick="window.print();">
						<img class="print-icon" src="<?php echo get_template_directory_uri()?>/images/print.png" height="64" />
					</div>
					<?php dynamic_sidebar( 'sidebar-3' ); ?>
				</div>
				<div <?php post_class(); ?> >
					<main id="main" class="site-main">

					<div class="entry-content">
						<?php
						the_content();

						/*wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'topolitik' ),
							'after'  => '</div>',
						) );*/
						?>
					</div><!-- .entry-content -->

				<?php

				$postid = get_the_ID();
				$custom_fields = get_post_custom($postid);
				if (array_key_exists('ref_list', $custom_fields)) {
					foreach ( $custom_fields['ref_list'] as $key => $value ) {
						$text = str_replace("\n", "\n\n", $value); // ensure reference is in new paragraph

						include 'packages/parsedown-1.7.3/Parsedown.php';
						$Parsedown = new Parsedown();
						if ($text) {
							echo '<div class="post-references">';
							echo '<h2 class="post-references-title">Références</h2>';
							echo $Parsedown->text($text);
							echo '</div>';
						}

					}
				}

				?>
				<!-- authors -->
				<h2 class="post-references-title">Rédigé par...</h2>
				<?php
					// Get authors meta tags
					$coauthors = get_coauthors(get_the_ID());
					$index = 0;
					foreach ($coauthors as $coauthor) {

						$index++;
						$l = coauthors_get_avatar( $coauthor, 150 );
						$dom = new DOMDocument();
						$dom->loadXML($l);
						$o = $dom->getElementsByTagName('img')[0];
						$src = $o->getAttribute('src');
						echo '<meta property="article:author:'.$index.':image" content="'.$src.'" >' ;
						echo '<meta property="article:author:'.$index.':name" content="'.$coauthor->display_name.'" >' ;
						echo '<a class="author-block" href="'.get_site_url().'/author/'.$coauthor->user_login.'">';
						echo '<div class="avatar no-print" style="background-image:url('.$src.')"> </div>';
						echo '<img class="image-avatar just-print" src="'.$src.'"> </img>';
						echo '<div class="title">';
						echo '<h1 class="name">'.$coauthor->display_name.'</h1>';
						echo '<p class="description">'.$coauthor->description.'</p>';
						echo '</div>';
						echo '</a>';
					}


				// - these are comments
				/*echo '<div class="no-print">';
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				echo '</div>';*/

			endwhile; // End of the loop.
			?>

			</main><!-- #main -->
		</div>
		<div class="right-sidebar no-print">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();

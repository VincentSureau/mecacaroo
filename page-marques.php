<?php
/*
Template Name: Pages marques
*/

add_bootstrap();
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
                        the_content();
                    ?>
                        
                        <div class="d-flex flex-wrap justify-content-center align-items-center">

                        <?php if($brands = getBrands()): ?>
                            <?php foreach($brands as $brand): ?>
                                <div class="col-12 col-sm-6 col-md-3 px-2 my-3">
                                    <a class="d-flex flex-column justify-content-center align-items-center" href="https://www.mecacarro.fr/marque?marque=<?= $brand["marque"] ?>">
                                        <img 
                                                src="https://mecacarro.fr/wp-content/uploads/imagemarques/<?= $brand["image"] ?>"
                                                alt="logo-<?= $brand["marque"] ?>" 
                                            style="height:100px"	
                                        />
                                        <span style="color:black;font-weight:bold"><?= $brand["marque"] ?></span>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                                <p>Désolé, aucune marque disponnible pour le moment</p>
                        <?php endif ?>


                    <?php
						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
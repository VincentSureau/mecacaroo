<?php
/*
Template Name: Pages modèles (liste)
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

                        <?php if($models = getModels()): ?>
                            <?php foreach($models as $model): ?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 px-2 my-3">
                                    <a class="d-flex flex-column justify-content-center align-items-center" href="https://www.mecacarro.fr/modele?model=<?= $model["modele"] ?>">
                                        <img 
                                                src="https://mecacarro.fr/wp-content/uploads/imagemodeles/<?= $model["image"] ?>"
                                                alt="logo-<?= $model["modele"] ?>" 
                                            style="height:170px"	
                                        />
                                        <span style="color:black;font-weight:bold"><?= $model["modele"] ?></span>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                                <p>Désolé, aucune modèle disponnible pour le moment</p>
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
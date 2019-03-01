<?php
/*
Template Name: Pages modèle (choix)
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
                        

					<?php if($car = getCarData()): ?>
							<div class="d-flex flex-column flex-wrap justify-content-center align-items-center my-4">

									<img 
											src="https://mecacarro.fr/wp-content/uploads/imagemodeles/<?= $car["image"] ?>"
											alt="logo-<?= $model["modele"] ?>" 
										style="height:300px;width:450px"	
									/>
									<span style="color:black;font-weight:bold"><?= $car["marque"] .' - '. $car["modele"] ?></span>
							</div>
					<?php else: ?>
							<p>Désolé, aucune modèle disponnible pour le moment</p>
					<?php endif ?>

					<div class="d-flex flex-column flex-md-row justify-content-md-between col-12">
					<table class="col-12 col-md-4 mx-0 mx-md-2 table table-striped table-hover">
						<?php if($generations = getGeneration()): ?>
							<thead class="thead-light">
								<tr>
									<th>Génération</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($generations as $generation): ?>
									<tr>
										<td>
										<a href="https://www.mecacarro.fr/modele?model=<?= $generation['modele'] ?>&generation=<?= $generation['generation'] ?>"><?= $generation['generation'] ?></a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						<?php endif ?>
					</table>


					<table class="col-12 col-md-4 mx-0 mx-md-2 table table-striped table-hover">
						<?php if($energies = getCarEnergies()): ?>
							<thead class="thead-light">
								<tr>
									<th>Energie</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($energies as $energy): ?>
									<tr>
										<td>
										<a href="https://www.mecacarro.fr/modele?model=<?= $energy['modele'] ?>&generation=<?= $energy['generation'] ?>&energie=<?= $energy['energie'] ?>"><?= $energy['energie'] ?></a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						<?php endif ?>
					</table>

					<table class="col-12 col-md-4 mx-0 mx-md-2 table table-striped table-hover">
						<?php if($versions = getCarVersions()): ?>
							<thead class="thead-light">
								<tr>
									<th>Versions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($versions as $version): ?>
									<tr>
										<td>
										<a href="https://www.mecacarro.fr/voiture?voiture=<?= $version['id'] ?>"><?= $version['version'] ?></a>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						<?php endif ?>
					</table>
					</div>



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
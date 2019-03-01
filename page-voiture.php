<?php
/*
Template Name: Pages voiture
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
                        

                        <?php if($car = getCarDataById()): ?>
                                <div class="d-flex flex-column flex-wrap justify-content-center align-items-center my-4">

                                        <img 
                                                src="https://mecacarro.fr/wp-content/uploads/imagemodeles/<?= $car["image_modele"] ?>"
                                                alt="logo-<?= $model["modele"] ?>" 
                                            style="height:300px;width:450px"	
                                        />
                                        <span style="color:black;font-weight:bold"><?= $car["rappel_marque"] .' - '. $car["rappel_modele"] .' '. $car['version'] .' ['. $car['energie'] .']' ?></span>
                                </div>
                        <?php else: ?>
                                <p>Désolé, aucune modèle disponnible pour le moment</p>
                        <?php endif ?>

                        <?php if($car): ?>

                        <!-- prestations relatives au freinage -->
                        <h4 class="my-3 font-weight-bold">Freinage / Pneumatique</h4>
                        <div class="d-flex flex-row flex-wrap justify-content-md-around">

                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Plaquettes avant</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des plaquettes avant, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Plaquette_Av"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/plaquette-avant-'. $car["Plaquette_Av"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Disques + Plaquettes Avant</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des disques disques et des plaquettes avant, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Disque plaquette Av"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/disque-plaquette-av-'. $car["Disque plaquette Av"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Plaquettes arrières</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des plaquettes arrières, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Plaquette_Ar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/plaquette-arriere-'. $car["Plaquette_Ar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Disques + Plaquettes arrières</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des disques et des plaquettes arrières, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Disque plaquette Ar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/disque-plaquette-ar-'. $car["Disque plaquette Ar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Kit de freins</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement du kit de freins arrières, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Kit frein Ar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/kit-frein-arriere-'. $car["Kit frein Ar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Pneus</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des pneus, montage et équilibrage compris.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Pneumatique"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/pneus-'. $car["Pneumatique"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Prestations relatives à l'entretien mécanique et à l'entretien -->
                        <h4 class="my-3 font-weight-bold">Mécanique / Entretien du véhicule</h4>

                        <div class="d-flex flex-row flex-wrap justify-content-md-around">
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Climatisation</h5>
                                <div class="card-body">
                                    <p class="card-text">Recharge de la climatisation.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Climatisation"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/recharge-de-clim-'. $car["Climatisation"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Cardan</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement de cardan, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Cardan"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/cardan-'. $car["Cardan"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Vidange boite de vitesse</h5>
                                <div class="card-body">
                                    <p class="card-text">Vidange de la boite de vitesse du véhicule.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Vidange de boite"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/vidange-de-boite-'. $car["Vidange de boite"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Vidange boite de pont arrière</h5>
                                <div class="card-body">
                                    <p class="card-text">Vidange du pont arrière du véhicule.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Vidange de pont"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/vidange-de-pont-'. $car["Vidange de pont"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Embrayage</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement d'embrayage, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Embrayage"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/embrayage-'. $car["Embrayage"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Distribution</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement distribution, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Distribution"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/distribution-'. $car["Distribution"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Prestation relatives à la suspension -->
                        <h4 class="my-3 font-weight-bold">Suspension</h4>

                        <div class="d-flex flex-row flex-wrap justify-content-md-around">
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Amortisseurs Avant</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des amortisseurs avant, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Amortisseur_Av"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/amortisseur-avant-'. $car["Amortisseur_Av"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Amortisseurs arrières</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des amortisseurs arrières, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Amortisseur_Ar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/amortisseur-arriere-'. $car["Amortisseur_Ar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Amortisseurs avant + arrières</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des amortisseurs avant et arrières, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Amortisseur_avar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/amortisseur-avant-arriere-'. $car["Amortisseur_avar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <!-- Prestation relatives à la direction -->
                        <h4 class="my-3 font-weight-bold">Direction</h4>

                        <div class="d-flex flex-row flex-wrap justify-content-md-around">
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Parallélisme</h5>
                                <div class="card-body">
                                    <p class="card-text">Réglage parallélisme (tout angle disponible).</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Parallelisme"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/parallelisme-'. $car["Parallelisme"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Roulements Avant</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des roulements avant, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Roulement Av"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/roulement-avant-'. $car["Roulement Av"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Roulements Arrières</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des roulements arrières, pièces et main d'œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Roulement Ar"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/roulement-arriere-'. $car["Roulement Ar"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card col-12 col-md-5 col-lg-3 px-0 mx-md-2 my-2">
                                <h5 class="card-header">Rotule / Biellettes de direction</h5>
                                <div class="card-body">
                                    <p class="card-text">Remplacement des éléments de direction, pièces et main œuvre comprise.</p>
                                    <p class="text-right text-white">
                                        <?= ($car["Rotule biellette de direction"])? '<a class="btn btn-success" href="https://www.mecacarro.fr/boutique/rotule-biellette-de-direction-'. $car["Rotule biellette de direction"] .'">Voir les tarifs</a>' : '<a href="https://www.mecacarro.fr/contact/" class="btn btn-primary">Demander un devis</a>' ?>
                                    </p>
                                </div>
                            </div>

                        </div>
                        
                        <?php endif ?>
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
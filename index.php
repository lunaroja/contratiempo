<?php get_header(); ?>
<section id="portada">
	<?php
	$args = array(
	  'orderby' => 'date',
	  'posts_per_page' => 1
	  );
	$categories = get_categories( $args );
	foreach ( $categories as $category ) { ?>
						<?php echo do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$category->term_id)); ?>
						<div class="portadacontainer">
						<div class="titulo">
							test
							<p><?php echo get_post_meta($post->ID, 'year', true); ?></p>
							<h1><?php echo $category->name ;?></h1>
						</div>
						<div class="texto">
						<p><?php the_excerpt(); ?></p>
						<a class="post" href="<?php echo get_permalink($post->ID);?>">Leer más</a>
						</div>
	<?php } ?>
</section>
<section id="content" role="main">
	<div class="publicaciones_bloc">
	<div class="headerpublicaciones">
		<a href="#">ÚLTIMAS PUBLICACIONES</a><a class="todas" href="#">VER TODAS</a>
	</div>
	<div class="blocpublicaciones">
	<?php $argspost = array('cat'=> 3, 'posts_per_page' => 4,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
						<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
						<a class="publicaciones" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
						<div class="titulo">
							<p><?php echo get_post_meta($post->ID, 'year', true); ?></p>
							<h1><?php the_title(); ?></h1>
						</div>
						<div class="texto">
						<?php the_excerpt(); ?>
						</div>
						</a>
					<?php endwhile; ?>
	<?php endif; wp_reset_query(); ?>
	</div>


	<div class="blocposts">
		<div id="colaboradores">
			<div class="headertitulo">
				<p>DE NUESTROS COLABORADORES</p>
			</div>
			<div class="bloccolaboradores">
			<?php $argspost = array('cat'=> 3, 'posts_per_page' => 4,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
								<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
								<div class="titulo">
									<h1><?php the_title(); ?></h1>
									<p class="tags"><?php the_tags(); ?></p>
									<p class="date"><?php echo get_post_meta($post->ID, 'year', true); ?></p>
									<a class="post" href="<?php the_permalink(); ?>">Más detalles</a>
								</div>
							<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
			</div>
		</div>

		<div id="eventos">
			<div class="headertitulo">
				<p>EVENTOS POR VENIR</p>
			</div>
			<div class="bloceventos">
			<?php $argspost = array('cat'=> 3, 'posts_per_page' => 4,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
								<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
								<div class="titulo">
									<h1><?php the_title(); ?></h1>
									<p class="tags"><?php the_tags(); ?></p>
								</div>
								<div class="texto">
								<?php the_excerpt(); ?>
								<a class="seguirleyendo" href="<?php the_permalink(); ?>">Seguir Leyendo</a>
								</div>
								</a>
							<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
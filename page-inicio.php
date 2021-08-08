<?php get_header(); ?>
<section id="portada">
	<?php
	$args = array(
	  'parent' => 5
	  );
	$categories = get_categories( $args );
	foreach ( $categories as $category ) { 
    $category_link = get_category_link( $category->term_id );?>
    					<div class="image-portada carousel-uno owl-carousel owl-theme">
    						<a href="<?php echo esc_url( $category_link ); ?>">
								<?php echo do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$category->term_id)); ?>
								</a>
							<?php $argsportada = array('cat'=> $category->term_id); $parentportada = new WP_Query( $argsportada ); if ( $parentportada->have_posts() ) : ?>
								<?php while ( $parentportada->have_posts() ) : $parentportada->the_post(); global $post; ?>
								<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
								</a>
							<?php endwhile; ?>
							<?php endif; wp_reset_query(); ?>
						</div>
					<!--div class="portadacontainer">
						<div class="titulo">
							<h1 class="category-name publicaciones"><?php echo $category->name ;?></h1>
						</div>
						<div class="texto">
						<p><?php echo category_description($category->term_id);; ?></p>
						<a class="post" href="<?php echo esc_url( $category_link ); ?>">Leer más</a>
						</div>
					</div-->
	<?php break; } ?>
</section>
<section id="content" role="main">
	<div class="publicaciones_bloc">
	<div class="headerpublicaciones">
		<a href="#">ÚLTIMAS PUBLICACIONES</a><a class="todas" href="<?php echo esc_url( home_url( '/' ) ); ?>publicamos">VER TODAS</a>
	</div>
	<div class="blocpublicaciones">
		<div class="carousel-dos owl-carousel owl-theme">
		<?php
			$args = array(
			  'orderby' => 'date',
			  'order'   => 'DESC',
			  'parent' => 5
			  );
			$categories = get_categories( $args );
			foreach ( $categories as $category ) {
		    $category_link = get_category_link( $category->term_id );
		    $image_id = get_term_meta ( $category->term_id, 'category-image-id', true );?>
						<a class="publicaciones" href="<?php echo esc_url( $category_link ); ?>">
						<?php echo wp_get_attachment_image ( $image_id, 'large' ); ?>
						<div class="titulo">
							<h1 class="category-name"><?php echo $category->name ;?></h1>
						</div>
						<div class="texto">
						<?php echo category_description($category->term_id); ?>
						</div>
						</a>
		<?php } ?>
		</div>
	</div>
	<div class="blocposts">
		<div id="colaboradores">
			<div class="headertitulo">
				<p>DE NUESTROS COLABORADORES</p>
				<a class="todas" href="<?php echo esc_url( home_url( '/' ) ); ?>category/presentamos/">VER TODO</a>
			</div>
			<div class="bloccolaboradores">
			<?php $argspost = array('cat'=> 6, 'posts_per_page' => 4,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
								<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
								<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?></a>
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
				<p>LO MÁS RECIENTE</p>
				<a class="todas" href="<?php echo esc_url( home_url( '/' ) ); ?>category/blog/">VER TODO</a>
			</div>
			<div class="bloceventos">
			<?php $argspost = array('cat'=> 8, 'posts_per_page' => 10,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
								<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
								<div class="imagecontainer">
								<a class="seguirleyendo" href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?>
								</a>
								</div>
								<div class="titulo">
									<h1><?php the_title(); ?></h1>
									<p class="tags"><?php the_tags(); ?></p>
								</div>
								<div class="texto">
								<a class="seguirleyendotext" href="<?php the_permalink(); ?>"><?php the_excerpt(); ?></a>
								<a class="post" href="<?php the_permalink(); ?>">Seguir Leyendo</a>
								</div>
							<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
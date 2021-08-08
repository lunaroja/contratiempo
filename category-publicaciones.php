<?php get_header(); ?>
<section id="portada">
	<?php echo do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$category->term_id)); ?>
</section>
<div id="migajas"><?php the_breadcrumb(); ?></div>
<section id="content" role="main">
<div class="blocposts">
		<div id="colaboradores">
		
			<?php 
			// Get the current category ID, e.g. if we're on a category archive page
			$category = get_category( get_query_var( 'cat' ) );
			 $cat_id = $category->cat_ID;
			// Get the image ID for the category
			$image_id = get_term_meta ( $cat_id, 'category-image-id', true );
			// Echo the image
			echo wp_get_attachment_image ( $image_id, 'large' ); ?>
			<h1 class="category-name publicaciones"><?php single_cat_title(); ?></h1>
			<?php if ( '' != category_description() ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . category_description() . '</div>' ); ?>
		</div>

		<div id="eventos">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="bloceventos">
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
								<a class="seguirleyendo" href="<?php the_permalink(); ?>">Seguir Leyendo</a>
								</div>
								</a>
							
			</div>
			<?php endwhile; endif; ?>
			<?php get_template_part( 'nav', 'below' ); ?>
		</div>
</div>
</section>
<?php get_footer(); ?>
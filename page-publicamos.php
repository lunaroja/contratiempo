<?php get_header(); ?>
<section id="portada">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
</section>
<div id="migajas"><?php the_breadcrumb(); ?></div>
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title"><?php the_title(); ?></h1>
</header>
<section class="entry-content page">
<?php the_content(); ?>
</section>
</article>
<?php endwhile; endif; ?>
<div class="blocpublicaciones">
		<?php
			$args = array(
			  'orderby' => 'date',
			  'order'   => 'DESC',
			  'posts_per_page' => -1,
			  'parent' => 5,
			  'hide_empty' => false
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
						<?php echo category_description($category->term_id);; ?>
						</div>
						</a>
		<?php } ?>
</div>
</section>
<?php get_footer(); ?>
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
<div class="blocposts">
		<div id="colaboradores">
			
		</div>

		<div id="eventos">
			<?php $argspost = array('cat'=> 7, 'posts_per_page' => -1,); $parentpost = new WP_Query( $argspost ); if ( $parentpost->have_posts() ) : ?>
								<?php while ( $parentpost->have_posts() ) : $parentpost->the_post(); global $post; ?>
			<div class="bloceventos">
								<div class="imagecontainer">
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } ?>
								</div>
								<div class="titulo">
									<h1><?php the_title(); ?></h1>
									<p class="tags"><?php the_tags(); ?></p>
								</div>
								<div class="texto">
								<?php the_excerpt(); ?>
								<a class="seguirleyendo" href="<?php the_permalink(); ?>">Seguir Leyendo</a>
								</div>
								</a>
			</div>
			<?php endwhile; ?>
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
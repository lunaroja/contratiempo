<?php get_header(); ?>
<section id="content" role="main">
<div class="blocposts">
		<div id="colaboradores">
			<?php echo get_avatar( get_the_author_meta( 'ID' ),  600 ); ?>
			<h1><?php the_author() ?></h1>
			<p class="authorPosition" ><?php echo esc_attr( get_the_author_meta( 'puesto', $user->ID ) ); ?></p>
			<div class="social">
			<?php if ( get_the_author_meta('instagram', $user->ID ) ) :  ?>
			<a target="_blank" href="https://www.instagram.com/<?php the_author_meta('instagram', $user->ID ); ?>"><i class="fab fa-instagram"></i></a>
			<?php endif; ?>
			<?php if ( get_the_author_meta('twitter', $user->ID ) ) :  ?>
			<a target="_blank" href="https://twitter.com/<?php the_author_meta('twitter', $user->ID ); ?>"><i class="fab fa-twitter"></i></a>
			<?php endif; ?>
			<?php if ( get_the_author_meta('facebook', $user->ID ) ) :  ?>
			<a target="_blank" href="https://facebook.com/<?php the_author_meta('facebook', $user->ID ); ?>"><i class="fab fa-facebook"></i></a>
			<?php endif; ?>
			</div>
			<?php if ( '' != get_the_author_meta( 'user_description' ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta"><p>' . get_the_author_meta( 'user_description' ) . '</p></div>' ); ?>
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
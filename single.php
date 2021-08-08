<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<section id="portada">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?>
</section>
<div id="migajas"><?php the_breadcrumb(); ?></div>
<section id="content" role="main">
<div class="singleautor">
	<div class="autorimage">
	<?php echo get_avatar( get_the_author_meta( 'ID' ),  600 ); ?>
	</div>
	<div class="contentautor">
		<div>
		<h1><?php the_author() ?></h1>
		<p><?php echo esc_attr( get_the_author_meta( 'puesto', get_the_author_meta( 'ID' ) ) ); ?></p>
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
		</div>
	</div>
</div>
<div class="contentsingle">
	<div class="contentsingleheader">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<p class="autorsingleheader"><?php the_time( get_option( 'date_format' ) ); ?></p>
		<p class="autorfoto"><?php echo get_post_meta( get_the_ID(), 'foto', true ); ?></p>
	</div>
	<div class="contentextsingle">
	<?php the_content(); ?>
	</div>
	<div class="footersingle">
	</div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
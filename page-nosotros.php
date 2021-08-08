<?php
/*
Template Name: Display Authors
*/

// Get all users order by amount of posts
$allUsers = get_users('orderby=post_count&order=DESC');

$users = array();

// Remove subscribers from the list as they won't write any articles
foreach($allUsers as $currentUser)
{
	if(!in_array( 'administrator', $currentUser->roles ))
	{
		$users[] = $currentUser;
	}
}

?>
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
<section class="content userslist" role="main">
	<?php foreach($users as $user) { ?>		
<div class="authorprofile">				
	<div class="authorAvatar"><a class="authorLinks" href="<?php echo get_author_posts_url( $user->ID ); ?>" ><?php echo get_avatar( $user->user_email, '600' ); ?></a></div>
	<div class="authorInfo" >
	<p class="authorPosition" ><?php echo esc_attr( get_the_author_meta( 'puesto', $user->ID ) ); ?></p>						
	<h2 class="authorName" ><?php echo $user->display_name; ?></h2>
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
	<p class="authorDescrption"><?php echo get_user_meta($user->ID, 'description', true); ?></p>	
	</div>
</div>
<?php } ?>
</section>

</section>
<?php get_footer(); ?>
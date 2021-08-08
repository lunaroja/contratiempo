<?php get_header(); ?>
<section id="portada">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
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
<!--section class="entry-content radio">
	<?php
	//$getJSON = file_get_contents("https://api.mixcloud.com/".$nickname."/cloudcasts/".$limit);
	$getJSON = wp_remote_retrieve_body( wp_remote_get( "https://api.mixcloud.com/lumpenradio/playlists/contratiempo-radio/cloudcasts/" ) );
	$data = json_decode($getJSON, TRUE);
	foreach ($data["data"] as $dataItem) {
		$keyMixCloud = urlencode($dataItem["key"]);
			$dom .= '<iframe width="100%" height="120" src="https://www.mixcloud.com/widget/iframe/?hide_cover=1&feed='.$keyMixCloud.'" frameborder="0" style="margin-bottom:50px"></iframe><br/>';

	}
	echo $dom;
	?>
</section-->
<?php get_footer(); ?>

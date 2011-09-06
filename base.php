<!DOCTYPE html>
<html {{ site.language_attributes }}>

<head>
<meta charset="{{ site.bloginfo('charset') }}" />
<title>{% block title %}{% endblock %}</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="{{ site.bloginfo('stylesheet_url') }}" />
<link rel="pingback" href="{{ site.bloginfo('pingback_url') }}" />
<!-- 
<?php

	ADD THIS TO THE WP_HEAD ACTION - NOT SURE WHY IT'S NOT THERE ALREADY

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

?>
-->
{#{ site.get_header }#}
</head>

<body {{ site.body_class() }}>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				{% block heading %}{% endblock %}
				<div id="site-description">{{ site.get_bloginfo('description','display') }}</div>
				<!--

				<?php

					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
					<?php endif; ?>
					
				-->
			</div>

			<div id="access" role="navigation">
				<div class="skip-link screen-reader-text"><a href="#content" title="Skip to content">Skip to content</a></div>
				{{ site.wp_nav_menu( {"container_class": "menu-header", "theme_location" : "primary"} ) }}
			</div>
		</div>
	</div>

	<div id="main">
		{% block content %}{% endblock %}
	</div>

	<div id="footer" role="contentinfo">
		<div id="colophon">
			{{ site.get_sidebar('footer') }}

			<div id="site-info">
				<a href="{{ site.esc_url(site.home_url('/'))}}" title="{{ site.bloginfo('name') }}" rel="home">
					{{ site.bloginfo('name') }}
				</a>
			</div>

			<div id="site-generator">
				<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">
					Proudly powered by WordPress
				</a>
			</div>
		</div>
	</div>
</div>

{#{ site.get_footer }#}

</body>

</html>
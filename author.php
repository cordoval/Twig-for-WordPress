{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
	
		<!-- AGAIN THIS IS PROBLEMATIC BECAUSE OF REWIND POSTS -->
	
		{% for post in posts %}
			<h1 class="page-title author">
				Author Archives:
				<span class="vcard">
					<a class="url fn n" href="{{ get_author_posts_url( get_the_author_meta( 'ID' ) ) }}" title="{{ get_the_author()|e }}" rel="me">{{ get_the_author() }}</a>
				</span>
			</h1>
	
			{% if ( get_the_author_meta( 'description' ) ) %}
				<div id="entry-author-info">
					<div id="author-avatar">
						<!-- Complex get avatar function again
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						-->
					</div>
					<div id="author-description">
						<h2>About {{ get_the_author() }}</h2>
						{{ the_author_meta( 'description' ) }}
					</div>
				</div>
			{% endif %}
		{% endfor %}

		{{ rewind_posts() }}

		{% include "loop.php" %}
	</div>
</div>

{% endblock %}

{{ get_sidebar() }}
{{ get_footer() }}
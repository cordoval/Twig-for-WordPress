{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		<h1 class="page-title author">
			Author Archives:
			<span class="vcard">
				<a class="url fn n" href="{{ get_author_posts_url( get_the_author_meta( 'ID' ) ) }}" title="{{ request.author|e }}" rel="me">{{ request.author }}</a>
			</span>
		</h1>

		{% if request.author.description %}
			<div id="entry-author-info">
				<div id="author-avatar">
					<!-- Complex get avatar function again
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
					-->
				</div>
				<div id="author-description">
					<h2>About {{ request.author }}</h2>
					{{ request.author.description }}
				</div>
			</div>
		{% endif %}

		{% include "loop.php" %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
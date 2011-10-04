{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		<h1 class="page-title author">
			Author Archives:
			<span class="vcard">
				<a class="url fn n" href="{{ site.get_author_posts_url( site.get_the_author_meta( 'ID' ) ) }}" title="{{ site.get_the_author_meta('nicename', site.get_the_author_meta('ID'))|e }}" rel="me">{{ site.get_the_author_meta('nicename', site.get_the_author_meta('ID'))|e }}</a>
			</span>
		</h1>

		{% if site.the_author_meta('description') is defined %}
			<div id="entry-author-info">
				<div id="author-avatar">
					{# Complex get avatar function again #}
					{% set gravatar = site.get_avatar( site.get_the_author_meta( 'user_email' ), site.apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ) %}
                    {% autoescape false %}
                        {{ gravatar }}
                    {% endautoescape %}
				</div>
				<div id="author-description">
					<h2>About {{ site.the_author_meta('nicename') }}</h2>
					{{ site.the_author_meta('description') }}
				</div>
			</div>
		{% endif %}

		{% include "loop.php" %}
	</div>
</div>

{{ site.get_sidebar() }}

{% endblock %}
{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{% for post in posts %}
			<div id="nav-above" class="navigation">
				<div class="nav-previous">{{ site.previous_post_link('%link', '<span class="meta-nav">&larr;</span> %title') }}</div>
				<div class="nav-next">{{ site.next_post_link('%link', '%title <span class="meta-nav">&rarr;</span>') }}</div>
			</div>
			
			<div id="post-{{ post.id }}" {{ site.post_class() }}>
				<h1 class="entry-title">{{ post.post_title }}</h1>

				<div class="entry-meta">
					<span class="meta-prep meta-prep-author">Posted on</span>
					<a href="{{ post.permalink }}" title="{{ post.date|date("h:i") }}" rel="bookmark">
						<span class="entry-date">{{ post.post|date("d/M/Y") }}</span>
					</a>
					<span class="meta-sep">by</span>
					<span class="author vcard">
						<a class="url fn n" href="{{ site.get_author_posts_url(site.get_the_author_meta('ID')) }}" title="View all posts by {{ post.author.name }}">
							<a href="{{ site.get_author_posts_url( post.post_author ) }}">{{ site.get_the_author_meta('nicename', post.post_author ) }}</a>

						</a>
					</span>
				</div>

				<div class="entry-content">
					{{ post.post_content }}
					{{ site.wp_link_pages({ 'before' : '<div class="page-link">Pages:', 'after' : '</div>' }) }}
				</div>

				{% if post.author.description %}
				<div id="entry-author-info">
					<div id="author-avatar">
						<!-- This is quite complex
						<?php echo site.get_avatar( site.get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						-->
					</div>
					<div id="author-description">
						<h2>About {{ post.author.name }}</h2>
						{{ post.author.description }}
						<div id="author-link">
							<a href="{{ site.get_author_posts_url( site.get_the_author_meta( 'ID' ) ) }}">
								View all posts by {{ post.author.name }} <span class="meta-nav">&rarr;</span>
							</a>
						</div>
					</div>
				</div>
				{% endif %}

				<div class="entry-utility">
					<!-- Expand this function
					<?php twentyten_posted_in(); ?>
					-->
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>

			<div id="nav-below" class="navigation">
				<div class="nav-previous">{{ site.previous_post_link('%link', '<span class="meta-nav">&larr;</span> %title') }}</div>
				<div class="nav-next"> {{ site.next_post_link('%link', '%title <span class="meta-nav">&rarr;</span>') }}</div>
			</div>

			{% include "comments.php" %}
		{% endfor %}
	</div>
</div>

{{ site.get_sidebar() }}

{% endblock %}
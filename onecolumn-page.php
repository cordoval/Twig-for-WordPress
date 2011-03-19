{% extends "base.php" %}

{% block content %}

<div id="container" class="one-column">
	<div id="content" role="main">		
		{% for post in posts %}
			<div id="post-<?php the_ID(); ?>" {{ post_class() }}>
				{% if is_front_page() %}
					<h2 class="entry-title">{{ post.post_title }}</h2>
				{% else %}
					<h1 class="entry-title">{{ post.post_title }}</h1>
				{% endif %}
	
				<div class="entry-content">
					{{ post.post_content }}
					{{ wp_link_pages({'before' : '<div class="page-link">Pages:', 'after' : '</div>'}) }}
					{{ edit_post_link('Edit', '<span class="edit-link">', '</span>') }}
				</div>
			</div>
	
			{% include "comments.php" %}
		{% endfor %}
	</div>
</div>

{% endblock %}
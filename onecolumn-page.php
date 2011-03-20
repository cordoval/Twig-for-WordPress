{% extends "base.php" %}

{% block content %}

<div id="container" class="one-column">
	<div id="content" role="main">		
		{% for post in posts %}
			<div id="post-{{ post.id }}" {{ post_class() }}>
				{% if request.is_front_page %}
					<h2 class="entry-title">{{ post.title }}</h2>
				{% else %}
					<h1 class="entry-title">{{ post.title }}</h1>
				{% endif %}
	
				<div class="entry-content">
					{{ post.content }}
					{{ wp_link_pages( {'before' : '<div class="page-link">Pages:', 'after' : '</div>'} ) }}
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>
	
			{% include "comments.php" %}
		{% endfor %}
	</div>
</div>

{% endblock %}
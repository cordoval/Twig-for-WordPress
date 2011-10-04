{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{% for post in posts %}
			<div id="post-{{ post.id }}" {{ site.post_class() }}>
				<h1 class="entry-title">{{ post.title }}</h1>
				<div class="entry-content">
					{{ post.content }}
					{{ site.wp_link_pages( {'before' : '<div class="page-link">Pages: ', 'after' : '</div>'} ) }}
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>
			
			{% include "comments.php" %}
		{% endfor %}
	</div>
</div>

{{ site.get_sidebar() }}

{% endblock %}
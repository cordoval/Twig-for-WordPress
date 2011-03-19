{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{% for post in posts %}
			<div id="post-{{ post.ID }}" {{ post_class() }}>
				<h1 class="entry-title">{{ post.post_title }}</h1>
				<div class="entry-content">
					{{ post.post_content }}
					{{ wp_link_pages({'before' : '<div class="page-link">Pages: ', 'after' : '</div>'}) }}
					{{ edit_post_link('Edit', '<span class="edit-link">', '</span>') }}
				</div>
			</div>
			
			{% include "comments.php" %}
		{% endfor %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
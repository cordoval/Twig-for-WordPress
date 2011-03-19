{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{#
	
			This is currently problematic due to the way
			WordPress normally starts going through the
			loop to get some information out and then
			rewinds the posts
	
		#}
	
		{% for post in posts %}
			<h1 class="page-title">
				{% if is_day() %}
					Daily Archives: <span>{{ post.post_date|date("d/M/Y") }}</span>
				{% elseif is_month() %}
					Monthly Archives: <span>{{ post.post_date|date("F Y") }}</span>
				{% elseif is_year() %}
					Yearly Archives: <span>{{ post.post_date|date("Y") }}</span>
				{% else %}
					Blog Archives
				{% endif %}
			</h1>
		{% endfor %}
	
		{{ rewind_posts() }}
	
		{% include "loop.php" %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
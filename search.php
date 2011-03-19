{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">	
		{% if posts %}
			<h1 class="page-title">Search Results for: <span>{{ get_search_query() }}</span></h1>
			{% include "loop.php" %}
		{% else %}
			<div id="post-0" class="post no-results not-found">
				<h2 class="entry-title">Nothing Found</h2>
				<div class="entry-content">
					<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
					{{ get_search_form() }}
				</div>
			</div>
		{% endif %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
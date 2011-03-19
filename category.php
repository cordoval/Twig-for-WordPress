{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{% for post in posts %}
			<h1 class="page-title">Category Archives: <span>{{ single_cat_title( '', false ) }}</span></h1>
			{% if category_description() %}
				<div class="archive-meta">{{ category_description() }}</div>
			{% endif %}
			{% include "loop.php" %}
		{% endfor %}
	</div>
</div>

{{ get_sidebar() }}
{{ get_footer() }}

{% endblock %}
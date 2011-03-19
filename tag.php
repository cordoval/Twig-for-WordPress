{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		<h1 class="page-title">
			Tag Archives: <span>{{ single_tag_title( '', false ) }}</span>
		</h1>
		{% include "loop.php" %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
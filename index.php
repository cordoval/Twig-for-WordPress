{% extends "base.php" %}

{% block content %}
<div id="container">
	<div id="content" role="main">
		{% include "loop.php" with {'posts': posts } %}
	</div>
</div>

{{ site.get_sidebar }}

{% endblock %}
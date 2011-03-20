{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		<h1 class="page-title">
			{% if request.is_day %}
				Daily Archives: <span>{{ request.date|date("d/M/Y") }}</span>
			{% elseif request.is_month %}
				Monthly Archives: <span>{{ request.date|date("F Y") }}</span>
			{% elseif request.is_year %}
				Yearly Archives: <span>{{ request.date|date("Y") }}</span>
			{% else %}
				Blog Archives
			{% endif %}
		</h1>
	
		{% include "loop.php" %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
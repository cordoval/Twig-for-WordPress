{% extends "base.php" %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		<h1 class="page-title">
			{% if request.is_day %}
				Daily Archives: <span>{{ site.date|date("d/M/Y") }}</span>
			{% elseif request.is_month %}
				Monthly Archives: <span>{{ site.date|date("F Y") }}</span>
			{% elseif request.is_year %}
				Yearly Archives: <span>{{ site.date|date("Y") }}</span>
			{% else %}
				Blog Archives
			{% endif %}
		</h1>
	
		{% include "loop.php" %}
	</div>
</div>

{{ site.get_sidebar() }}

{% endblock %}
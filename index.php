{% extends "base.php" %}

{% block title %}{{ site.name }} | {{ site.description }}{% endblock %}

{% block heading %}

	<h1 id="site-title">
		<span>
			<a href="{{ site.home }}" title="{{ site.name|e }}" rel="home">{{ site.name }}</a>
		</span>
	</h1>

{% endblock %}

{% block content %}

<div id="container">
	<div id="content" role="main">
		{% include "loop.php" %}
	</div>
</div>

{{ get_sidebar() }}

{% endblock %}
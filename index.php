{% extends "base.php" %}

{% block title %}{{bloginfo.name}} | {{bloginfo.description}}{% endblock %}

{% block heading %}
	<h1 id="site-title">
		<span>
			<a href="{{ home_url('/') }}" title="{{ bloginfo.name|e }}" rel="home">{{ bloginfo.name }}</a>
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
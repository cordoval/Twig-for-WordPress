{% extends "base.php" %}

{% block title %}{{ site.bloginfo('name') }} | {{ site.get_bloginfo('description','display') }}{% endblock %}

{% block heading %}

	<h1 id="site-title">
		<span>
			<a href="{{ site.esc_url(site.home_url('/')) }}" title="{{ site.bloginfo('name')|e }}" rel="home">{{ site.bloginfo('name') }}</a>
		</span>
	</h1>

{% endblock %}

{% block content %}
<div id="container">
	<div id="content" role="main">
		{% include "loop.php" with {'posts': posts } %}
	</div>
</div>

{{ site.get_sidebar }}

{% endblock %}
<!DOCTYPE html>
<html {{ site.language_attributes }}>

<head>
<meta charset="{{ site.bloginfo('charset') }}" />
<title>{% block title %}{{ site.bloginfo('name') }} | {{ site.get_bloginfo('description','display') }}{% endblock %}</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="{{ site.bloginfo('stylesheet_url') }}" />
<link rel="pingback" href="{{ site.bloginfo('pingback_url') }}" />
{% block extra_javascript %}
{% if ( site.is_singular() and site.get_option( 'thread_comments' ) ) %}
		{{ site.wp_enqueue_script( 'comment-reply' ) }}
{% endif %}
{% endblock %}
</head>

<body {{ site.body_class() }}>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				{% block heading %}
                	<h1 id="site-title">
		            <span>
			            <a href="{{ site.esc_url(site.home_url('/')) }}" title="{{ site.bloginfo('name')|e }}" rel="home">{{ site.bloginfo('name') }}</a>
		            </span>
	                </h1>
                {% endblock %}
				<div id="site-description">{{ site.get_bloginfo('description','display') }}</div>
			</div>

			<div id="access" role="navigation">
				<div class="skip-link screen-reader-text"><a href="#content" title="Skip to content">Skip to content</a></div>
				{{ site.wp_nav_menu( {"container_class": "menu-header", "theme_location" : "primary"} ) }}
			</div>
		</div>
	</div>

	<div id="main">
		{% block content %}{% endblock %}
	</div>

	<div id="footer" role="contentinfo">
		<div id="colophon">
			{{ site.get_sidebar('footer') }}

			<div id="site-info">
				<a href="{{ site.esc_url(site.home_url('/'))}}" title="{{ site.bloginfo('name') }}" rel="home">
					{{ site.bloginfo('name') }}
				</a>
			</div>

			<div id="site-generator">
				<a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">
					Proudly powered by WordPress
				</a>
			</div>
		</div>
	</div>
</div>

</body>

</html>
	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
                {# A sidebar in the footer? Yep. You can can customize
				  your footer with three columns of widgets.
				 #}
				{{ site.get_sidebar('footer') }}

			<div id="site-generator">
				{{ site.do_action('twentyeleven_credits') }}
				<a href="{{ site.esc_url(__( 'http://wordpress.org/', 'twentyeleven' )) }}" title="{{ site.esc_attr_e('Semantic Personal Publishing Platform', 'twentyeleven' ) }}" rel="generator">{{ site.printf( __( 'Proudly powered by %s', 'twentyeleven' ), 'WordPress' ) }}</a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

{{ site.wp_footer() }}

</body>
</html>
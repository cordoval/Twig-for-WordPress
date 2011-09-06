<!--
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous">{{ site.next_posts_link('<span class="meta-nav">&larr;</span> Older posts') }}</div>
		<div class="nav-next">{{ site.previous_posts_link('Newer posts <span class="meta-nav">&rarr;</span>') }}</div>
	</div>
<?php endif; ?>
-->

{% if posts %}

	{% for post in posts %}
		{% if post.format == "gallery" %}
			<div id="post-{{ post.id }}" {{ site.post_class() }}>
				<h2 class="entry-title"><a href="{{ site.post.permalink }}" title="Permalink to {{ site.post.post_title }}" rel="bookmark">{{ post.post_title }}</a></h2>
	
				<div class="entry-meta">
					<span class="meta-prep meta-prep-author">Posted on</span>
					<a href="{{ post.permalink }}" title="{{ post.post_date|date("h:i") }}" rel="bookmark"><span class="entry-date">{{ post.post_date|date("d/M/Y") }}</span></a>
					<span class="meta-sep">by</span>
					<span class="author vcard"><a class="url fn n" href="{{ post.author.url }}" title="View all posts by {{ post.author.name }}">{{ post.author.name }}</a></span>
				</div>
	
				<div class="entry-content">
					<!--
					<?php
						$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
						if ( $images ) :
							$total_images = count( $images );
							$image = array_shift( $images );
							$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
					?>
							<div class="gallery-thumb">
								<a class="size-thumbnail" href="{{ post.permalink }}"><?php echo $image_img_tag; ?></a>
							</div><!-- .gallery-thumb -->
							<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'twentyten' ),
									'href="' . get_permalink() . '" title="' . sprintf('Permalink to %s', the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
									number_format_i18n( $total_images )
								); ?></em></p>
					<?php endif; ?>
					-->
					{{ post.excerpt }}
				</div>
	
				<div class="entry-utility">
					<a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="View Galleries">More Galleries</a>
					<span class="meta-sep">|</span>
					<span class="comments-link">{{ site.comments_popup_link('Leave a comment', '1 Comment', '% Comments') }}</span>
					<span class="meta-sep">|</span>
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>
	
		{% elseif post.format == "aside" %}
			<div id="post-{{ post.id }}" {{ site.post_class() }}>
				{% if request.is_archive or request.is_search %}
					<div class="entry-summary">
						{{ post.excerpt }}
					</div>
				{% else %}
					<div class="entry-content">
						{{ post.content }}
					</div>
				{% endif %}
	
				<div class="entry-utility">
					<span class="meta-prep meta-prep-author">Posted on</span>
					<a href="{{ post.permalink }}" title="{{ post.date|date("h:i") }}" rel="bookmark"><span class="entry-date">{{ post.date|date("d/M/Y") }}</span></a>
					<span class="meta-sep">by</span>
					<span class="author vcard"><a class="url fn n" href="{{ post.author.url }}" title="View all posts by {{ post.author.name }}">{{ post.author.name }}</a></span>
					<span class="meta-sep">|</span>
					<span class="comments-link">{{ site.comments_popup_link('Leave a comment', '1 Comment', '% Comments') }}</span>
					<span class="meta-sep">|</span>
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>
	
		{% else %}
			<div id="post-{{ post.id }}" {{ site.post_class() }}>
				<h2 class="entry-title"><a href="{{ post.permalink }}" title="Permalink to {{ post.title }}" rel="bookmark">{{ post.title }}</a></h2>
	
				<div class="entry-meta">
					<span class="meta-prep meta-prep-author">Posted on</span>
					<a href="{{ post.permalink }}" title="{{ post.date|date("h:i") }}" rel="bookmark"><span class="entry-date">{{ post.date|date("d/M/Y") }}</span></a>
					<span class="meta-sep">by</span>
					<span class="author vcard"><a class="url fn n" href="{{ post.author.url }}" title="View all posts by {{ post.author.name }}">{{ post.author.name }}</a></span>
				</div>
	
				{% if request.is_archive or request.is_search %}
					<div class="entry-summary">
						{{ post.excerpt }}
					</div>
				{% else %}
					<div class="entry-content">
						{{ post.content }}
						{{ site.wp_link_pages({'before' : '<div class="page-link">Pages:', 'after' : '</div>'}) }}
					</div>
				{% endif %}
	
				<div class="entry-utility">
					{% if site.get_the_category_list() %}
						<span class="cat-links">
							<span class="entry-utility-prep entry-utility-prep-cat-links">Posted in</span> {{ site.get_the_category_list( ', ' ) }}
						</span>
						<span class="meta-sep">|</span>
					{% endif %}
	
					{% if site.get_the_tag_list( '', ', ' ) %}
						<span class="tag-links">
							<span class="entry-utility-prep entry-utility-prep-tag-links">Tagged</span> {{ site.get_the_tag_list() }}
						</span>
						<span class="meta-sep">|</span>
					{% endif %}
	
					<span class="comments-link">{{ site.comments_popup_link('Leave a comment', '1 Comment', '% Comments') }}</span>
					<span class="meta-sep">|</span>
					<span class="edit-link">{{ post.links.edit }}</span>
				</div>
			</div>
	
			{% include "comments.php" %}
		{% endif %}
	{% endfor %}

{% else %}
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<div class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			{#{ site.search }#}
		</div>
	</div>
{% endif %}

<!--
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div class="nav-previous"> {{ site.next_posts_link('<span class="meta-nav">&larr;</span> Older posts') }}</div>
		<div class="nav-next">{{ site.previous_posts_link('Newer posts <span class="meta-nav">&rarr;</span>') }}</div>
	</div>
<?php endif; ?>
-->
{% extends "base.php" %}

{% block content %}

<div id="container" class="single-attachment">
	<div id="content" role="main">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php if ( ! empty( $post->post_parent ) ) : ?>
			<p class="page-title">
				<a href="{{ site.get_permalink( post.post_parent ) }}" title="Return to {{ site.get_the_title( $post->post_parent ) }}" rel="gallery">
					<span class="meta-nav">&larr;</span> {{ get_the_title( post.post_parent ) }}
				</a>
			</p>
		<?php endif; ?>

		<div id="post-{{ post.ID }}" {{ post_class() }}>
			<h2 class="entry-title">{{ post.post_title }}</h2>

			<div class="entry-meta">
				<span class="meta-prep meta-prep-author">By</span>
				<span class="author vcard"><a class="url fn n" href="{{ get_author_posts_url( get_the_author_meta( 'ID' ) ) }}" title="View all posts by {{ get_the_author() }}">{{ get_the_author() }}</a></span>
				<span class="meta-sep">|</span>

				<span class="meta-prep meta-prep-entry-date">Published</span>
				<span class="entry-date"><abbr class="published" title="{{ post.post_date|date("h:i") }}">{{ post.post_date|date("d/M/Y") }}</abbr></span>

				<?php
					if ( wp_attachment_is_image() ) {
						echo ' <span class="meta-sep">|</span> ';
						$metadata = wp_get_attachment_metadata();
						printf('Full size is %s pixels',
							sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
								wp_get_attachment_url(),
								'Link to full-size image',
								$metadata['width'],
								$metadata['height']
							)
						);
					}
				?>
				{{ edit_post_link('Edit', '<span class="meta-sep">|</span> <span class="edit-link">', '</span>') }}
			</div>

			<div class="entry-content">
				<div class="entry-attachment">
					<?php
						if ( wp_attachment_is_image() ) :
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID )
							break;
						}
						$k++;
						// If there is more than 1 image attachment in a gallery
						if ( count( $attachments ) > 1 ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
						} else {
						// or, if there's only 1 image attachment, get the URL of the image
						$next_attachment_url = wp_get_attachment_url();
						}
					?>
					<p class="attachment">
						<a href="<?php echo $next_attachment_url; ?>" title="{{ post.post_title }}" rel="attachment">
							<?php
								$attachment_width  = apply_filters( 'twentyten_attachment_size', 900 );
								$attachment_height = apply_filters( 'twentyten_attachment_height', 900 );
								echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) );
							?>
						</a>
					</p>

					<div id="nav-below" class="navigation">
						<div class="nav-previous"><?php previous_image_link( false ); ?></div>
						<div class="nav-next"><?php next_image_link( false ); ?></div>
					</div>
				<?php else : ?>
					<a href="<?php echo wp_get_attachment_url(); ?>" title="{{ post.post_title }}" rel="attachment"><!-- <?php echo basename( get_permalink() ); ?> --></a>
				<?php endif; ?>
			</div>

			<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>

			{{ the_content('Continue reading <span class="meta-nav">&rarr;</span>') }}
			{{ wp_link_pages({'before' : '<div class="page-link">Pages:', 'after' : '</div>'}) }}
		</div>

		<div class="entry-utility">
			<!--
			<?php twentyten_posted_in(); ?>
			-->
			{{ edit_post_link('Edit', ' <span class="edit-link">', '</span>' ) }}
		</div>
	</div>

			{% include "comments.php" %}
		<?php endwhile; ?>
	</div>
</div>
		
{% endblock %}
<div id="comments">
	{% if post.comments %}
		<h3 id="comments-title">
			{{ post.comments | length }} Response(s) to <em>{{ post.title }}</em>
		</h3>

		<ol class="commentlist">
			{% for comment in post.comments %}
				{% if comment.type == "normal" %}
					<li {{ comment_class() }} id="li-comment-{{ comment.id }}">
						<div id="comment-{{ comment.id }}">
							<div class="comment-author vcard">
								<!--<?php echo get_avatar( $comment, 40 ); ?>-->
								<cite class="fn">{{ comment.author }}</cite> <span class="says">says:</span>
							</div>
					
							{% if comment.approved %}
								<div class="comment-meta commentmetadata">
									<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<!--<?php
										/* translators: 1: date, 2: time */
										printf( __( '%1$s at %2$s', 'twentyten' ), get_comment_date(),  get_comment_time() );
									?>-->
									</a>
									<!--<?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?>-->
								</div>
					
								<div class="comment-body">{{ comment.content }}</div>
					
								<div class="reply">
									<!--<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>-->
								</div>
							{% else %}
								<em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
							{% endif %}
						</div>
					</li>
				{% else %}
					<li class="post pingback">
						<p>Pingback: <!--<?php comment_author_link(); ?> --><!-- <?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?>--></p>
					</li>
				{% endif %}
			{% endfor %}
		</ol>
	{% else %}
		<p class="nocomments">There are no comments.</p>
	{% endif %}

	{% if request.is_single %}
		{{ comment_form() }}
	{% endif %}
</div>
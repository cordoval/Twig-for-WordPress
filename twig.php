<?php

class TWIG_Site {
	public function __get($property) {
		switch($property):
			case 'search':
				get_search_form();
				break;
			case 'home':
				get_home_url();
				break;
			case 'head':
				wp_head();
				break;
			case 'foot':
				wp_footer();
				break;
			case 'language':
				language_attributes();
				break;
			default:
				return get_bloginfo($property);
				break;
		endswitch;
	}
	
	public function __isset($property) {
		return true;
	}
	
	public function getMenu() {
		wp_nav_menu();
	}
	
	public function getSidebar() {
		get_sidebar();
	}
}

class TWIG_Request {

	private $author;

	public function __construct($query) {
		$this->is_single = $query->is_single;
		$this->is_preview = $query->is_preview;
		$this->is_page = $query->is_page;
		$this->is_archive = $query->is_archive;
		$this->is_date = $query->is_date;
		$this->is_year = $query->is_year;
		$this->is_month = $query->is_month;
		$this->is_day = $query->is_day;
		$this->is_time = $query->is_time;
		$this->is_author = $query->is_author;
		$this->is_category = $query->is_category;
		$this->is_tag = $query->is_tag;
		$this->is_search = $query->is_search;
		$this->is_feed = $query->is_feed;
		$this->is_comment_feed = $query->is_comment_feed;
		$this->is_trackback = $query->is_trackback;
		$this->is_home = $query->is_home;
		$this->is_404 = $query->is_404;
		$this->is_comments_popup = $query->is_comments_popup;
		$this->is_paged = $query->is_paged;
		$this->is_admin = $query->is_admin;
		$this->is_attachment = $query->is_attachment;
		$this->is_singular = $query->is_singular;
		$this->is_robots = $query->is_robots;
		$this->is_posts_page = $query->is_posts_page;
		$this->is_post_type_archive = $query->is_post_type_archive;
		
		if(count($query->posts)):
			$this->date = $query->posts[0]->post_date;
			$this->author = $query->posts[0]->post_author;
		endif;
	}
	
	public function getAuthor() {
		if(is_int($this->author)):
			$this->author = new TWIG_Author($this->author);
		endif;
		return $this->author;
	}
	
	/* Need to implement some kind of next posts, previous
	posts link in here. Or some kind of proper pagination */
}

class TWIG_Author {

	private $id;
	private $mappings = array(
		'login' => 'user_login',
		'pass' => 'user_pass',
		'nicename' => 'user_nicename',
		'email' => 'user_email',
		'registered' => 'user_registered',
		'activation_key' => 'user_activation_key',
		'status' => 'user_status',
		'name' => 'display_name',
		'id' => 'ID',
	);

	public function __construct($id) {
		$this->id = $id;
		$this->url = get_author_posts_url($this->id);
	}
	
	public function __get($field) {
		if(array_key_exists($field, $this->mappings)):
			return get_the_author_meta($this->mappings[$field], $this->id);
		else:
			return get_the_author_meta($field, $this->id);
		endif;
	}
	
	public function __isset($field) {
		return true;
	}
	
	public function __toString() {
		return $this->__get('name');
	}

}

class Twig_Post {

	private $id;
	private $title;
	private $excerpt;
	private $status;
	private $date;
	private $content;
	
	private $guid;
	private $permalink;

	private $type;
	private $format;
	
	private $author;
	
	private $comments;
	
	private $categories;
	private $tags;
	
	private $links;
	
	public function __construct($post) {
		$this->id = $post->ID;
		$this->title = $post->post_title;
		$this->excerpt = $post->post_excerpt;
		$this->status = $post->post_status;
		// Not sure how we deal with time zones here
		$this->date = $post->post_date;
		$this->content = $post->post_content;
		
		$this->guid = $post->guid;
		$this->permalink = get_permalink($this->id);
		
		$this->type = $post->post_type;
		$this->format = get_post_format($post->ID);
		
		$this->author = (int)$post->post_author;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getExcerpt() {
		return $this->excerpt;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function getPermalink() {
		return $this->permalink;
	}
	
	public function getFormat() {
		return $this->format;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function getComments() {
		if(is_null($this->comments)):
			$this->comments = get_comments(
				array('post_id' => $this->id)
			);
		endif;
		return $this->comments;
	}
	
	public function getAuthor() {
		if(is_int($this->author)):
			$this->author = new TWIG_Author($this->author);
		endif;
		return $this->author;
	}
	
	public function getCategories() {
		if(is_null($this->categories)):
			$this->categories = get_the_category($this->id);
		endif;
		return $this->categories;
	}

	public function getTags() {
		if(is_null($this->tags)):
			$this->tags = get_the_tags($this->id);
		endif;
		return $this->tags;
	}
	
	public function __toString() {
		return $this->content;
	}

	public function getLinks() {
		if(!is_array($this->links)):
			$this->links = array(
				'edit' => edit_post_link(NULL, NULL, NULL, $this->id),
				// Next and previous post links won't work outside of the loop
				'next' => '',
				'previous' => ''
			);
		endif;
		return $this->links;
	}

}

class TWIG_Category {
	
	private $id;
	private $name;
	private $slug;
	private $description;
	private $parent;
	private $count;

	public function __construct($cat) {
		$this->id = $cat->term_id;
		$this->name = $cat->name;
		$this->slug = $cat->slug;
		$this->description = $cat->description;
		$this->parent = $cat->parent;
		$this->count = $cat->count;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getSlug() {
		return $this->slug;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getParent() {
		if(!is_object($this->parent) && $this->parent):
			$parent = get_category($this->parent);
			$this->parent = new TWIG_Category($parent);
		endif;
		return $this->parent;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function toString() {
		return $this->name;
	}
}

class TWIG_Tag {

	private $id;
	private $name;
	private $slug;
	private $description;
	private $count;
	
	public function __construct($tag) {
		$this->id = $tag->term_id;
		$this->name = $tag->name;
		$this->slug = $tag->slug;
		$this->description = $tag->description;
		$this->count = $tag->count;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function getSlug() {
		return $this->slug;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function __toString() {
		return $this->name;
	}

}

class TWIG_Comment {
	
	private $id;
	private $author;
	private $date;
	private $content;
	private $approved;
	private $agent;
	private $type;
	private $parent;
	
	public function __construct($comment) {
		$this->id = $comment->comment_ID;
		// Author needs special attention
		$this->date = $comment->comment_date;
		$this->content = $comment->comment_content;
		$this->approved = $comment->comment_approved;
		$this->agent = $comment->comment_agent;
		$this->type = $comment->comment_type || 'normal';
		$this->parent = $comment->comment_parent;
	}

	public function getId() {
		return $this->id;
	}
	
	public function getDate() {
		return $this->date;
	}
	
	public function getContent() {
		return $this->content;
	}
	
	public function getApproved() {
		return $this->approved;
	}
	
	public function getAgent() {
		return $this->agent;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getParent() {
		if(!is_object($this->parent) && $this->parent):
			$parent = get_comment($this->parent);
			$this->parent = new TWIG_Comment($parent);
		endif;
		return $this->parent;
	}
	
	public function __toString() {
		return $this->content;
	}
}

use Sf2Plugins\TwigPlugin;

function twigTemplates($wpTemplate) {
	/*global $wp_query;
	
	// Configure site
	$site = new TWIG_Site();
	
	// Configure request
	$request = new TWIG_Request($wp_query);
	
	// Configure posts
	$posts = $wp_query->posts;
	for($p = 0; $p < count($posts); $p++):
		$posts[$p] = new TWIG_Post($posts[$p]);
	endfor;
	
	// Setup Twig environment
	require_once(dirname($wpTemplate).'/lib/Twig/Autoloader.php');
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem(dirname($wpTemplate));
	$twig = new Twig_Environment($loader, array(
		'cache' => false
	));

	
	// Pass required WordPress functions through
	// Aim is to reduce this as much as possible by using above classes
	$twig->addFunction('wp_nav_menu', new Twig_Function_Function('wp_nav_menu'));
	$twig->addFunction('get_sidebar', new Twig_Function_Function('get_sidebar'));
	$twig->addFunction('wp_link_pages', new Twig_Function_Function('wp_link_pages'));
	$twig->addFunction('wp_previous_post_link', new Twig_Function_Function('wp_previous_post_link'));
	$twig->addFunction('wp_next_post_link', new Twig_Function_Function('wp_next_post_link'));
	$twig->addFunction('next_posts_link', new Twig_Function_Function('next_posts_link'));
	$twig->addFunction('previous_posts_link', new Twig_Function_Function('previous_posts_link'));
	$twig->addFunction('next_post_link', new Twig_Function_Function('next_post_link'));
	$twig->addFunction('previous_post_link', new Twig_Function_Function('previous_post_link'));
	$twig->addFunction('body_class', new Twig_Function_Function('body_class'));
	$twig->addFunction('post_class', new Twig_Function_Function('post_class'));
	$twig->addFunction('get_avatar', new Twig_Function_Function('get_avatar'));
	$twig->addFunction('comments_popup_link', new Twig_Function_Function('comments_popup_link'));
	$twig->addFunction('get_the_category_list', new Twig_Function_Function('get_the_category_list'));
	$twig->addFunction('get_author_posts_url', new Twig_Function_Function('get_author_posts_url'));
	$twig->addFunction('get_the_author_meta', new Twig_Function_Function('get_the_author_meta'));
	$twig->addFunction('get_the_author', new Twig_Function_Function('get_the_author'));
	$twig->addFunction('get_the_tag_list', new Twig_Function_Function('get_the_tag_list'));
	$twig->addFunction('single_tag_title', new Twig_Function_Function('single_tag_title'));
	$twig->addFunction('single_cat_title', new Twig_Function_Function('single_cat_title'));
	$twig->addFunction('get_search_query', new Twig_Function_Function('get_search_query'));
	$twig->addFunction('comment_class', new Twig_Function_Function('comment_class'));
	$twig->addFunction('comment_form', new Twig_Function_Function('comment_form'));
	$twig->addFunction('category_description', new TWIG_Function_Function('category_description'));

	// Load the template file in
	$template = $twig->loadTemplate(basename($wpTemplate));
	
	// Render the template, passing in our Twig objects
	echo $template->render(
		array(
			'site' => $site,
			'request' => $request,
			'posts' => $posts
		)
	);
	exit;*/
    global $wp_query;

    $site = new TwigPlugin();

    $posts = $wp_query->posts;

    $loader = new Twig_Loader_Filesystem(__DIR__);
    $twig = new Twig_Environment($loader, array(
            'cache' => false,
        ));
    $twig->enableDebug();
    $template = $twig->loadTemplate(basename($wpTemplate));
    $template->display(array('site' => $site, 'posts' => $posts));
}

add_action('template_include', 'twigTemplates');
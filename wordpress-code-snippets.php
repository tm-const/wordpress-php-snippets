*******************************
Config file **************************************
*******************************
1. Increase Memory Limit
define('WP_MEMORY_LIMIT', '96M');

2. Empty Trash Automatically
define('EMPTY_TRASH_DAYS', 5 );

Block Bad Users From Accessing Your WordPress:

Order Allow,Deny
Deny from all

------OR------

order allow,deny
deny from 192.168.1.2
deny from 10.130.130.6
deny from 172.16.130.106
allow from all

*******************************
Authentication Unique Keys and Salts
*******************************

URL: https://api.wordpress.org/secret-key/1.1/salt/
<!--
define('AUTH_KEY',         '|B `gXmdr;v:m<KqDgDWiAPhAw-hy+g1?U^xyA+s]- :(M$uns^RunWojgSWR4 7');
define('SECURE_AUTH_KEY',  'gLBtj+2%SKJmmJf5|F$ky93t,WC.#pmf}Rx|u3NEUFg}*=]K>FYy;fI!/v8F)Wr0');
define('LOGGED_IN_KEY',    'z`5bsV,!Tt$aOLN&]96Xz2z_BBokJN0W3S>;YP:OH19)]?;DWE|TMU)DDzZ{lpNU');
define('NONCE_KEY',        '|^yQy5k4Lt5%N8m1DxmW]tD#o7E~hKlp<l*C>:7Z0`gr{~#G/yimk_rrcTO+D#+H');
define('AUTH_SALT',        'Ld+s}7F.ihu)4p(ll<>D{tW-QbS$*k0;g8=Nx7@DsPS|Q8i%v*T^r|Ztg)G|39y6');
define('SECURE_AUTH_SALT', 'v`-HbT1X!R5x>%|V,Rz^:BrLN!^p<xl+%@|ztx!Ij3Rr9,x|4V7kqs$FDe@^?RtL');
define('LOGGED_IN_SALT',   '^%|fG1rp2,9zeV,< CGXU+@07J.+XoY3K9c:YY0@/<^9lh0VE/--!aGR:-Y|kFm,');
define('NONCE_SALT',       '!~+[>H_>4]rbzJ?nbI,t;#AXcc0ysPO!99&A6szV`Z<R`Q!?/79_MyG<]D/e/|/h'); 
-->

*******************************
WordPress Database Table prefix
*******************************

The default value, as seen below, is “wp_”:

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

*******************************
Automated Trash
*******************************

define('EMPTY_TRASH_DAYS', 7); // empty weekly

define('EMPTY_TRASH_DAYS', 0); // disable trash

*******************************
Blog Address and Site Address
*******************************

define('WP_HOME', 'https://digwp.com'); // no trailing slash
define('WP_SITEURL', 'https://digwp.com');  // no trailing slash

*******************************
Debugging WordPress
*******************************

define('WP_DEBUG', true); // debugging mode: 'true' = enable; 'false' = disable

*******************************
Increase PHP Memory
*******************************

define('WP_MEMORY_LIMIT', '64M');
define('WP_MEMORY_LIMIT', '96M');
define('WP_MEMORY_LIMIT', '128M');

*******************************
Make URLs SEO-friendly and future-proof
*******************************

<Files magic>
	ForceType application/x-httpd-php5
</Files>

*******************************
Improve caching for better site speed
*******************************

<FilesMatch ".(flv|gif|jpg|jpeg|png|ico|swf|js|css|pdf)$">
	Header set Cache-Control "max-age=28800"
</FilesMatch>

*******************************
GZIP compression - make your site load faster
*******************************

<ifModule mod_gzip.c>
mod_gzip_on Yes
  mod_gzip_dechunk Yes
  mod_gzip_item_include file \.(html?|txt|css|js|php|pl)$
  mod_gzip_item_include handler ^cgi-script$
  mod_gzip_item_include mime ^text/.*
  mod_gzip_item_include mime ^application/x-javascript.*
  mod_gzip_item_exclude mime ^image/.*
  mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
</ifModule>

*******************************
Redirect 301
*******************************

Redirect 301 / http://www.newsite.com/
Redirect 301 /old.htm /new.htm

Make sure Keep-Alive is turned on in your server config.
<ifModule mod_headers.c> Header set Connection keep-alive </ifModule>

*******************************

*******************************



*******************************
Redirect 301
*******************************


3. Filter the Loop
<?php
	query_posts('
		showposts=5&amp;
		category_name=featured'
	);

	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p><?php the_content(); ?></p>
	<?php
	endwhile; else:
	endif;
	wp_reset_query();
?>

4. Loop within a loop

<?php
	if (have_posts()) :

	while (have_posts()) : the_post(); // the post loop
	$temp_query = $wp_query; // store it
	$args = array(
	'paged' => $paged, // paginates
	'post_type'=>'post',
	'posts_per_page' => 3,
	'order' => 'DESC'
	);
	$wp_query = new WP_Query($args);

	while ($wp_query->have_posts()) : $wp_query->the_post();
	// -- your new loop -- //
	>endwhile;

	if (isset($wp_query)) {$wp_query = $temp_query;} // restore loop
	>endwhile;

	endif;
?>

5. Detect Browser

<?php 
	add_filter('body_class','browser_body_class');
	function browser_body_class($classes) {

		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx) $classes[] = 'lynx';

		elseif($is_gecko) $classes[] = 'gecko';

		elseif($is_opera) $classes[] = 'opera';

		elseif($is_NS4) $classes[] = 'ns4';

		elseif($is_safari) $classes[] = 'safari';

		elseif($is_chrome) $classes[] = 'chrome';

		elseif($is_IE) $classes[] = 'ie';

		else $classes[] = 'unknown';

		if($is_iphone) $classes[] = 'iphone';

		return $classes;
	}
?>

6. Detect Mobile Users

<?php 
include('mobile_device_detect.php');
$mobile = mobile_device_detect();

if ($mobile==true) {
	header( 'Location: http://your-website.com/?theme=Your_Mobile_Theme' ) ;
}
?>

7. Leverage Browser Caching using .htaccess

<?php 
## EXPIRES CACHING ##
ExpiresActive On
ExpiresByType image/jpg "access 1 year"
ExpiresByType image/jpeg "access 1 year"
ExpiresByType image/gif "access 1 year"
ExpiresByType image/png "access 1 year"
ExpiresByType text/css "access 1 month"
ExpiresByType application/pdf "access 1 month"
ExpiresByType text/x-javascript "access 1 month"
ExpiresByType application/x-shockwave-flash "access 1 month"
ExpiresByType image/x-icon "access 1 year"
ExpiresDefault "access 2 days"
## EXPIRES CACHING ##
?>

8. Include jQuery the right way

<?php wp_enqueue_script("jquery"); ?>

10. Simpler Login Address

<?php 
RewriteRule ^login$ http://yoursite.com/wp-login.php [NC,L]
?>

11. Limit Post Revisions

<?php
	# Maximum 5 revisions #
	define('WP_POST_REVISIONS', 5);
	# Disable revisions #
	define('WP_POST_REVISIONS', false);
?>

12. Set Autosave time

<?php
	# Autosave interval set to 5 Minutes #
	define('AUTOSAVE_INTERVAL', 300);
?>

13. Branding
<?php
	function my_custom_login_logo() {
	echo '<style type="text/css">
	h1 a { background-image:url('.get_bloginfo('template_directory').'/images/custom-login-logo.gif) !important; }
	</style>';
	}
	add_action('login_head', 'my_custom_login_logo');
?>


14. Change Admin Logo

<?php
	function custom_admin_logo() {
	echo '<style type="text/css">
	#header-logo { background-image: url('.get_bloginfo('template_directory').'/images/admin_logo.png) !important; }
	</style>';
	}
	add_action('admin_head', 'custom_admin_logo');
?>

15. Change Footer Text in WP Admin

<?php
	function remove_footer_admin () {
	echo 'Siobhan is Awesome. Thank you <a href="http://wordpress.org">WordPress</a> for giving me this filter.';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
?>

16. Dynamic Copyright Date in Footer

<?php
	function comicpress_copyright() {

	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';

	if($copyright_dates) {
	$copyright = "&copy; " . $copyright_dates[0]->firstdate;

	if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
	$copyright .= '-' . $copyright_dates[0]->lastdate;
	}
	$output = $copyright;
	}

	return $output;
	}
?>

<!-- Then insert this into your footer: -->

<?php echo comicpress_copyright(); ?>

17.Add Favicon

<span style="font-weight: normal;"> </span>
<!-- // add a favicon to your -->
<?php
	function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
	}
	add_action('wp_head', 'blog_favicon');
?>

18. Remove Menus in WordPress Dashboard

<?php
	function remove_menus () {

	global $menu;
	$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);

	while (prev($menu)){
	$value = explode(' ',$menu[key($menu)][0]);

	if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
	}
	add_action('admin_menu', 'remove_menus');
?>

19. Hide update message

<?php
	add_action('admin_menu','wphidenag');
	function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
	}
?>

20. WordPress Relative Date

<!-- # For posts &amp; pages # -->
<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
# For comments #
<?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; ?>

<!-- *------------------ -->
Navigation
<!-- *------------------ -->
21. Automatically Add a Search Box to Your Nav Menu
<?php 
	add_filter('wp_nav_menu_items','add_search_box', 10, 2);
	function add_search_box($items, $args) {
	ob_start();
	get_search_form();
	$searchform = ob_get_contents();
	ob_end_clean();
	$items .= '<li>' . $searchform . '</li>';

	return $items;
	}
?>

22. Breadcrumbs without a plugin

<!-- function.php -->
<?php 
	function the_breadcrumb() {
	echo '<ul id="crumbs">';

	if (!is_home()) {
	echo '<li><a href="';
	echo get_option('home');
	echo '">';
	echo 'Home';
	echo "</a></li>";

	if (is_category() || is_single()) {
	echo '<li>';
	the_category(' </li><li> ');

	if (is_single()) {
	echo "</li><li>";
	the_title();
	echo '</li>';
	}
	} elseif (is_page()) {
	echo '<li>';
	echo the_title();
	echo '</li>';
	}
	}

	elseif (is_tag()) {single_tag_title();}

	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}

	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}

	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}

	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}

	elseif (isset($_GET['paged']) &amp;&amp; !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}

	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	echo '</ul>';
	}
?>

<!-- Insert into header.php -->
<?php the_breadcrumb(); ?>

23. Pagination
<!-- Want pagination at the bottom of your blog? Insert this into your functions.php -->

<?php
	function my_paginate_links() {

	global $wp_rewrite, $wp_query;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
	$pagination = array(
	'base' => @add_query_arg('paged','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'prev_text' => __('« Previous'),
	'next_text' => __('Next »'),
	'end_size' => 1,
	'mid_size' => 2,
	'show_all' => true,
	'type' => 'list'
	);

	if ( $wp_rewrite->using_permalinks() )
	$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if ( !empty( $wp_query->query_vars['s'] ) )
	$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
	echo paginate_links( $pagination );
	}
?>

<!-- #----------------- -->
Analytics
<!-- #----------------- -->

24. Google Analytics Without Editing Theme

<?php
	add_action('wp_footer', 'ga');
	function ga() { ?>
	<!-- // Paste your Google Analytics code here -->
<?php } ?>

<!-- #__________________ -->
Search
<!-- #__________________ -->

25. Highlight search terms

<!-- This is a nice one. Power up your search functionality by highlighting the search term in the results.
Open search.php and find the the_title() function
Replace with: -->

<?php 
echo $title;
?>

<!-- Above the modified line add: -->
<?php
	<span style="white-space: pre;"> </span>$title <span style="white-space: pre;"> </span>= get_the_title();
	<span style="white-space: pre;"> </span>$keys= explode(" ",$s);
	<span style="white-space: pre;"> </span>$title <span style="white-space: pre;"> </span>= preg_replace('/('.implode('|', $keys) .')/iu',
	<span style="white-space: pre;"> </span>'<strong class="search-excerpt">\0</strong>',
	<span style="white-space: pre;"> </span>$title);
?>

<!-- Add the following to your style.css. Add: -->
<style>
	strong.search-excerpt { background: yellow; }
</style>

26. Exclude Posts and Pages from Search Results

<!-- Sometimes you don’t want all of your posts and pages appearing in your search results. Use this snippet to shun whichever ones you want. -->
<!-- // search filter -->
<?php
	function fb_search_filter($query) {

	if ( !$query->is_admin &amp;&amp; $query->is_search) {
	$query->set('post__not_in', array(40, 9) ); // id of page or post
	}

	return $query;
	}
	add_filter( 'pre_get_posts', 'fb_search_filter' );
?>
<!-- To exclude the subpage of a page you need to add it to the IS: -->
<!-- // search filter -->
<?php
	function fb_search_filter($query) {

	if ( !$query->is_admin &amp;&amp; $query->is_search) {
	$pages = array(2, 40, 9); // id of page or post
	// find children to id
	>foreach( $pages as $page ) {
	$childrens = get_pages( array('child_of' => $page, 'echo' => 0) );
	}
	// add id to array
	>for($i = 0; $i < sizeof($childrens); ++$i) { $pages[] = $childrens[$i]->ID;
	}
	$query->set('post__not_in', $pages );
	}

	return $query;
	}
	add_filter( 'pre_get_posts', 'fb_search_filter' );
?>

27. Disable WordPress Search

<?php
	function fb_filter_query( $query, $error = true ) {

	if ( is_search() ) {
	$query->is_search = false;
	$query->query_vars[s] = false;
	$query->query[s] = false;
	// to error
	>if ( $error == true )
	$query->is_404 = true;
	}
	}
	add_action( 'parse_query', 'fb_filter_query' );
	add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
?>

<!-- #------------- -->
Posts
<!-- #------------- -->

28. Set a Maximum Word Count on Post Titles

<!-- Manage a blog with multiple users? Use this snippet to set a maximum word count on your titles. -->
<?php
	function maxWord($title){

	global $post;
	$title = $post->post_title;

	if (str_word_count($title) >= 10 ) //set this to the maximum number of words
	wp_die( __('Error: your post title is over the maximum word count.') );
	}
	add_action('publish_post', 'maxWord');
?>

29. Set Minimum Word Count on Posts

<?php
	function minWord($content){

	global $post;
	$num = 100; //set this to the minimum number of words
	$content = $post->post_content;

	if (str_word_count($content) < $num) wp_die( __('Error: your post is below the minimum word count.') ); } add_action('publish_post', 'minWord');
?>

30. Display Incremental Numbers Next to Each Published Post

<!-- This snippet lets you add numbers beside your posts. You could use Article 1, Article 2, Article 3; or Post 1, Post 2, Post 3; or whatever you want.

Add this to your functions: -->

<?php
	function updateNumbers() {

	global $wpdb;
	$querystr = "SELECT $wpdb->posts.* FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'post' ";
	$pageposts = $wpdb->get_results($querystr, OBJECT);
	$counts = 0 ;

	if ($pageposts):

	foreach ($pageposts as $post):
	setup_postdata($post);
	$counts++;
	add_post_meta($post->ID, 'incr_number', $counts, true);
	update_post_meta($post->ID, 'incr_number', $counts);

	endforeach;

	endif;
	}
	add_action ( 'publish_post', 'updateNumbers' );
	add_action ( 'deleted_post', 'updateNumbers' );
	add_action ( 'edit_post', 'updateNumbers' );
?>
<!-- Then add this within the loop: -->
<?php echo get_post_meta($post->ID,'incr_number',true); ?>

31. Shorten the excerpt

<!-- Think the excerpt is too long? Use this snippet to shorten it. This shortens it to 20 words. -->
<?php
	function new_excerpt_length($length) {

	return 20;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
?>

<!-- #-------- -->
Lists of Posts
<!-- #-------- -->

32. Lists of Posts

<!-- Display Random Posts:
Shows a nice list of some random posts. Stop your long lost posts from being forgotten. Paste this wherever you want it. -->

<ul>
	<li>
		<h2>A random selection of my writing</h2>
		<ul>
			<?php
				$rand_posts = get_posts('numberposts=5&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;orderby=rand');
				foreach( $rand_posts as $post ) :
			?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endforeach; ?>
		</ul>
	</li>
</ul>

33. List Upcoming Posts

<!-- Want to tantalize your readers with what you’ve got to come? What to display an event that’s happening in the future? This snippet will let you list which posts you have in draft. -->

<div id="zukunft">
	<div id="zukunft_header"><p>Future events</p></div>
	<?php query_posts('showposts=10&amp;post_status=future'); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div>
		<p class><b><?php the_title(); ?></b><?php edit_post_link('e',' (',')'); ?><br />
		<span><?php the_time('j. F Y'); ?></span></p>
	</div>
	<?php endwhile; else: ?><p>No future events scheduled.</p><?php endif; ?>
</div>

34. Show Related Posts

<?php
	$tags = wp_get_post_tags($post->ID);

	if ($tags) {
	echo 'Related Posts';
	$first_tag = $tags[0]->term_id;
	$args=array(
	'tag__in' => array($first_tag),
	'post__not_in' => array($post->ID),
	'showposts'=>1,
	'caller_get_posts'=>1
	);
	$my_query = new WP_Query($args);

	if( $my_query->have_posts() ) {

	while ($my_query->have_posts()) : $my_query->the_post(); ?>
	<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
	<?php

	endwhile; wp_reset();
	}
	}
?>

35. Display Latest Posts

<?php query_posts('showposts=5'); ?>
<ul>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php endwhile;?>
</ul>

36. Custom Post Type

<!-- Using Custom Templates for CPT Archives and Single Entries
If you don’t like the appearance of the archive page for your custom post type, then you can use dedicated template for custom post type archive. To do that all you need to do is create a new file in your theme directory and name it archive-movies.php. Replace movies with the name of your custom post type.

For geting started, you can copy the contents of your theme’s archive.php file into archive-movies.php template and then start modifying it to meet your needs. Now whenever the archive page for your custom post type is accessed, this template will be used to display it.

Similarly, you can also create a custom template for your post type’s single entry display. To do that you need to create single-movies.php in your theme directory. Don’t forget to replace movies with the name of your custom post type.

You can get started by copying the contents of your theme’s single.php template into single-movies.php template and then start modifying it to meet your needs. -->

<!-- function.php -->
<?php
	/*
	* Creating a function to create our CPT
	*/
	 
	function custom_post_type() {
	 
	// Set UI labels for Custom Post Type
	    $labels = array(
	        'name'                => _x( 'Movies', 'Post Type General Name', 'twentythirteen' ),
	        'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentythirteen' ),
	        'menu_name'           => __( 'Movies', 'twentythirteen' ),
	        'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
	        'all_items'           => __( 'All Movies', 'twentythirteen' ),
	        'view_item'           => __( 'View Movie', 'twentythirteen' ),
	        'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
	        'add_new'             => __( 'Add New', 'twentythirteen' ),
	        'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
	        'update_item'         => __( 'Update Movie', 'twentythirteen' ),
	        'search_items'        => __( 'Search Movie', 'twentythirteen' ),
	        'not_found'           => __( 'Not Found', 'twentythirteen' ),
	        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	    );
	     
	// Set other options for Custom Post Type
	     
	    $args = array(
	        'label'               => __( 'movies', 'twentythirteen' ),
	        'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
	        'labels'              => $labels,
	        // Features this CPT supports in Post Editor
	        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	        // You can associate this CPT with a taxonomy or custom taxonomy. 
	        'taxonomies'          => array( 'genres' ),
	        /* A hierarchical CPT is like Pages and can have
	        * Parent and child items. A non-hierarchical CPT
	        * is like Posts.
	        */ 
	        'hierarchical'        => false,
	        'public'              => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_nav_menus'   => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 5,
	        'can_export'          => true,
	        'has_archive'         => true,
	        'exclude_from_search' => false,
	        'publicly_queryable'  => true,
	        'capability_type'     => 'page',
	    );
	     
	    // Registering your Custom Post Type
	    register_post_type( 'movies', $args );
	 
	}
	 
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	 
	add_action( 'init', 'custom_post_type', 0 );
?>

<!-- Querying Custom Post Types -->

<?php 
	$args = array( 'post_type' => 'movies', 'posts_per_page' => 10 );
	$the_query = new WP_Query( $args ); 
	?>
	<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<h2><?php the_title(); ?></h2>
	<div class="entry-content">
	<?php the_content(); ?> 
	</div>
	<?php wp_reset_postdata(); ?>
	<?php else:  ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<!-- #---------- -->
Category
<!-- #---------- -->

36. Exclude Specific Category

<!-- It can sometimes come in handy to exclude specific categories from being displayed. -->

<?php query_posts('cat=-2'); ?>
<?php while (have_posts()) : the_post(); ?>
<!-- //the loop here -->
<?php endwhile;?>

<!-- #-------- -->
Security
<!-- #-------- -->

37. Force Users to Log in Before Reading a Post

<!-- If there are certain posts that you want to restrict, whether they for a few people only, or for paying subscribers, or whatever, you can use this snippet to force users to login to see them. Paste this into your functions file: -->

<?php 
	function my_force_login() {

	global $post;

	if (!is_single()) return;
	$ids = array(188, 185, 171); // array of post IDs that force login to read


	if (in_array((int)$post->ID, $ids) &amp;&amp; !is_user_logged_in()) {
	auth_redirect();
	}
	}
?>

<!-- And then put this at the top of your header: -->
<?php my_force_login(); ?>

38. Force SSL usage

<!-- If you’re concerned about your admin being accessed you could force SSL usage. You’ll need to make sure you can do this with your hosting. -->
<?php
	define('FORCE_SSL_ADMIN', true);
?>

39. Protect your wp-config.php

<!-- Use this snippet to protect the precious. Add this to your .htaccess file -->

<Files wp-config.php>
	order allow,deny
	deny from all
</Files>

40. Remove the WordPress version

<!-- his is especially helpful if you’re using an older version of WordPress. Best not tell anyone else that you are. -->
<?php
	function no_generator() { return ''; }
	add_filter( 'the_generator', 'no_generator' );
?>

41. Only allow your own IP address to access your admin
<!-- If you’ve got a static IP and you want to improve your security this is a good snippet. Don’t bother if you have a dynamic IP though. It would get very annoying. -->

<?php
	# my ip address only
	order deny,allow
	allow from MY IP ADDRESS (replace with your IP address)
	deny from all
?>

<!-- #----------- -->
Media
<!-- #----------- -->

42. Automatically use Resized Images instead of originals

<!-- Replace your uploaded image with the large image generated by WordPress. This will save space on your server, and save bandwidth if you link your thumbnail to the original image. I love things that speed up your website. -->

<?php
	function replace_uploaded_image($image_data) {
	// if there is no large image : return

	if (!isset($image_data['sizes']['large'])) return $image_data;
	// paths to the uploaded image and the large image

	$upload_dir = wp_upload_dir();
	$uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
	$large_image_location = $upload_dir['path'] . '/'.$image_data['sizes']['large']['file'];
	// delete the uploaded image

	unlink($uploaded_image_location);
	// rename the large image

	rename($large_image_location,$uploaded_image_location);
	// update image metadata and return them

	$image_data['width'] = $image_data['sizes']['large']['width'];
	$image_data['height'] = $image_data['sizes']['large']['height'];
	unset($image_data['sizes']['large']);

	return $image_data;
	}
	add_filter('wp_generate_attachment_metadata','replace_uploaded_image');
?>


<!-- #----------- -->
if ( is_home() && ! is_front_page() )
<!-- #----------- -->

if ( is_front_page() && is_home() ) {
// Default homepage

} elseif ( is_front_page()){
// Static homepage

} elseif ( is_home()){

// Blog page

} else {

// Everything else

}

<!-- Customize Password Protected Page -->

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="protected-post-form password-form-sty" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "<h2 class='orange-header'>To view our available resources, please enter your access code below:</h2>" ) . '
    <label class="pass-label" for="' . $label . '">' . __( "Enter Access Code:" ) . ' </label><br /><input name="post_password" id="' . $label . '" type="password" style="background: #ffffff; border:1px solid #999; color:#000; padding:10px;" size="20" /><br /><input type="submit" name="Submit" class="button" value="' . esc_attr__( "Submit" ) . '" />
        <p style="font-size:14px;margin:0px;">∗If you do not have an access code, please contact your SOL Sales Representative
        to request access.</p>
<style>.eltdf-vertical-align-containers .eltdf-position-right{float:right!important;text-align:right!important;width:250px!important}.eltdf-main-menu>ul>li>a{padding:0 9px!important}</style>
</form>
    ';
    return $o;
}


<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->
WP_Query Arguments : https://www.billerickson.net/code/wp_query-arguments
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->

<?php
/**
* WordPress Query Comprehensive Reference
* Compiled by luetkemj - luetkemj.github.io
*
* CODEX: http://codex.wordpress.org/Class_Reference/WP_Query#Parameters
* Source: https://core.trac.wordpress.org/browser/tags/4.9.4/src/wp-includes/query.php
*/

$args = array(

// Author Parameters - Show posts associated with certain author.
// http://codex.wordpress.org/Class_Reference/WP_Query#Author_Parameters
  'author' => '1,2,3,', // (int | string) -  use author id or comma-separated list of IDs [use minus (-) to exclude authors by ID ex. 'author' => '-1,-2,-3,']
  'author_name' => 'luetkemj', // (string) - use 'user_nicename' (NOT name)
  'author__in' => array( 2, 6 ), // (array) - use author id (available with Version 3.7).
  'author__not_in' => array( 2, 6 ), // (array)' - use author id (available with Version 3.7).

// Category Parameters - Show posts associated with certain categories.
// http://codex.wordpress.org/Class_Reference/WP_Query#Category_Parameters
  'cat' => 5, // (int) - Display posts that have this category (and any children of that category), using category id.
  'cat' => '-12,-34,-56' // Display all posts except those from a category by prefixing its id with a '-' (minus) sign.
  'category_name' => 'staff, news', // (string) - Display posts that have these categories (and any children of that category), using category slug.
  'category_name' => 'staff+news', // (string) - Display posts that have "all" of these categories, using category slug.
  'category__and' => array( 2, 6 ), // (array) - Display posts that are in multiple categories. This shows posts that are in both categories 2 and 6.
  'category__in' => array( 2, 6 ), // (array) - Display posts that have this category (not children of that category), using category id.
  'category__not_in' => array( 2, 6 ), // (array) - Display posts that DO NOT HAVE these categories (not children of that category), using category id.

// Tag Parameters - Show posts associated with certain tags.
// http://codex.wordpress.org/Class_Reference/WP_Query#Tag_Parameters
  'tag' => 'cooking', // (string) - use tag slug.
  'tag_id' => 5, // (int) - use tag id.
  'tag__and' => array( 2, 6), // (array) - use tag ids.
  'tag__in' => array( 2, 6), // (array) - use tag ids.
  'tag__not_in' => array( 2, 6), // (array) - use tag ids.
  'tag_slug__and' => array( 'red', 'blue'), // (array) - use tag slugs.
  'tag_slug__in' => array( 'red', 'blue'), // (array) - use tag slugs.

// Taxonomy Parameters - Show posts associated with certain taxonomy.
// http://codex.wordpress.org/Class_Reference/WP_Query#Taxonomy_Parameters
// Important Note: tax_query takes an array of tax query arguments arrays (it takes an array of arrays)
// This construct allows you to query multiple taxonomies by using the relation parameter in the first (outer) array to describe the boolean relationship between the taxonomy queries.
  'tax_query' => array( // (array) - use taxonomy parameters (available with Version 3.1).
    'relation' => 'AND', // (string) - The logical relationship between each inner taxonomy array when there is more than one. Possible values are 'AND', 'OR'. Do not use with a single inner taxonomy array. Default value is 'AND'.
    array(
      'taxonomy' => 'color', // (string) - Taxonomy.
      'field' => 'slug', // (string) - Select taxonomy term by Possible values are 'term_id', 'name', 'slug' or 'term_taxonomy_id'. Default value is 'term_id'.
      'terms' => array( 'red', 'blue' ), // (int/string/array) - Taxonomy term(s).
      'include_children' => true, // (bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
      'operator' => 'IN' // (string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND', 'EXISTS' and 'NOT EXISTS'. Default value is 'IN'.
    ),
    array(
      'taxonomy' => 'actor',
      'field' => 'id',
      'terms' => array( 103, 115, 206 ),
      'include_children' => false,
      'operator' => 'NOT IN'
    )
  ),

// Post & Page Parameters - Display content based on post and page parameters.
// http://codex.wordpress.org/Class_Reference/WP_Query#Post_.26_Page_Parameters
  'p' => 1, // (int) - use post id.
  'name' => 'hello-world', // (string) - use post slug.
  'title' => 'Hello World' // (string) - use post title (available with Version 4.4)
  'page_id' => 1, // (int) - use page id.
  'pagename' => 'sample-page', // (string) - use page slug.
  'pagename' => 'contact_us/canada', // (string) - Display child page using the slug of the parent and the child page, separated ba slash
  'post_name__in' => 'sample-post' (array) // - use post slugs. Specify posts to retrieve. (available since Version 4.4)
  'post_parent' => 1, // (int) - use page id. Return just the child Pages. (Only works with heirachical post types.)
  'post_parent__in' => array(1,2,3) // (array) - use post ids. Specify posts whose parent is in an array. NOTE: Introduced in 3.6
  'post_parent__not_in' => array(1,2,3), // (array) - use post ids. Specify posts whose parent is not in an array.
  'post__in' => array(1,2,3), // (array) - use post ids. Specify posts to retrieve. ATTENTION If you use sticky posts, they will be included (prepended!) in the posts you retrieve whether you want it or not. To suppress this behaviour use ignore_sticky_posts
  'post__not_in' => array(1,2,3), // (array) - use post ids. Specify post NOT to retrieve.
  // NOTE: you cannot combine 'post__in' and 'post__not_in' in the same query

// Password Parameters - Show content based on post and page parameters. Remember that default post_type is only set to display posts but not pages.
// http://codex.wordpress.org/Class_Reference/WP_Query#Password_Parameters
  'has_password' => true, // (bool) - available with Version 3.9
                          // true for posts with passwords;
                          // false for posts without passwords;
                          // null for all posts with and without passwords
  'post_password' => 'multi-pass', // (string) - show posts with a particular password (available with Version 3.9)

// Post Type Parameters - Show posts associated with certain type or status.
// http://codex.wordpress.org/Class_Reference/WP_Query#Type_Parameters
  'post_type' => array( // (string / array) - use post types. Retrieves posts by Post Types, default value is 'post';
    'post', // - a post.
    'page', // - a page.
    'revision', // - a revision.
    'attachment', // - an attachment. The default WP_Query sets 'post_status'=>'published', but atchments default to 'post_status'=>'inherit' so you'll need to set the status to 'inherit' or 'any'.
    'nav_menu_item' // - a navigation menu item
    'my-custom-post-type', // - Custom Post Types (e.g. movies)
  ),
  // NOTE: The 'any' keyword available to both post_type and post_status queries cannot be used within an array.
  'post_type' => 'any', // - retrieves any type except revisions and types with 'exclude_from_search' set to true.

// Post Status Parameters - Show posts associated with certain type or status.
// http://codex.wordpress.org/Class_Reference/WP_Query#Status_Parameters
    'post_status' => array( // (string | array) - use post status. Retrieves posts by Post Status, default value i'publish'.
      'publish', // - a published post or page.
      'pending', // - post is pending review.
      'draft',  // - a post in draft status.
      'auto-draft', // - a newly created post, with no content.
      'future', // - a post to publish in the future.
      'private', // - not visible to users who are not logged in.
      'inherit', // - a revision. see get_children.
      'trash', // - post is in trashbin (available with Version 2.9).
    ),
    // NOTE: The 'any' keyword available to both post_type and post_status queries cannot be used within an array.
    'post_status' => 'any', // - retrieves any status except those from post types with 'exclude_from_search' set to true.


// Comment Paremters - @since Version 4.9 Introduced the `$comment_count` parameter.
// https://codex.wordpress.org/Class_Reference/WP_Query#Comment_Parameters
    'comment_count' => 10 // (int | array) The amount of comments your CPT has to have ( Search operator will do a '=' operation )
    'comment_count' => array(
      'value' => 10 // (int) - The amount of comments your CPT has to have when comparing
      'compare' => '=' // (string) - The search operator. Possible values are '=', '!=', '>', '>=', '<', '<='. Default value is '='.
    )

// Pagination Parameters
    //http://codex.wordpress.org/Class_Reference/WP_Query#Pagination_Parameters
    'posts_per_page' => 10, // (int) - number of post to show per page (available with Version 2.1). Use 'posts_per_page' => -1 to show all posts.
                            // Note: if the query is in a feed, wordpress overwrites this parameter with the stored 'posts_per_rss' option. Treimpose the limit, try using the 'post_limits' filter, or filter 'pre_option_posts_per_rss' and return -1
    'nopaging' => false, // (bool) - show all posts or use pagination. Default value is 'false', use paging.
    'paged' => get_query_var('paged'), // (int) - number of page. Show the posts that would normally show up just on page X when usinthe "Older Entries" link.
                                       // NOTE: Use get_query_var('page'); if you want your query to work in a Page template that you've set as your static front page. The query variable 'page' holds the pagenumber for a single paginated Post or Page that includes the <!--nextpage--> Quicktag in the post content.
    'nopaging' => false, // (boolean) - show all posts or use pagination. Default value is 'false', use paging.
    'posts_per_archive_page' => 10, // (int) - number of posts to show per page - on archive pages only. Over-rides posts_per_page and showposts on pages where is_archive() or is_search() would be true.
    'offset' => 3, // (int) - number of post to displace or pass over.
                   // Warning: Setting the offset parameter overrides/ignores the paged parameter and breaks pagination. for a workaround see: http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
                   // The 'offset' parameter is ignored when 'posts_per_page'=>-1 (show all posts) is used.
    'paged' => get_query_var('paged'), // (int) - number of page. Show the posts that would normally show up just on page X when usinthe "Older Entries" link.
                                       // NOTE: This whole paging thing gets tricky. Some links to help you out:
                                       // http://codex.wordpress.org/Function_Reference/next_posts_link#Usage_when_querying_the_loop_with_WP_Query
                                       // http://codex.wordpress.org/Pagination#Troubleshooting_Broken_Pagination
    'page' => get_query_var('page'), // (int) - number of page for a static front page. Show the posts that would normally show up just on page X of a Static Front Page.
                                     // NOTE: The query variable 'page' holds the pagenumber for a single paginated Post or Page that includes the <!--nextpage--> Quicktag in the post content.
    'ignore_sticky_posts' => false, // (boolean) - ignore sticky posts or not (available with Version 3.1, replaced caller_get_posts parameter). Default value is 0 - don't ignore sticky posts. Note: ignore/exclude sticky posts being included at the beginning of posts returned, but the sticky post will still be returned in the natural order of that list of posts returned.

// Order & Orderby Parameters - Sort retrieved posts.
// http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
    'order' => 'DESC', // (string) - Designates the ascending or descending order of the 'orderby' parameter. Default to 'DESC'.
                       //Possible Values:
                       //'ASC' - ascending order from lowest to highest values (1, 2, 3; a, b, c).
                       //'DESC' - descending order from highest to lowest values (3, 2, 1; c, b, a).
    'orderby' => 'date', // (string) - Sort retrieved posts by parameter. Defaults to 'date'. One or more options can be passed. EX: 'orderby' => 'menu_order title'
                         //Possible Values:
                         // 'none' - No order (available since Version 2.8).
                         // 'ID' - Order by post id. Note the capitalization.
                         // 'author' - Order by author. ('post_author' is also accepted.)
                         // 'title' - Order by title. ('post_title' is also accepted.)
                         // 'name' - Order by post name (post slug). ('post_name' is also accepted.)
                         // 'type' - Order by post type (available since Version 4.0). ('post_type' is also accepted.)
                         // 'date' - Order by date. ('post_date' is also accepted.)
                         // 'modified' - Order by last modified date. ('post_modified' is also accepted.)
                         // 'parent' - Order by post/page parent id. ('post_parent' is also accepted.)
                         // 'rand' - Random order. You can also use 'RAND(x)' where 'x' is an integer seed value.
                         // 'comment_count' - Order by number of comments (available since Version 2.9).
                         // 'relevance' - Order by search terms in the following order: First, whether the entire sentence is matched. Second, if all the search terms are within the titles. Third, if any of the search terms appear in the titles. And, fourth, if the full sentence appears in the contents.
                         // 'menu_order' - Order by Page Order. Used most often for Pages (Order field in the Edit Page Attributes box) and for Attachments (the integer fields in the Insert / Upload Media Gallery dialog), but could be used for any post type with distinct 'menu_order' values (they all default to 0).
                         // 'meta_value' - Note that a 'meta_key=keyname' must also be present in the query. Note also that the sorting will be alphabetical which is fine for strings (i.e. words), but can be unexpected for numbers (e.g. 1, 3, 34, 4, 56, 6, etc, rather than 1, 3, 4, 6, 34, 56 as you might naturally expect). Use 'meta_value_num' instead for numeric values.
                         // 'meta_type' if you want to cast the meta value as a specific type. Possible values are 'NUMERIC', 'BINARY',  'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED', same as in '$meta_query'. When using 'meta_type' you can also use 'meta_value_*' accordingly. For example, when using DATETIME as 'meta_type' you can use 'meta_value_datetime' to define order structure.
                         // 'meta_value_num' - Order by numeric meta value (available since Version 2.8). Also note that a 'meta_key=keyname' must also be present in the query. This value allows for numerical sorting as noted above in 'meta_value'.
                         // 'post__in' - Preserve post ID order given in the 'post__in' array (available since Version 3.5). Note - the value of the order parameter does not change the resulting sort order.
                         // 'post_name__in' - Preserve post slug order given in the 'post_name__in' array (available since Version 4.6). Note - the value of the order parameter does not change the resulting sort order.
                         // 'post_parent__in' - Preserve post parent order given in the 'post_parent__in' array (available since Version 4.6). Note - the value of the order parameter does not change the resulting sort order.

// Date Parameters - Show posts associated with a certain time and date period.
// http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters
    'year' => 2014, // (int) - 4 digit year (e.g. 2011).
    'monthnum' => 4, // (int) - Month number (from 1 to 12).
    'w' =>  25, // (int) - Week of the year (from 0 to 53). Uses the MySQL WEEK command. The mode is dependenon the "start_of_week" option.
    'day' => 17, // (int) - Day of the month (from 1 to 31).
    'hour' => 13, // (int) - Hour (from 0 to 23).
    'minute' => 19, // (int) - Minute (from 0 to 60).
    'second' => 30, // (int) - Second (0 to 60).
    'm' => 201404, // (int) - YearMonth (For e.g.: 201307).
    'date_query' => array( // (array) - Date parameters (available with Version 3.7).
                           // these are super powerful. check out the codex for more comprehensive code examples http://codex.wordpress.org/Class_Reference/WP_Query#Date_Parameters
      array(
        'year' => 2014, // (int) - 4 digit year (e.g. 2011).
        'month' => 4, // (int) - Month number (from 1 to 12).
        'week' => 31, // (int) - Week of the year (from 0 to 53).
        'day' => 5, // (int) - Day of the month (from 1 to 31).
        'hour' => 2, // (int) - Hour (from 0 to 23).
        'minute' => 3, // (int) - Minute (from 0 to 59).
        'second' => 36, // (int) - Second (0 to 59).
        'after' => 'January 1st, 2013', // (string/array) - Date to retrieve posts after. Accepts strtotime()-compatible string, or array of 'year', 'month', 'day'
        'before' => array( // (string/array) - Date to retrieve posts after. Accepts strtotime()-compatible string, or array of 'year', 'month', 'day'
          'year' => 2013, // (string) Accepts any four-digit year. Default is empty.
          'month' => 2, // (string) The month of the year. Accepts numbers 1-12. Default: 12.
          'day' => 28, // (string) The day of the month. Accepts numbers 1-31. Default: last day of month.
        ),
        'inclusive' => true, // (boolean) - For after/before, whether exact value should be matched or not'.
        'compare' =>  '=', // (string) - Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='
        'column' => 'post_date', // (string) - Column to query against. Default: 'post_date'.
        'relation' => 'AND', // (string) - OR or AND, how the sub-arrays should be compared. Default: AND.
      ),
    ),

// Custom Field Parameters - Show posts associated with a certain custom field.
// http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
    'meta_key' => 'key', // (string) - Custom field key.
    'meta_value' => 'value', // (string) - Custom field value.
    'meta_value_num' => 10, // (number) - Custom field value.
    'meta_compare' => '=', // (string) - Operator to test the 'meta_value'. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'NOT EXISTS', 'REGEXP', 'NOT REGEXP' or 'RLIKE'. Default value is '='.
    'meta_query' => array( // (array) - Custom field parameters (available with Version 3.1).
      'relation' => 'AND', // (string) - Possible values are 'AND', 'OR'. The logical relationship between each inner meta_query array when there is more than one. Do not use with a single inner meta_query array.
       array(
         'key' => 'color', // (string) - Custom field key.
         'value' => 'blue', // (string/array) - Custom field value (Note: Array support is limited to a compare value of 'IN', 'NOT IN', 'BETWEEN', or 'NOT BETWEEN') Using WP < 3.9? Check out this page for details: http://codex.wordpress.org/Class_Reference/WP_Query#Custom_Field_Parameters
         'type' => 'CHAR', // (string) - Custom field type. Possible values are 'NUMERIC', 'BINARY', 'CHAR', 'DATE', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED'. Default value is 'CHAR'. The 'type' DATE works with the 'compare' value BETWEEN only if the date is stored at the format YYYYMMDD and tested with this format.
                           //NOTE: The 'type' DATE works with the 'compare' value BETWEEN only if the date is stored at the format YYYYMMDD and tested with this format.
         'compare' => '=', // (string) - Operator to test. Possible values are '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' (only in WP >= 3.5), and 'NOT EXISTS' (also only in WP >= 3.5). Default value is '='.
       ),
       array(
         'key' => 'price',
         'value' => array( 1,200 ),
         'compare' => 'NOT LIKE',
       )
    ),

// Permission Parameters - Display published posts, as well as private posts, if the user has the appropriate capability:
// http://codex.wordpress.org/Class_Reference/WP_Query#Permission_Parameters
    'perm' => 'readable', // (string) Possible values are 'readable', 'editable'

// Mime Type Parameters - Used with the attachments post type.
// https://codex.wordpress.org/Class_Reference/WP_Query#Mime_Type_Parameters
    'post_mime_type' => 'image/gif', // (string/array) - Allowed mime types.


// Caching Parameters
// http://codex.wordpress.org/Class_Reference/WP_Query#Caching_Parameters
// NOTE Caching is a good thing. Setting these to false is generally not advised.
    'cache_results' => true, // (bool) Default is true - Post information cache.
    'update_post_term_cache' => true, // (bool) Default is true - Post meta information cache.
    'update_post_meta_cache' => true, // (bool) Default is true - Post term information cache.
    'no_found_rows' => false, // (bool) Default is false. WordPress uses SQL_CALC_FOUND_ROWS in most queries in order to implement pagination. Even when you don’t need pagination at all. By Setting this parameter to true you are telling wordPress not to count the total rows and reducing load on the DB. Pagination will NOT WORK when this parameter is set to true. For more information see: http://flavio.tordini.org/speed-up-wordpress-get_posts-and-query_posts-functions


// Search Parameter
// http://codex.wordpress.org/Class_Reference/WP_Query#Search_Parameter
    's' => $s, // (string) - Passes along the query string variable from a search. For example usage see: http://www.wprecipes.com/how-to-display-the-number-of-results-in-wordpress-search
    'exact' => true, // (bool) - flag to make it only match whole titles/posts - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118
    'sentence' => true, // (bool) - flag to make it do a phrase search - Default value is false. For more information see: https://gist.github.com/2023628#gistcomment-285118

// Post Field Parameters
// For more info see: http://codex.wordpress.org/Class_Reference/WP_Query#Return_Fields_Parameter
// also https://gist.github.com/luetkemj/2023628/#comment-1003542
    'fields' => 'ids', // (string) - Which fields to return. All fields are returned by default.
                       // Possible values:
                       // 'ids'        - Return an array of post IDs.
                       // 'id=>parent' - Return an associative array [ parent => ID, … ].
                       // Passing anything else will return all fields (default) - an array of post objects.

// Filters
// For more information on available Filters see: http://codex.wordpress.org/Class_Reference/WP_Query#Filters

);

$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
  // Do Stuff
endwhile;
endif;

// Reset Post Data
wp_reset_postdata();


<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->
Code Snippets : https://www.billerickson.net/code/
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->

	
	
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->
Wordpress Codex DashIcons : https://developer.wordpress.org/resource/dashicons/#translation
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->

	
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->
Apply Custom CSS to Admin Area
<!-- #----------- -->
<!-- #----------- -->
<!-- #----------- -->

	
****Option One: Inline CSS****
/* Admin CSS inline styles */
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    body, td, textarea, input, select {
      font-family: "Lucida Grande";
      font-size: 12px;
    } 
  </style>';
}

****Option Two: Reference CSS file***
/* Admin CSS styles */
function adminStylesCss() {
    $url = get_settings('siteurl');
    $url = $url . '/wp-content/themes/yourtheme/css/wp-admin.css';
    echo '<!-- Admin CSS styles -->
          <link rel="stylesheet" type="text/css" href="' . $url . '" />
          <!-- /end Admin CSS styles -->';
}
add_action('admin_head', 'adminStylesCss');

****Option Three: Reference CSS file****
// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');



// Google Storage
// Get service file

    require get_template_directory() . '/vendor/autoload.php';
    use Google\Cloud\Storage\StorageClient;
    use Google\Cloud\ServiceBuilder;

    function download_object($bucketName, $objectName, $destination)
    {
        $storage = new StorageClient([
            'keyFilePath' => get_template_directory() . '/inc/json/kinetic-guild-304821-76cb4aac8519.json',
        ]);
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($objectName);
        $object->downloadToFile($destination);
        printf('Downloaded gs://%s/%s to %s' . PHP_EOL,
            $bucketName, $objectName, basename($destination));
    }

    // CRONJOB Example:
    function my_cronjob_action_test () {
        // code to execute on cron run
        download_object('postali_project', 'example.json', get_template_directory() . '/inc/json/example.json');
    } add_action('my_cronjob_action_test', 'my_cronjob_action_test');


// Select MySQL data and render on the page
// Select MySQL data and render on the page

    include '.env.php';

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, kind, fullName, age, gender, company FROM Persons";
    $result = mysqli_query($conn, $sql);
    echo "Render from Mysql Database:<br />";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if ($current_user->user_login == $row["company"]) {
                echo "id: " . $row["id"]. " - kind: " . $row["kind"]. " - Full Name: " . $row["fullName"].  " - age: " . $row["age"]. " - gender: " . $row["gender"]. " - company: " . $row["company"]. "<br />";
            }
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);

    // Remove this
    require get_template_directory() . '/inc/json/json_mysql_cron.php';
    require get_template_directory() . '/inc/json/test_json_fetch.php';

<?php
/**
 * Script to format a feed as an R3S json object
 *
 * @package Weever
 */

    $feed = new R3SChannelMap;

	$feed->count = count($wp_query->post_count);
	$feed->thisPage = 1;
	$feed->lastPage = 1;
	$feed->language = get_locale();
	$feed->sort = "normal";
	$feed->url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$feed->description = get_bloginfo_rss("description");
	$feed->name = get_bloginfo_rss('name') . get_wp_title_rss();
	$feed->items = array();

	$feed->url = str_replace("?feed=r3s","",$feed->url);
	$feed->url = str_replace("&feed=r3s","",$feed->url);


	while ( have_posts() ) {
	    the_post();

		$image = null;

		$html = SimpleHTMLDomHelper::str_get_html(get_the_content());

		foreach ( @$html->find('img') as $vv )
		{
			if ( $vv->src )
			{
				$image = WeeverHelper::make_absolute($vv->src, get_site_url());
				break;
			}
		}

		// TODO: Get the url of the currently selected icon image
		if(!$image)
			$image = "";

		$feedItem = new R3SItemMap;

		$feedItem->type = "htmlContent";
		$feedItem->description = ""; // TODO: Replace with title/description?
		$feedItem->name = get_the_title();
		$feedItem->datetime["published"] = get_lastpostdate('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostdate('GMT'), false);  //$v->created;
		$feedItem->datetime["modified"] = get_lastpostmodified('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostmodified('GMT'), false); //$v->modified;
		$feedItem->image["mobile"] = $image;
		$feedItem->image["full"] = $image;
		$feedItem->url = get_permalink(); //JURI::root()."index.php?option=com_content&view=article&id=".$v->id;
		$feedItem->author = get_the_author_meta('display_name'); // $v->created_by;

		// TODO: Get the site name from the current state object
		$feedItem->publisher = ""; //$mainframe->getCfg('sitename');

//		$feedItem->url = str_replace("?template=weever_cartographer","",$feedItem->url);
//		$feedItem->url = str_replace("&template=weever_cartographer","",$feedItem->url);

		$feed->items[] = $feedItem;
	}

	// Set the MIME type for JSON output.
	header('Content-type: application/json');
	header('Cache-Control: no-cache, must-revalidate');

	$callback = get_query_var('callback');

	$json = json_encode($feed);

	if($callback)
		$json = $callback . "(". $json .")";

	print_r($json);



/*







header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	<?php do_action('rss2_ns'); ?>
>

<channel>
	<title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php echo get_option('rss_language'); ?></language>
	<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
	<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
	<?php do_action('rss2_head'); ?>
	<?php $count = 0; ?>
	<?php while( have_posts()) : the_post(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
		<comments><?php comments_link_feed(); ?></comments>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
		<dc:creator><?php the_author() ?></dc:creator>
		<?php the_category_rss('rss2') ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
	<?php if ( strlen( $post->post_content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php the_content_feed('rss2') ?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
		<wfw:commentRss><?php echo esc_url( get_post_comments_feed_link(null, 'rss2') ); ?></wfw:commentRss>
		<slash:comments><?php echo get_comments_number(); ?></slash:comments>
<?php rss_enclosure(); ?>
	<?php do_action('rss2_item'); ?>
	</item>
	<?php endwhile; ?>
</channel>
</rss> */

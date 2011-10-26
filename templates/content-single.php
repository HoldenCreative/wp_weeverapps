<?php
ob_start();

the_post();

header('Content-type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$callback = get_query_var('callback');

// specs @ https://github.com/WeeverApps/r3s-spec

$jsonHtml = new R3SHtmlContentDetailsMap;

$jsonHtml->language = get_locale();

// TODO: Get the sitename from the current site state
$jsonHtml->publisher = get_option('blogname'); // $conf->getValue('config.sitename');

$jsonHtml->name = get_the_title();
$jsonHtml->author = get_the_author_meta('display_name');
$jsonHtml->datetime["published"] = get_lastpostdate('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostdate('GMT'), false);  //$v->created;
$jsonHtml->datetime["modified"] = get_lastpostmodified('GMT'); //mysql2date('Y-m-d H:i:s', get_lastpostmodified('GMT'), false); //$v->modified;

// Create shortcuts to some parameters.
//$params		= $this->item->params;
//$canEdit	= $this->item->params->get('access-edit');
//$user		= JFactory::getUser();

// TODO: Look at item-page class?
?>
<div class="item-page">

<h1 class="wx-article-title">
	<?php echo get_the_title(); ?>
</h1>

<?php /*  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; */ ?>

<?php /*$useDefList = (($params->get('show_author')) OR ($params->get('show_category')) OR ($params->get('show_parent_category'))
	OR ($params->get('show_create_date')) OR ($params->get('show_modify_date')) OR ($params->get('show_publish_date'))
	OR ($params->get('show_hits'))); */ ?>

	<?php /*<dl class="article-info">
	<dt class="article-info-term"><?php  echo __('COM_CONTENT_ARTICLE_INFO'); ?></dt> */ ?>

	<dd class="category-name">
	<?php echo sprintf(__('Categories: %s', 'weever'), get_the_category_list(' ')); ?>
	</dd>
<?php /*if ($params->get('show_create_date')) : ?>
	<dd class="create">
	<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; ?>
<?php if ($params->get('show_modify_date')) : ?>
	<dd class="modified">
	<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</dd>
<?php endif; */ ?>
	<dd class="published">
	<?php echo sprintf(__('Published: %s', 'weever'), get_the_time(get_option('date_format'))); ?>
	</dd>

	<dd class="createdby">
	<?php echo sprintf(esc_attr__('Written by: %s', 'weever'), get_the_author_link()); ?>
	</dd>

<?php /*if ($params->get('show_hits')) : ?>
	<dd class="hits">
	<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
	</dd>
<?php endif;*/ ?>
<?php /*if ($useDefList) : ?>
	</dl>
<?php //endif; */?>

<p>
<?php the_content(); ?>
</p>

<?php /*if ($params->get('access-view')):?>
	<?php echo $this->item->text; ?>

	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true AND $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; */?>
</div>


<?php

$jsonHtml->html =  ob_get_clean();
$jsonHtml->image = null;


	$html = SimpleHTMLDomHelper::str_get_html( $jsonHtml->html );

	foreach ( @$html->find('img') as $vv )
	{
		if ( $vv->src )
		{
			$jsonHtml->image = WeeverHelper::make_absolute($vv->src, site_url());
			break;
		}
	}

	if ( ! $jsonHtml->image )
		$jsonHtml->image = "";

// Mask external links so we leave only internal ones to play with.
$jsonHtml->html = str_replace("href=\"http://", "hrefmask=\"weever://", $jsonHtml->html);

// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
$jsonHtml->html = str_replace("target=\"_blank\"", "", $jsonHtml->html);
$jsonHtml->html = str_replace("href=\"", "target=\"_blank\" href=\"".site_url(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"/", "src=\"".site_url(), $jsonHtml->html);
$jsonHtml->html = str_replace("src=\"images", "src=\"".site_url()."images", $jsonHtml->html);

// Restore external links, ensure target="_blank" applies
$jsonHtml->html = str_replace("hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
$jsonHtml->html = str_replace("<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
									"<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html);

$jsonOutput = new jsonOutput;
$jsonOutput->results[] = $jsonHtml;
$output = json_encode($jsonOutput);

if($callback)
	$json = $callback."(".$output.")";
else
	$json = $output;

print_r($json);

die();


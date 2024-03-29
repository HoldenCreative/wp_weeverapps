<?php
/**
 * Script to format a feed as an R3S json object
 *
 * @package Weever
 */
    $feed = new R3SChannelMap;
    
    $feed->count = $wp_query->post_count;
    
	$callback = get_query_var( 'callback' );
        
	$feed->thisPage = 1; //$page;
	$feed->lastPage = 1; //ceil( $feed->count / $limit );
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

		$html = WeeverSimpleHTMLDomHelper::str_get_html(get_the_content());

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



		if ( function_exists( 'get_post_meta' ) ) {
		    if ( get_post_meta( get_the_ID(), 'geo_public', true ) != '' ) {
    			// Make sure geo is enabled on the post and pass the lat/lon
    			$geo_on = get_post_meta( get_the_ID(), 'geo_enabled', true );
    			if ( '' == $geo_on )
    				$geo_on = true;

    			if ( $geo_on ) {
    				$geo_latitude = get_post_meta( get_the_ID(), 'geo_latitude', true );
    				$geo_longitude = get_post_meta( get_the_ID(), 'geo_longitude', true );
    				$geo_address = get_post_meta( get_the_ID(), 'weever_map_address', true ) ? get_post_meta( get_the_ID(), 'weever_map_address', true ) : get_post_meta( get_the_ID(), 'geo_address', true );

    				$feedItem->geo[0]['latitude'] = $geo_latitude;
    				$feedItem->geo[0]['longitude'] = $geo_longitude;
    				$feedItem->geo[0]['altitude'] = '';
    				$feedItem->geo[0]['address'] = $geo_address;
    				$feedItem->geo[0]['label'] = '';
    				$feedItem->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
    				$feedItem->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
    			}
		    }

		    if ( ! isset( $feedItem->geo[0] ) and get_post_meta( get_the_ID(), '_wp_geo_latitude', true ) != '' and get_post_meta( get_the_ID(), '_wp_geo_longitude', true ) != '' ) {
		        // WP Geo
		    	$feedItem->geo[0]['latitude'] = get_post_meta( get_the_ID(), '_wp_geo_latitude', true );
				$feedItem->geo[0]['longitude'] = get_post_meta( get_the_ID(), '_wp_geo_longitude', true );
				$feedItem->geo[0]['altitude'] = '';
				$feedItem->geo[0]['address'] = get_post_meta( get_the_ID(), 'weever_map_address', true );
				$feedItem->geo[0]['label'] = '';
				$feedItem->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
				$feedItem->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
		    }

		    if ( ! isset( $feedItem->geo[0] ) and get_post_meta( get_the_ID(), 'weever_kml', true ) != '' ) {
		    	// Just KML
		    	$feedItem->geo[0]['latitude'] = '';
			    $feedItem->geo[0]['longitude'] = '';
			    $feedItem->geo[0]['altitude'] = '';
			    $feedItem->geo[0]['address'] = get_post_meta( get_the_ID(), 'weever_map_address', true );
			    $feedItem->geo[0]['label'] = '';
			    $feedItem->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
			    $feedItem->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
		    }
		}

		if ( isset( $_GET['geotag'] ) and $_GET['geotag'] = 'true' and ( get_query_var( 'latitude' ) or get_query_var('longitude') ) ) {
			// Calculate the distance
			$lat1 = floatval( $feedItem->geo[0]['latitude'] );
			$lon1 = floatval( $feedItem->geo[0]['longitude'] );
			
			$lat2 = floatval( get_query_var( 'latitude' ) );
			$lon2 = floatval( get_query_var( 'longitude' ) );
			
			// Calculate in km for now
			$feedItem->geo[0]['distance'] = (string)( 6378.0 * pi() * sqrt( ( $lat2 - $lat1 ) * ( $lat2 - $lat1 ) + cos( $lat2 / 57.29578 ) * cos( $lat1 / 57.29578 ) * ( $lon2 - $lon1 ) * ( $lon2 - $lon1 ) ) / 180 );				
		}
		
		$feed->items[] = $feedItem;
	}

	function weever_distance_sort($a, $b)
	{
		if ($a->geo[0]['distance'] == $b->geo[0]['distance']) {
			return 0;
		}
		
		return ($a->geo[0]['distance'] < $b->geo[0]['distance']) ? -1 : 1;
	}
	
	if ( isset( $_GET['geotag'] ) and $_GET['geotag'] = 'true' and ( get_query_var( 'latitude' ) or get_query_var('longitude') ) ) {
		usort( $feed->items, 'weever_distance_sort' );
	}	
	
	// Set the MIME type for JSON output.
	header('Content-type: application/json');
	header('Cache-Control: no-cache, must-revalidate');
	
	$json = json_encode($feed);

	if($callback)
		$json = $callback . "(". $json .")";

	print_r($json);


	/**
	 * Function from the Geolocation plugin:
	 * http://wordpress.org/extend/plugins/geolocation/
	 */
	function weever_reverse_geocode($latitude, $longitude) {
		$url = "http://maps.google.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&sensor=false";
		$result = wp_remote_get($url);
		$json = json_decode($result['body']);
		foreach ($json->results as $result)
		{
			foreach($result->address_components as $addressPart) {
				if((in_array('locality', $addressPart->types)) && (in_array('political', $addressPart->types)))
					$city = $addressPart->long_name;
				else if((in_array('administrative_area_level_1', $addressPart->types)) && (in_array('political', $addressPart->types)))
					$state = $addressPart->long_name;
				else if((in_array('country', $addressPart->types)) && (in_array('political', $addressPart->types)))
					$country = $addressPart->long_name;
			}
		}

		if(($city != '') && ($state != '') && ($country != ''))
			$address = $city.', '.$state.', '.$country;
		else if(($city != '') && ($state != ''))
			$address = $city.', '.$state;
		else if(($state != '') && ($country != ''))
			$address = $state.', '.$country;
		else if($country != '')
			$address = $country;

		return $address;
	}

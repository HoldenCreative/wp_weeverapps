<?php

    class WeeverHelper {

        /**
         * Function to take a url and ensure it is an absolute url
         * http://www.geekality.net/2011/05/12/php-dealing-with-absolute-and-relative-urls/
		 *
         * @param string $url
         * @param string $base
         */
        public static function make_absolute($url, $base)
        {
            // Return base if no url
            if( ! $url) return $base;

            // Return if already absolute URL
            if(parse_url($url, PHP_URL_SCHEME) != '') return $url;

            // Urls only containing query or anchor
            if($url[0] == '#' || $url[0] == '?') return $base.$url;

            // Parse base URL and convert to local variables: $scheme, $host, $path
            extract(parse_url($base));

            // If no path, use /
            if( ! isset($path)) $path = '/';

            // Remove non-directory element from path
            $path = preg_replace('#/[^/]*$#', '', $path);

            // Destroy path if relative url points to root
            if($url[0] == '/') $path = '';

            // Dirty absolute URL
            $abs = "$host$path/$url";

            // Replace '//' or '/./' or '/foo/../' with '/'
            $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
            for($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {}

            // Absolute URL is ready!
            return $scheme.'://'.$abs;
        }

        /**
         * Return the strings for internationalization in the javascript files
         *
         * @return array
         */
        public static function get_js_strings()
        {
		    return array(
    			'WEEVER_JS_ENTER_NEW_APP_ICON_NAME' => __( 'Enter a New App Icon Name:' ),
    			'WEEVER_JS_APP_UPDATED' => __( 'App Updated' ),
    			'WEEVER_JS_PLEASE_WAIT' => __( 'Please wait, communicating with server' ),
    			'WEEVER_JS_SAVING_CHANGES' => __( 'Saving Changes' ),
    			'WEEVER_JS_SERVER_ERROR' => __( 'Server Error Occurred' ),
    			'WEEVER_JS_ENTER_NEW_APP_ITEM' => __( '' ),
    			'WEEVER_JS_ARE_YOU_SURE_YOU_WANT_TO' => __( 'Are you sure you want to ' ),
    			'WEEVER_JS_QUESTION_MARK' => __( '?' ),
    			'WEEVER_JS_CHANGING_NAV_ICONS' => __( 'Changing Navigation Icons:' ),
    			'WEEVER_JS_CHANGING_NAV_ICONS_INSTRUCTIONS' => __( '<p>Weever App Icons are made with &quot;Base64&quot; -encoded CSS.</p>
<p>To create a new icon, please upload your icon-image to a <a href="http://www.opinionatedgeek.com/dotnet/tools/base64encode/" target="_blank">Base64 Encoder</a> and paste in the results below. We strongly recommend using a black monochrome, transparent 64 x 64 pixel PNG image. [<a href="http://cartanova.ca/images/blog-icon.png" target="_blank">Example</a>]</p>' ),
    			'WEEVER_JS_CHANGING_NAV_PASTE_CODE' => __( 'Click and paste your code here' ),
            );
        }

    }
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

    }
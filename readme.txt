=== Plugin Name ===
Contributors: brianhogg
Donate link: http://weeverapps.com/
Tags: AJAX, android, apple, blackberry, weever, HTML5, iphone, ipod, mac, mobile, smartphone, theme, mobile, web app
Requires at least: 3.2.1
Tested up to: 3.2.1
Stable tag: 1.3.1

Weever Apps Administrator Component for Wordpress: http://weeverapps.com/

== Description ==

Weever is a new service that turns your WordPress site into a true web app for iPhone, Blackberry Touch, Android and iPad - Instantly and affordably.

Weever functions and feels just like a native iOS, Android, or Blackberry app, except with no App Store barriers!

This plugin enables you to build and manage your app entirely within WordPress' administrator backend, utilizing best practices to present your content for a mobile-specific context. App users will be able to quickly and easy find your latest news, follow your social network feeds, touch to make a phone call or email you, watch your videos, browse your photo feeds, and more.

Setting up a Weever App is extremely easy. All you do is:

- Sign up for an API key
- Install the plugin
- Paste in the API key
- Start adding content and branding to your app!

The plugin will forward the devices you specify to your app, and automatically provides the app with the most up-to-date info, so you do not have to manage both your app and your site.

Currently supports:

- Blog content from pages, categories, tags, and custom taxonomy
- Creation of a landing page or a slide-show using Wordpress page content
- Contact information
- Social: Twitter, Facebook, Identi.ca
- Video: Youtube, Vimeo
- Photo: Flickr, Picasa, Facebook Albums, Foursquare Venue Photos
- Events: Google Calendar, Facebook Events
- Forms through Wufoo
- Maps using geolocation stored in posts (using the Wordpress mobile apps for iPhone, Android and Blackberry, or the official Geolocation plugin)
- App works for iPhone/iPod/iPad, Android devices, Blackberry touch devices, with further compatibilities coming soon.

Additional Features:

- Staging Mode: allows developers to play around with new layouts or work on an app for a new version of a site without needing another API key and without affecting a Live app.
- QR Codes: This extension will generate QR codes both for quick previewing of your app as you're building it, and for promoting your app publicly.

== Installation ==

1. Install directly from the Wordpress admin (search for 'Weever Apps' from the Plugins / Add New page), or upload the entire contents of the zip to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by entering your subscription key and the options you wish to use

You can obtain a subscription key at http://weeverapps.com/

== Frequently Asked Questions ==

= How do I start creating my mobile app? =

1. Install the plugin
1. Sign up for a subscription key at http://weeverapps.com/
1. Add the content you wish to appear in your mobile app from the 'Weever Apps Configuration' screen
1. Turn your app online by clicking the icon in the top-right corner in the 'Weever Apps Configuration' screen

That's it!

= Can I customize the look and feel of the mobile app? =

Yes!  You can customize your app in a number of ways:

1. Upload custom graphics for the load screen, logo, and other images for the app in the 'Logo, Images and Theme' tab in the Weever Apps Configuration screen
1. Copy templates/weever-content-single.php to your current theme to customize the look of individual pages / posts
1. Add custom CSS in the 'Logo, Images and Theme' tab, under 'Advanced Theme Settings'

You can determine the appropriate CSS classes to use by loading your private app URL in a Webkit browser such as Google Chrome or Safari, and inspecting the appropriate HTML elements.

== Screenshots ==

1. Select blog content by category, tag, search terms, and custom taxonomy
2. Sample page content
3. Easily add maps using standard Wordpress post geolocation data
4. Include social media feeds from Twitter, Identi.ca and Facebook
5. Event listing from Facebook or Google Calendar
6. Photos from Flickr, Facebook, Foursquare
7. Video streams from Youtube, Vimeo
8. Contact information
9. Forms generated using Wufoo
10. Add to launch screen ability with customizable icon

== Changelog ==

= 1.3.1 =
* Added query param to scripts and stylesheets to force reload on plugin update

= 1.3 =
* Added maps support
* Fixes various issues with the UI

= 1.2 =
* Ability to customize the app using Wordpress theme files (weever-content-single.php, weever.css)
* Additional 'landing page' tab
* Several plugin UI improvements

= 1.1.2 =
* Slight changes to interface
* Correct issue with feed filter

= 1.1 =
* Changes to interface
* Updated theme configuration loading
* Several minor fixes

= 1.0 =
* Initial release

== Upgrade Notice ==

= 1.3.1 =
* Added query param to scripts and stylesheets to force reload on plugin update

= 1.3 =
Maps support and several UI issues fixed

= 1.2 =
Ability to customize the app using Wordpress themes, additional 'Welcome' tab, UI improvements

= 1.1.2 =
Corrects issue with feed filter, update recommended

= 1.1 =
Minor fixes and better support of theme configuration features

= 1.0 =
Initial version
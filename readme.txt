=== TagPages ===
Contributors: neoxx
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=bernhard%40riedl%2ename&item_name=Donation%20for%20Featuring%20CountComments&no_shipping=1&no_note=1&tax=0&currency_code=EUR&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: taxonomy, taxonomies, tag, tags, tagging, page, pages, post-tag, post-tags, page-tag, page-tags, multisite, multi-site
Requires at least: 3.0
Tested up to: 3.1
Stable tag: trunk

Adds post-tags functionality for pages.

== Description ==

This plugin is a follow-up to [my post](http://www.neotrinity.at/2007/10/06/wordpress-23-tagging-posts-and-pages/) which I wrote a few years ago. - The idea was (and still is) to equip pages with [tags](http://en.support.wordpress.com/posts/post-tags/) and include them with the total count in a combined posts and pages [tag-cloud](http://codex.wordpress.org/Function_Reference/wp_tag_cloud).

Requirements for current version:

* WordPress 3.0 or higher
* PHP 5 or higher
* You can check your PHP version with the [Health Check](http://wordpress.org/extend/plugins/health-check/) plugin.

== Installation ==

1. Copy the `tagpages` directory into your WordPress plugins directory (usually wp-content/plugins). Hint: You can also conduct this step within your Admin Menu.

2. In the WordPress Admin Menu go to the Plugins tab and activate the TagPages plugin.

3. Be happy and celebrate! (and maybe you want to add a link to [http://www.neotrinity.at/projects/](http://www.neotrinity.at/projects/))

== Frequently Asked Questions ==

= How can I display the chosen tags on my pages? =

You can use for example the built-in Theme Editor of WordPress to edit `page.php` (if such a template exists for your theme). WordPress provides two template functions which can be used out-of-the-box: [`the_tags`](http://codex.wordpress.org/Function_Reference/the_tags) and `get_the_tags`.

For further information about themes, please refer to the WordPress Codex Pages for [Theme Development](http://codex.wordpress.org/Theme_Development) or the user's manual of our theme.

= Will the tags which I've created with tags4page be lost? =

No, both TagPages and [tags4page](http://wordpress.org/extend/plugins/tags4page/) (and also some other plugins) are based on the built-in taxonomy of WordPress. - Your tags and their relations to posts and pages will not be harmed. ;)

= Why do the Post Tags sections for posts and pages in the Admin Menu show the same tag count? =

The reason for that is that we combine the number of occurrences of tags used in posts and pages in the taxonomy `Post Tags`. Though, if you click on the number of a certain tag, WordPress will only show the related posts or pages of the selected tag.

= Does TagPages work for WordPress prior 3.0? =

Sorry folks, no it doesn't. - But you can have a look at [my post](http://www.neotrinity.at/2007/10/06/wordpress-23-tagging-posts-and-pages/), which explains how to establish tags functionality for pages in WordPress 2.3 - 2.9.

== Screenshots ==

1. This screenshot shows editing a page in the Admin Menu.

2. The second picture shows the Pages section in the Admin Menu.

== Upgrade Notice ==

No upgrade notices so far...

== Changelog ==

= 1.30 =

* enhanced compatibility with other custom taxonomy/post type plugins

= 1.20 =

* changed behaviour of Tags section for posts so only posts will be shown.
* implemented i18n for consistency - currently only one line ;)
* added German translation
* applied some minor internal changes

= 1.10 =

* all the fingers crossing didn't help. ;) Sorry, I screwed up and forgot to include some code, which prevented the tagged pages from showing up in the front-end (your theme)...
* added some meta-data to the front- and back-end

= 1.00 =

* initial release (fingers crossed)
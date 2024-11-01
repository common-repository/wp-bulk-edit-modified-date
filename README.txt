=== Last-Modified-Bulk ===
Contributors: bdavidadv
Donate link: https://socialmob.com
Tags: posts, modified date, change modified date, bulk update modified date
Requires at least: 3.3
Requires PHP: 5.4
Tested up to: 4.9.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin exposes the Date Modified column for each post to the All Posts Table. Also adds the ability to set the post_modified to the current time in bulk edit

== Description ==

This plugin exposes the Date Modified column for each post to the All Posts Table, which is sortable. Also adds the ability to set the post_modified to the current time in bulk edit.


== Installation ==

1. Upload `Last-Modified-Bulk` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How do I update the Modified Date of Posts in Bulk =

Select posts. Select Edit from the 'Bulk Actions Menu'. Find Modified Date. Select Edit from the dropdown. Check 'Set Modified Date To now'. Click Update


== Screenshots ==

1. screenshot-1.png shows the Modified Date in the Posts Table
2. screenshot-2.png shows the ability to set the Modified Date in a Bulk Operation

== Changelog ==

= 1.0 =
* Initial Launch of Plugin.

== Upgrade Notice ==

= 1.0 =
Initial Launch of Plugin

== Arbitrary section 1 ==

This plugin adds an extra section to the bulk edit screen in the admin section. It is a checkbox, that when checked and the "Set" button is clicked will make an ajax call to your server.
There is a new endpoint that receives this call and then updates each post chosen with the current time. This allows old posts to have there modified date changed.
This comes in handy if you need to refresh content for Facebook IA articles, especially the addition of scripts. Facebook uses the "op-modified" to refresh IA articles.
This provides a simple way to refresh content, if scripts have been changed.
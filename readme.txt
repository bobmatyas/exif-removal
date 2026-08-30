=== EXIF Remover ===
Contributors: lastsplash
Tags: exif, images
Requires at least: 6.9
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Remove EXIF data from images on upload.

== Description ==

Enhance your website's privacy and security with EXIF Remover. This tool automatically strips away all EXIF metadata from image uploads, ensuring that sensitive information—such as location data, camera settings, and timestamps—remains confidential.

By eliminating this data, you protect your visitors' privacy and reduce the risk of exposing personal information inadvertently. The EXIF Data Remover is easy to install and seamlessly integrates with your media library, allowing you to focus on your content without worrying about hidden data leaks.

Key Features:

- Automatic removal of EXIF data from all uploaded images.
- No configuration (just install and activate).
- Enhances user privacy and security by preventing data exposure.

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress.
2. Once activated, the plugin will start working on new image uploads. There are no user configured settings.

== Frequently Asked Questions ==

= Will this work on my hosting provider?

It should as long as your host has the Imagick or GD libraries installed. I have tested it on a few different environments and had no issues.

== Screenshots ==


== Changelog ==

= 1.0.4 =
* Tested up to WordPress 7.1.

= 1.0.3 - 07/04/26 =
- Indicate compatibility with WordPress v7.0
- Raise minimum WordPress version to 6.9
- Fix Plugin Check flagged issues

= 1.0.2 - 11/28/25 =
- Indicate compatibility with WordPress v6.9
- Switch from `add_action` to `add_filter`

= 1.0.1 =
- Indicate compatibility with WordPress v6.8.x
- Add plugin icon

= 1.0.0 =
- Initial Release.

== Screenshots ==

1. Not yet.
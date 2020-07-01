=== Multiple Roles ===
Contributors: SeventhSteel, mista-flo
Tags: multiple roles, multiple roles per user, user roles, edit user roles, edit roles, more than one role, more than one role per user, more than one role for each user, many roles per user, unlimited roles
Requires at least: 3.1
Tested up to: 5.4.2
Stable tag: 1.3.1
Requires PHP: 5.4
Donate link: https://www.paypal.me/FlorianTIAR/5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allow users to have multiple roles on one site.

== Description ==

This plugin allows you to select multiple roles for a user - something that WordPress already supports "under the hood", but doesn't provide a user interface for.

User edit and Add new user screens will display a checklist of roles instead of the default role dropdown. The main user list screen will also display all roles a user has.

It also supports well Multisite mode.

That's it. No extra settings.

If you want to contribute to this plugin, feel free to check the Github repository : https://github.com/Mahjouba91/multiple-roles

== Installation ==

= Automatic Install =

1. Log into your WordPress dashboard and go to Plugins &rarr; Add New
2. Search for "Multiple Roles"
3. Click "Install Now" under the Multiple Roles plugin
4. Click "Activate Now"

= Manual Install =

1. Download the plugin from the download button on this page
2. Unzip the file, and upload the resulting `multiple-roles` folder to your `/wp-content/plugins` directory
3. Log into your WordPress dashboard and go to Plugins
4. Click "Activate" under the Multiple Roles plugin

== Frequently Asked Questions ==

= Who can edit users roles? =

Anyone with the `promote_users` capability. By default, that means only administrators and network administrators on multi-site.

= Can you edit your own roles? =

If you're a network administrator on a multi-site setup, yes, you can edit your roles in sites of that network. Otherwise, no. This is how WordPress works normally too.

= I'm on the user edit screen - where's the checklist of roles? =

It's underneath the default profile stuff, under the heading "Permissions". If you still can't find it, you might be on your own profile page, or you might not have the `promote_users` capability.

= Can you remove all roles from a user? =

Sure. The user will still be able to log in and out, but won't be able to access any admin screens or see private pages. However, the user will still be able to see the WP Toolbar by default, which displays links to the Dashboard and Profile screens, so clicking on those will result in seeing a permission error.

== Screenshots ==

1. The roles checklist on Edit User screens
2. The Users screen with the enhanced Roles column

== Changelog ==

= 1.3.1 =
* 1st july 2020
* Test the plugin against WordPress 5.4
* Fix an issue when the user role could be lost because of a wrong check in the backend

= 1.3.0 =
* 12 april 2018
* Use 'promote_users' cap instead of ‘edit_users’
* Fixed bug preventing us from unsetting a user's roles
* Only remove get_editable_roles() roles on update
* Thanks to <a href="https://github.com/thomasfw/">thomasfw</a> for the contributions

= 1.2.0 =
* 21 august 2017
* Check compatibilty with WP 4.8.1
* Translation of roles names : thanks to <a href="https://profiles.wordpress.org/benjaminniess/">Benjamin Niess</a>
* Mutlisite enhancement : Use a WP 4.8 filter to easier edit signup user meta

= 1.1.4 =
* 23 december 2016
* Fix fatal error in new user in single site : After adding an user, a wp_die error was shown "You can’t give users that role", it was due to changes in 1.1.2
* Workaround to handle multisite support without breaking single site features

= 1.1.3 =
* 22 december 2016
* Fix fatal error in user update : After updating an user, a wp_die error was shown "You can’t give users that role", it was due to changes in 1.1.2

= 1.1.2 =
* 21 december 2016
* Fix bug in multisite : After adding a new user with email confirmation, the multiple roles were not set, so the user did not have any roles on the site

= 1.1.1 =
* 3 november 2016
* Remove PHP closure to ensure Backward Compatibility with PHP versions < 5.3

= 1.1 =
* 24 october 2016
* New maintainer : Florian TIAR, you're strongly encouraged to update this plugin
* Add support of role checkbox in new user form (admin)
* Add Multisite support (for new user form)
* Add i18n support (text domain, translatable strings and pot file)
* Add some hooks (actions and filters)
* Fix issue where some low level users could add admin users
* Sanitize and escape all data
* Enhance UX of the form

= 1.0 =
* 2015
* Initial release

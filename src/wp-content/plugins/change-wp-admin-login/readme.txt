=== Change WP Admin Login ===
Tags:              login url, login, wp admin, wp login, custom login
Contributors:      wpexpertsio
Author: wpexpertsio
Requires at least: 4.5
Tested up to:      6.3
Stable tag:        1.1.8
License:           GPL-2.0+


== Description ==

*Change WP Admin Login* is an easy-to-use WordPress plugin that allows you to safely change your WordPress website's admin login URL to anything you want. 

The plugin's simple two-step process ensures the safety of your WordPress admin login URL within seconds, and all of this without any coding. 

**Security against malicious activity** - Anyone can find your WordPress website's default login page, and this can increase the chances of security breaches like brute force attacks and other cyber threats. Change wp-admin Login plugin allows you to change your admin login URL and redirect any user to a redirection URL.   

Change wp-admin Login plugin does not rename or change files in the core but instead simply intercepts page requests and redirects to another URL. 

= Why use Change wp-admin Login plugin? =
- Protect your WordPress website from brute force attacks.
- Quick two-step process that doesn't require coding.
- Easy to secure your WordPress website from hackers and cyber attacks.
- Only grant access to people you trust.
- Hide your login page from malicious activity. 
- Easier than creating a custom login Url.

== New Feature ==

**Redirect Custom Field**

Accessing the wp-login.php page or the wp-admin directory without logging in will redirect you to the page defined on the redirect custom field. Leaving the redirect custom field empty will activate the default settings (redirect to the website's homepage).

= How it works? =

Go under Settings, click "Permalinks" and change your URL under "Change wp-admin login".

Step 1: Add a new login URL
Step 2: Add redirect URL

**Note** - After you activate this plugin, the wp-admin directory and wp-login.php page will become unavailable, so you should bookmark or remember the URL. Disabling this plugin brings your site back exactly to its previous state.

== Support ==

**Like this plugin?** Please [Rate It](https://wordpress.org/support/plugin/change-wp-admin-login/reviews/?filter=5)

**Have a problem?** Please write a message in the [WordPress Support Forum](https://wordpress.org/support/plugin/change-wp-admin-login/)

== Installation ==

1. Go to Plugins, and click on "Add New".
2. Search for *Change wp-admin login*.
3. Download, install, and activate it.
4. Go under Settings and then click on "Permalinks" and change your URL under "Change wp-admin login"
5. You can change this anytime; just go back to Settings > Permalinks > Change wp-admin login.

== Frequently Asked Questions ==

= I can't log in? =
In case you forgot the login URL or for any other reason you can't log in on the website, you will need to delete the plugin via SFT/FTP or cPanel on your hosting.

Path for the plugin folder:
/wp-content/plugins/change-wp-admin-login

Advanced users:
Go to your MySQL database and look for the value of rwl_page in the options table

Advanced users (multisite):
Go to your MySQL database and look for the rwl_page option will be in the site meta table or options table.

= Does it work with TranslatePress? =
You need to select the option NO "Use a subdirectory for the default language".

= Does it work with Polylang? =
Yes, it works, but not been tested with the URL option "The language is set from different domains".

= Does it work on WordPress Multisite with Subdirectories? =
Yes, it does work. You should set up the login URL in each website (Settings-->Permalinks)

= Does it work on WordPress Multisite with Subdomains? =
Yes, it does work. You should set up the login URL in each website (Settings-->Permalinks)

= Does it work with Buddyboss? =
No, Buddyboss has its own wp-admin redirect functions.

= Does it work with BuddyPress? =
No, BuddyPress has its own wp-admin redirect functions.

== Changelog ==

= 1.1.8 =
* Fixed: compatibility issues with WPForms, WordFence 
= 1.1.7 =
* Fixed: Redirection to wp-admin when trying to access admin pages directly.

= 1.1.6 =
* Fixed: The recent commit has been reverted to address conflicts in various cases

= 1.1.5 =
* Fixed: Resolved the issue undefined “is_user_logged_in” function error in certain cases.

= 1.1.4 =
* Fixed: Redirection to wp-admin when trying to access admin pages directly.

= 1.1.3 =
* Handover plugin

= 1.1.2 =
* More Fixes for php8 warnings 

= 1.1.1 =
* Fix php8 warnings 

= 1.1.0 =
* Update WordPress API settings

= 1.0.9 =
* fix security issue

= 1.0.8 =
* fix security issue

= 1.0.7 =
* fix missing register_setting on the add_settings_field

= 1.0.6 =
* fix suppressed warning

= 1.0.5 =
* add site URL before the new redirect input field

= 1.0.4 =
* Add redirect custom field.
* Better instructions in how to use the redirect field

= 1.0.3 =
* Add redirect custom field.
* When someone tries to access the wp-login.php page or the wp-admin directory while not logged in will be redirected to the page you defined on the redirect custom field.

= 1.0.2 =
* Add translations

= 1.0.1 =
* Add automatic redirect for when someone tries to access the wp-login.php page or the wp-admin directory while not logged in will be redirected to the website homepage.

= 1.0.0 =
* Initial version.
=== Wordpress SMS ===
Contributors: mostafa.s1990
Donate link: http://mostafa-soufi.ir/donate/
Tags: sms, wordpress, send, subscribe, sms subscribe, message, register, notification, webservice, sms panel
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 2.3.3

Send a SMS via WordPress, Subscribe for sms newsletter and send an SMS to the subscriber newsletter.

== Description ==
Very easy SMS Send by WordPress.

1. `global $obj;`
2. `$obj->to = array('09000000000');`
3. `$obj->msg = "Hello World!";`
4. `$obj->send_sms();`

= Features =

* Send SMS to number and numbers
* Send SMS to subscribes
* Subsribe sms
* Show credit
* Send SMS via FLASH
* Widget support
* Support shortcode
* Support suggestion post by SMS.
* Send activation from subscribe.
* Notification SMS when published new post to subscribers.
* Notification SMS when the new release of WordPress.
* Notification SMS when registering a new user.
* Notification SMS when get new comment.
* Notification SMS when user login.

= Translators =

* English
* Persian
* Arabic (Thanks Hamad Al-Shammari)
* Portuguese (Thanks Matt Moxx)

Send email for Translation files: mst404[a]gmail[dot].com
for translate, please open langs/default.po by Poedit and translate strings.

= Support =
* [Donate to this plugin](http://mostafa-soufi.ir/donate/)
* [Persian Support](http://forum.wp-parsi.com/forum/17-%D9%85%D8%B4%DA%A9%D9%84%D8%A7%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1/)

== Installation ==
1. Upload `wp-sms` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. To display Subscribe goto Themes -> Widgets, and adding `Subscribe to SMS` into your sidebar Or using this functions: `<?php wp_subscribes(); ?>` into theme.
4. Using this functions for send manual SMS:

* First: `global $obj;`
* Enter the recipient's mobile number: `$obj->to = array('MobileNumber');`
* Enter the SMS text: `$obj->msg = "YourMessage";`
* Send SMS: `$obj->send_sms();`

or using this Shortcode `[subscribe]` in Posts pages or Widget.

== Screenshots ==
1. Screen shot (screenshot-1.png) in SMS Setting Page.
2. Screen shot (screenshot-2.png) in Webservice page.
3. Screen shot (screenshot-3.png) in Newslleter page.
4. Screen shot (screenshot-4.png) in Features page.
5. Screen shot (screenshot-5.png) in Notifications page.
6. Screen shot (screenshot-6.png) in Send SMS Page.
7. Screen shot (screenshot-7.png) in SMS Posted Page.
8. Screen shot (screenshot-8.png) in Subscribe list Page.
9. Screen shot (screenshot-9.png) in Dashboard right now.
10. Screen shot (screenshot-10.png) in SMS Subscribe widget.
11. Screen shot (screenshot-11.png) in Subscribe new-post.php.
12. Screen shot (screenshot-12.png) in Suggestion post in single.
13. Screen shot (screenshot-13.png) in Contact Form 7 page.

== Upgrade Notice ==
= 2.0 =
* BACKUP YOUR DATABASE BEFORE INSTALLING!

== Changelog ==
= 2.3.3 =
* Added: Asia Payamak Webservice.

= 2.3.2 =
* Added: Arad SMS Webservice.

= 2.3.1 =
* Added: Notification SMS when get new order from Woocommerce plugin.
* Added: Notification SMS when get new order from Easy Digital Downloads plugin.

= 2.3 =
* Added: Tabs option in setting page.
* Added: Notification SMS when registering a new user.
* Added: Notification SMS when get new comment.
* Added: Notification SMS when user login.
* Added: Text format to published new post notification.
* Added: MP Panel Webservice.
* Added: Mediana Webservice.

= 2.2.5 =
* Changed: Aadat 24 web service.
* Changed: Parand Host web service URL.

= 2.2.4 =
* Added: Adpdigital Webservice.
* Added: Joghataysms Webservice.
* Fixed: Iransmspanel webservice.
* Changed: Parand Host web service URL.
* Changed: Hi SMS web service URL.
* Changed: Nasrpayam web service URL.

= 2.2.2 =
* Added: Hi SMS Webservice.

= 2.2.1 =
* Added: Niazpardaz Webservice.
* Fixed: Oplio Webservice.

= 2.2 =
* Added: Payameroz Webservice.
* Added: Unisender Webservice.
* Fixed: small bug in cf7.

= 2.1 =
* Resolved: include tell-a-freind.php file.

= 2.0 =
* Added: Metabox sms to Contact Form 7 plugin.
* Added: SMS Message sender page.
* Added: PayamResan Webservice.
* Optimized: include files.
* Resolved: create tables when install plugin.
* Language: updated.

= 2.0.2 =
* Resolved: loading image.
* Added: Fayasms Webservice.

= 2.0.1 =
* Added: SMS Bartar Webservice.

= 2.0 =
* Added: Pagination in Subscribes Newsletter page.
* Added: Group for Subscribes.
* Optimized: jQuery Calling.
* Resolved: Subscribe widget form.
* Resolved: Small problems.

= 1.9.22 =
* Added: Nasrpayam Webservice.

= 1.9.21 =
* Added: Caffeweb Webservice.

= 1.9.20 =
* Resolved: add subscriber in from Wordpress Admin->Newsletter subscriber.
* Added: TCIsms Webservice.

= 1.9.19 =
* Added: ImenCms Webservice.

= 1.9.18 =
* Added: Textsms Webservice.

= 1.9.17 =
* Added: Smsmart Webservice.

= 1.9.16 =
* Added: PayamakNet Webservice.

= 1.9.15 =
* Added: BarzinSMS Webservice.
* Update: jQuery to 1.9.1.

= 1.9.14 =
* Resolved: opilo Webservice.

= 1.9.13 =
* Resolved: paaz Webservice.

= 1.9.12 =
* Added: JahanPayamak Webservice.

= 1.9.11 =
* Added: SMS-S Webservice.
* Added: SMSGlobal Webservice.
* Added: paaz Webservice.
* Added: CSS file in setting page.
* Resolved: Loads the plugin's translated strings problem.
* Language: updated.

= 1.9.10 =
* Added: Tablighsmsi Webservice.

= 1.9.9 =
* Added: Smscall Webservice.

= 1.9.8 =
* Added: Smsdehi Webservice.

= 1.9.7 =
* Added: Sadat24 Webservice.

= 1.9.6 =
* Added: Arabic language.
* Added: Notification SMS when messages received from Contact Form 7 plugin.
* Small changes in editing Subscribers.

= 1.9.5 =
* Added: Ariaideh Web Service.

= 1.9.4 =
* Added: Persian SMS Web Service.

= 1.9.3 =
* Added: SMS Click Web Service.

= 1.9.2 =
* Added: ParandHost Web Service.
* Troubleshooting jQuery in Send SMS page.

= 1.9.1 =
* Added: PayameAvval Web Service.

= 1.9 =
* Added: SMSFa Web Service.
* Optimize in translation functions.
* Added: edit subscribers.

= 1.8 =
* Added: your mobile number.
* Added: Enable/Disable calling jQuery in wordpress.
* Added: Notification of a new wordPress version by SMS.

= 1.7.1 =
* Fix a problem in jquery.

= 1.7 =
* Fix a problem in Get credit method.
* Fix a problem in ALTER TABLE.
* Fix a problem Active/Deactive all subscribe.

= 1.6 =
* Added Enable/Disable User in subscribe page.
* Fix a problem in show credit.
* Fix a problem in menu link.
* Fix a problem in word counter.

= 1.5 =
* Added: Hostiran Web Service.
* Added: Iran SMS Panel Web Service.
* Remove Orangesms Service.
* Added Activation subscribe.
* Optimize plugin.
* Update jquery to 1.7.2

= 1.4 =
* Added: Portuguese language.
* Update last credit when send sms page.

= 1.3.3 =
* Fix a problem.
* Fix a display the correct number in the list of newsletter subscribers.

= 1.3.2 =
* Fix a problem.

= 1.3.1 =
* Fix a problem.
* Fix credit unit in multi language.

= 1.3 =
* Added: register link for webservice.
* Added: Suggestion post by SMS.

= 1.2 =
* Fix a problem.

= 1.1 =
* Adding show SMS credit in the dashboard right now.
* Adding show total subscribers in the dashboard right now.
* Adding Shortcode.
* Added: Panizsms Web Service.
* Added: Orangesms Web Service.

= 1.0 =
* Start plugin
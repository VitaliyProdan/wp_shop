=== YITH WooCommerce Stripe ===

Contributors: yithemes
Tags: stripe, simple stripe checkout, stripe checkout, credit cards, online payment, payment, payments, recurring billing, subscribe, subscriptions, bitcoin, gateway, yithemes, woocommerce, shop, ecommerce, e-commerce
Requires at least: 4.2
Tested up to: 4.4.2
Stable tag: 1.2.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The YITH WooCommerce Stripe plugin let you add a new payment gateway based on Stripe.com

== Description ==

Stripe is a WooCommerce extension, that allows you to add a new payment gateway into your e-commerce website and gives your
users the possibility to pay directly by credit card through Stripe.com checkout.

Stripe is available in the United States, Canada, the UK, Australia, Belgium, France, Germany, Ireland, The Netherlands
and more – see [What countries does stripe support?](https://stripe.com/global)

Stripe advantages:

*   "Proven fraud protection", stripe actively works to protect your business from fraudulent charges and monitors suspicious transactions.
*   "Act locally, work globally", work with international customers right out of the box while still getting paid in your preferred currency.
*   "Operations, simplified", handling billing support and disputes is easy with Stripe — address issues with a few clicks, or automate it.
*   "Battle-tested systems", [high availability](https://status.stripe.com/), transparent uptime reporting, and always ready for high transaction throughput.
*   "Seamless security", stripe provides security and compliance without the headaches.

Please, read the the **[official plugin documentation](http://yithemes.com/docs-plugins/yith-woocommerce-stripe)** to know all plugin features.

== Installation ==

1. Unzip the downloaded zip file.
2. Upload the plugin folder into the `wp-content/plugins/` directory of your WordPress site.
3. Activate `YITH WooCommerce Stripe` from Plugins page

= Configuration =

YITH WooCommerce Stripe will add a new settings tab called "Stripe", into Woocommerce -> Settings -> Checkout -> Stripe. Here you are able to configure all the plugin settings.
You need to register an account to [Stripe.com](https://stripe.com/) and set the API key in the plugin settings.
You can get the API keys from [your stripe dashboard](https://dashboard.stripe.com/account/apikeys).

== Frequently Asked Questions ==

= Does this plugin support Stripe Checkout? =
Yes it does! After user has compiled all information on checkout page, you will be redirect to payment page where there is the Stripe Checkout button and pay.

= Which countries does Stripe support? =
Stripe is available in many countries and is constantly expanding to more. To see if your country is supported, visit the [Stripe Global page](https://stripe.com/global).

= Does Stripe require that my site have an SSL certificate? =
Yes, an SSL certificate should always be used with Stripe. All pages that include a payment form should be prefixed with https://, not http://. See [Stripe’s SSL page](https://stripe.com/help/ssl) for more information.


== Screenshots ==

1. The payment method on checkout page
2. Pay page
3. Stripe.com Checkout panel
4. Settings

== Changelog ==

= 1.2.7.1 - Released on Apr 11, 2016 =

* Fixed: missing files causing warnings

= 1.2.7 - Released on Apr 06, 2016 =

* Fixed: fatal error with Stripe\Error\API
* Fixed: wrong cart total on hosted checkout
* Fixed: internal server error if the import is lower then .50 cent

= 1.2.5 - Released on Feb 16, 2016 =

* Fixed: stripe library loading causing fatal error in some servers

= 1.2.4 - Released on Jan 19, 2016 =

* Added: compatibility with WooCommerce 2.5
* Added: language support for "Stripe checkout" mode
* Updated: Stripe API library with latest version

= 1.2.3 - Released on Dec 14, 2015 =

* Fixed: no errors for wrong cards during checkout

= 1.2.2 - Released on Dec 10, 2015 =

* Added: compatibility to multi currency plugin

= 1.2.0 - Released on Aug 12, 2015 =

* Added: Support to WooCommerce 2.4
* Updated: Plugin core framework
* Updated: Language pot file

= 1.1.0 - Released: Apr 22, 2015 =

* Added: support to WordPress 4.2

= 1.0.4 - Released: Apr 21, 2015 =

* Updated: Languages pot catalog

= 1.0.3 - Released: Apr 15, 2015 =

* Updated: Stripe API
* Fixed: minor bugs

= 1.0.2 - Released: Mar 04, 2015 =

* Updated: Plugin core framework

= 1.0.1 - Released: Mar 03, 2015 =

* Fixed: minor bugs

= 1.0.0 =

* Initial release
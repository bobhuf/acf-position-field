=== Position Custom Field for ACF ===
Contributors: Taggetig
Tags: acf, custom fields, positioning, grid layout
Requires at least: 5.0
Tested up to: 6.2
Stable tag: 1.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A flexible Advanced Custom Fields extension for creating position-based custom fields with preset and custom value options, including the ability to disable specific positions.

== Description ==

Position Custom Field extends Advanced Custom Fields (ACF) by adding a specialized positioning field. This plugin allows you to:

* Select from preset positioning options in a 3x3 grid layout
* Define custom values for each position
* Disable specific positions to restrict available choices
* Flexibly return either preset or custom values

Perfect for developers needing granular control over positioning in WordPress themes and plugins.

== Key Features ==

* Visual 3x3 grid interface
* Single position selection
* Disable specific positions
* Custom value override for each position
* Accessible keyboard navigation

== Installation ==

1. Ensure Advanced Custom Fields (ACF) is installed and activated
2. Upload the `position-field-plugin` folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Configuration ==

= Position Settings =

For each position in the 3x3 grid, you can:
* Enable/disable the position using the toggle switch
* Set a custom value when using custom return format
* Positions that are disabled cannot be selected by users

= Return Format Options =
* String: Returns position as "top-left", "center-center", etc.
* Custom Values: Returns your defined custom text for each position

== Frequently Asked Questions ==

= How do I disable specific positions? =
In the field settings, each position has a toggle switch to enable/disable it. Disabled positions will be unclickable in the grid interface.

= Can I re-enable a disabled position? =
Yes, simply toggle the switch back to enabled in the field settings.

= What happens if a disabled position was previously selected? =
When a position becomes disabled, any content using that position should be updated to use an enabled position.

== Screenshots ==

1. Position field configuration in ACF
2. Custom value input options
3. Disable toggles for each position

== Changelog ==

= 1.0 =
* Initial release of the Position Custom Field plugin
* Added 3x3 grid interface
* Implemented position disable functionality
* Added custom value support

== Upgrade Notice ==

= 1.0 =
Initial release. Please ensure compatibility with your WordPress and ACF versions.

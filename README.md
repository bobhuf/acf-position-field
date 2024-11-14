# Position Grid Field Plugin for Advanced Custom Fields

## Description
This WordPress plugin extends Advanced Custom Fields (ACF) by adding a custom Position field that allows flexible positioning options in a 3x3 grid layout, with the ability to disable specific positions.

## Features
- Visual 3x3 grid layout for position selection
- Enable/disable individual positions
- Option to use preset positions or define custom values
- Flexible return value configuration
- Accessible interface with keyboard navigation

## Installation
1. Ensure Advanced Custom Fields (ACF) is installed and activated
2. Upload the `position-field-plugin` folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

## Field Settings

### Position Control
Each position in the 3x3 grid can be:
- Enabled or disabled using a toggle switch
- Assigned a custom value (when using custom return format)
- Disabled positions are unclickable in the interface

### Return Format Options
- **String**: Returns standard position identifiers (e.g., "center-center")
- **Custom Values**: Returns your defined text for each position

### Example Usage
```php
// Get the position value
$position = get_field('your_position_field_name');

// Example conditional based on position
if ($position === 'center-center' && !get_field('disabled_center-center')) {
    // Handle centered content
}
```

## Managing Disabled Positions
- Use the toggle switches in field settings to enable/disable positions
- Disabled positions cannot be selected in the grid interface
- Previously selected positions that become disabled should be updated
- Re-enable positions at any time by toggling the switch back

## Requirements
- WordPress 5.0+
- Advanced Custom Fields (ACF) Pro or Free
- PHP 7.2 or higher

## Support
For issues or feature requests, please contact [Taggetig](https://taggetig.be)

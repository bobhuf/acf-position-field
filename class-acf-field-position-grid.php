<?php
// Prevent direct file access
if (!defined('ABSPATH')) {
    exit;
}

// Ensure the ACF field class is loaded
if (!class_exists('acf_field')) {
    return;
}

if (!class_exists('acf_field_position_grid')) {
    class acf_field_position_grid extends acf_field {
        public function __construct() {
            $this->name = 'position_grid';
            $this->label = __('Position Grid', 'text_domain');
            $this->category = 'layout';
            $this->defaults = [
                'return_format' => 'string',
                'custom_values' => [],
                'disabled_positions' => [],
            ];

            parent::__construct();
        }

        public function render_field_settings($field) {
            acf_render_field_setting($field, [
                'label' => __('Return Format', 'text_domain'),
                'instructions' => __('Choose how the position value is returned', 'text_domain'),
                'type' => 'radio',
                'name' => 'return_format',
                'choices' => [
                    'string' => __('String (e.g., "center-center")', 'text_domain'),
                    'custom' => __('Custom Values', 'text_domain'),
                ],
            ]);

            // Custom values and disabled options for each position
            $positions = [
                'top-left', 'top-center', 'top-right',
                'center-left', 'center-center', 'center-right',
                'bottom-left', 'bottom-center', 'bottom-right'
            ];

            foreach ($positions as $pos) {
                // Custom value setting
                acf_render_field_setting($field, [
                    'label' => sprintf(__('Custom Value for %s', 'text_domain'), str_replace('-', ' ', ucwords($pos))),
                    'type' => 'text',
                    'name' => 'custom_' . $pos,
                    'conditional_logic' => [
                        [
                            [
                                'field' => 'return_format',
                                'operator' => '==',
                                'value' => 'custom',
                            ]
                        ]
                    ],
                    'wrapper' => [
                        'class' => 'acf-field-setting-label'
                    ]
                ]);

                // Disabled setting
                acf_render_field_setting($field, [
                    'label' => sprintf(__('Disable %s', 'text_domain'), str_replace('-', ' ', ucwords($pos))),
                    'type' => 'true_false',
                    'name' => 'disabled_' . $pos,
                    'ui' => 1,
                    'wrapper' => [
                        'class' => 'acf-field-setting-label'
                    ]
                ]);
            }
        }

        public function render_field($field) {
            $value = empty($field['value']) ? '' : $field['value'];
            $positions = [
                'top-left', 'top-center', 'top-right',
                'center-left', 'center-center', 'center-right',
                'bottom-left', 'bottom-center', 'bottom-right'
            ];
            ?>
            <div class="acf-position-grid">
                <?php foreach ($positions as $pos): 
                    $is_selected = ($value === $pos);
                    $input_id = $field['id'] . '_' . $pos;
                    $is_disabled = !empty($field['disabled_' . $pos]);
                ?>
                    <label for="<?php echo esc_attr($input_id); ?>">
                        <input type="radio" 
                               id="<?php echo esc_attr($input_id); ?>"
                               name="<?php echo esc_attr($field['name']); ?>" 
                               value="<?php echo esc_attr($pos); ?>"
                               <?php checked($is_selected); ?>
                               <?php disabled($is_disabled); ?> />
                        <span class="screen-reader-text"><?php echo esc_html(str_replace('-', ' ', ucwords($pos))); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php
        }

        public function format_value($value, $post_id, $field) {
            if (empty($value)) {
                return '';
            }

            if ($field['return_format'] === 'custom' && !empty($field['custom_' . $value])) {
                return $field['custom_' . $value];
            }

            return $value;
        }
    }
} 
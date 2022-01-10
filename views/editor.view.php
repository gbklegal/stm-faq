<?php

$wp_editor_settings = [
    'media_buttons' => false,
    'drag_drop_upload' => false
];

wp_editor('Test', 'textarea', $wp_editor_settings);
<?php

/*
    - editFaqItem
    - createFaqItem
 */


/**
 * Get FAQ Items returns all Q and A from database
 * @return array
 */
function getFaqItems():array {
    global $wpdb;

    $results = $wpdb->get_results('SELECT question, answer FROM stm_faq ORDER BY position ASC', 'ARRAY_A');

    return $results;
}
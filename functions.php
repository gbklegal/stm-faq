<?php

/*
    - editFaqItem (prepared statement!)
    - createFaqItem (prepared statement!)
 */


/**
 * Get FAQ Items returns all Q and A from database
 * @return array
 */
function getFaqItems():array {
    global $wpdb;

    $results = $wpdb->get_results('SELECT id, question, answer FROM stm_faq ORDER BY position ASC', 'ARRAY_A');

    return $results;
}

/**
 * Get a specific FAQ Item by ID that returns all Q and A from database
 * @param string|int
 * @return array
 */
function getFaqItem( $id ):array {
    global $wpdb;

    $results = $wpdb->get_results("SELECT id, question, answer FROM stm_faq WHERE id = {$id}", 'ARRAY_A');
    $result = $results[0];

    if (!$result)
        return [];

    return $result;
}





/**
 * 
 */
function createFaqItem( string $question, string $answer ):bool {
    global $wpdb;

    $wpdb->insert('stm_faq', [
        'question' => $question,
        'answer' => $answer
    ]);

    var_dump($wpdb->insert_id);

    return false;
}


// createFaqItem( 'Test Frage 2', 'Test Antwort 2' );
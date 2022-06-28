<?php

/*
    - edit_faq_item (prepared statement!)
    - create_faq_item (prepared statement!)
 */


/**
 * Get FAQ Items returns all Q and A from database
 * 
 * @param string $lang - optional
 * 
 * @return array
 */
function get_faq_items( string $lang = 'de' ):array {
    global $wpdb;

    if (!in_array($lang, STM_FAQ_LANGS))
        $lang = 'de';

    $prepared_sql = $wpdb->prepare('SELECT id, question, answer, lang FROM stm_faq WHERE lang = %s ORDER BY position ASC', $lang);
    $results = $wpdb->get_results($prepared_sql, 'ARRAY_A');

    return $results;
}

/**
 * Get a specific FAQ Item by ID that returns all Q and A from database
 * 
 * @param string|int
 * 
 * @return array
 */
function get_faq_item( $id ):array {
    global $wpdb;

    $results = $wpdb->get_results("SELECT id, question, answer, lang FROM stm_faq WHERE id = {$id}", 'ARRAY_A');
    $result = $results[0];

    if (!$result)
        return [];

    return $result;
}


/**
 * create faq item
 * 
 * @param string $question
 * @param string $answer
 * 
 * @return bool
 */
function create_faq_item( string $question, string $answer ):bool {
    global $wpdb;

    $result = $wpdb->insert('stm_faq', [
        'question' => $question,
        'answer' => $answer,
        'position' => 999
    ]);

    if ($result)
        return true;

    return false;
}


/**
 * edit faq item
 * 
 * @param int $id
 * @param array $data
 * 
 * @return bool
 */
function edit_faq_item( int $id, array $data ):bool {
    global $wpdb;

    $result = $wpdb->update('stm_faq', $data, ['id' => $id]);

    if ($result)
        return true;

    return false;
}


/**
 * remove faq item
 * 
 * @param int $id
 * 
 * @return bool
 */
function remove_faq_item( int $id ):bool {
    global $wpdb;

    $result = $wpdb->delete('stm_faq', ['id' => $id]);

    if ($result)
        return true;

    return false;
}



/**
 * relative and advanced version of the admin_url function
 * create admin url add new or replace old params to the url
 * 
 * @param array $get_params - default []
 * @param bool $reset_query_string - default false !however this keeps the 'page' get param
 * 
 * @return string
 */
function rel_admin_url( array $get_params = [], bool $reset_query_string = false ):string {
    $php_self = $_SERVER['PHP_SELF'];
    $query_string = ($reset_query_string ? 'page=stm-faq' : $_SERVER['QUERY_STRING']);

    parse_str($query_string, $query_string_array);

    $merged_arrays = array_merge($query_string_array, $get_params);

    $http_query = http_build_query($merged_arrays);

    $final_url = $php_self . '?' . $http_query;

    return $final_url;
}
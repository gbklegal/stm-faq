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
 * create faq item
 * @param string $question
 * @param string $answer
 * @return bool
 */
function createFaqItem( string $question, string $answer ):bool {
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
 * @param int $id
 * @param array $data
 * @return bool
 */
function editFaqItem( int $id, array $data ):bool {
    global $wpdb;

    $result = $wpdb->update('stm_faq', $data, ['id' => $id]);

    if ($result)
        return true;

    return false;
}


/**
 * remove faq item
 * @param int $id
 * @return bool
 */
function removeFaqItem( int $id ):bool {
    global $wpdb;

    $result = $wpdb->delete('stm_faq', ['id' => $id]);

    if ($result)
        return true;

    return false;
}



/**
 * create admin url add new or replace old params to the url
 * @param array $getParams - default []
 * @param bool $resetQueryString - default false !however this keeps the 'page' get param
 * @return string
 */
function adminUrl( array $getParams = [], bool $resetQueryString = false ):string {
    $phpSelf = $_SERVER['PHP_SELF'];
    $queryString = ($resetQueryString ? 'page=stm-faq' : $_SERVER['QUERY_STRING']);

    parse_str($queryString, $queryStringArray);

    $mergedArrays = array_merge($queryStringArray, $getParams);

    $httpQuery = http_build_query($mergedArrays);

    $finalUrl = $phpSelf . '?' . $httpQuery;

    return $finalUrl;
}
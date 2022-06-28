<?php

$faq_items = get_faq_items();
$wp_editor_settings = [
    'media_buttons' => false,
    'drag_drop_upload' => false,
    'textarea_name' => 'faq_answer'
];

$item_id = $_GET['item_id'] ?? false;
$get_action = $_GET['action'] ?? '';

if ($get_action === 'save_items') {
    $success = false;
    $items_position = $_GET['items_position'] ?? '';
    $items_position_array = explode(',', $items_position);

    if (!empty($items_position))
        foreach($items_position_array as $position_index => $item_id) {
            $result = edit_faq_item($item_id, ['position' => $position_index]);
            var_dump($result);
            if ($result)
                $success = true;
        }

    if ($success === true)
        header('Location: ' . rel_admin_url([], true) . '#success_saved_position');
    else
        header('Location: ' . rel_admin_url([], true) . '#failed_saved_position');
}
else if ($get_action === 'remove_item') {
    $result = remove_faq_item($item_id);

    if ($result === true)
        header('Location: ' . rel_admin_url([], true) . '#success_removed_faq_item');
    else
        header('Location: ' . rel_admin_url([], true) . '#failed_removed_faq_item');
    }

?>

<h1>Übersicht</h1>

<hr>

<div id="faqItems" class="items">
    <?php
        foreach ($faq_items as $faq_item):
            $faq_item_id = $faq_item['id'] ?? false;
            $faq_item_question = $faq_item['question'] ?? '';
            $faq_item_answer = $faq_item['answer'] ?? '';
    ?>
    <div class="item" data-item-id="<?php echo $faq_item_id; ?>">
        <div class="grab-handle">::</div>
        <div class="item-inner">
            <div class="question"><?php echo $faq_item_question; ?></div>
            <div class="answer"><?php echo $faq_item_answer; ?></div>
            <pre class="id">ID: <code><?php echo $faq_item_id; ?></code></pre>
        </div>
        <div class="controls">
            <a class="wp-ui-text-notification removeFaqItemBtn" href="<?php echo rel_admin_url(['item_id' => $faq_item_id, 'action' => 'remove_item']) ?>">
                <span class="dashicons dashicons-trash"></span>
            </a>
            <span>-</span>
            <a href="<?php echo rel_admin_url(['item_id' => $faq_item_id, 'view' => 'editor']) ?>">
                <span class="dashicons dashicons-edit"></span>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<a class="button button-primary button-large" href="<?php echo rel_admin_url(['action' => 'save_items']); ?>" id="saveFaqItemsPosition">speichern</a>
<a class="button button-primary button-large" href="<?php echo rel_admin_url(['view' => 'editor']); ?>">+ FAQ Element erstellen</a>


<?php

// echo '<pre>';
// print_r(getFaqItems());
// echo '</pre>';
<?php

$faqItems = getFaqItems();
$wpEditorSettings = [
    'media_buttons' => false,
    'drag_drop_upload' => false,
    'textarea_name' => 'faq_answer'
];

$itemId = $_GET['item_id'] ?? false;
$getAction = $_GET['action'] ?? '';

if ($getAction === 'save_items') {
    $success = false;
    $itemsPosition = $_GET['items_position'] ?? '';
    $itemsPositionArray = explode(',', $itemsPosition);

    if (!empty($itemsPosition))
        foreach($itemsPositionArray as $positionIndex => $itemId) {
            $result = editFaqItem($itemId, ['position' => $positionIndex]);
            var_dump($result);
            if ($result)
                $success = true;
        }

    if ($success === true)
        header('Location: ' . adminUrl([], true) . '#success_saved_position');
    else
        header('Location: ' . adminUrl([], true) . '#failed_saved_position');
}
else if ($getAction === 'remove_item') {
    $result = removeFaqItem($itemId);

    if ($result === true)
        header('Location: ' . adminUrl([], true) . '#success_removed_faq_item');
    else
        header('Location: ' . adminUrl([], true) . '#failed_removed_faq_item');
    }

?>

<h1>Übersicht</h1>

<hr>

<div id="faqItems" class="items">
    <?php
        foreach ($faqItems as $faqItem):
            $faqItemId = $faqItem['id'] ?? false;
            $faqItemQuestion = $faqItem['question'] ?? '';
            $faqItemAnswer = $faqItem['answer'] ?? '';
    ?>
    <div class="item" data-item-id="<?php echo $faqItemId; ?>">
        <div class="grab-handle">::</div>
        <div class="item-inner">
            <div><?php echo $faqItemQuestion; ?></div>
            <div><?php echo $faqItemAnswer; ?></div>
        </div>
        <div class="controls">
            <a class="wp-ui-text-notification removeFaqItemBtn" href="<?php echo adminUrl(['item_id' => $faqItemId, 'action' => 'remove_item']) ?>">
                <span class="dashicons dashicons-trash"></span>
            </a>
            <span>-</span>
            <a href="<?php echo adminUrl(['item_id' => $faqItemId, 'view' => 'editor']) ?>">
                <span class="dashicons dashicons-edit"></span>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<a class="button button-primary button-large" href="<?php echo adminUrl(['action' => 'save_items']); ?>" id="saveFaqItemsPosition">speichern</a>
<a class="button button-primary button-large" href="<?php echo adminUrl(['view' => 'editor']); ?>">FAQ Element erstellen</a>


<?php

// echo '<pre>';
// print_r(getFaqItems());
// echo '</pre>';
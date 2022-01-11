<?php

$faqItems = getFaqItems();
$wpEditorSettings = [
    'media_buttons' => false,
    'drag_drop_upload' => false,
    'textarea_name' => 'faq_answer'
];

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
        <div>
            <a href="<?php echo $requestURI . '&view=editor&item_id=' . $faqItemId ?>">
                <span class="dashicons dashicons-edit"></span>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<button class="button button-primary button-large" id="createFaqItem">FAQ Element erstellen</button>


<?php

// echo '<pre>';
// print_r(getFaqItems());
// echo '</pre>';
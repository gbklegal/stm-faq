<?php

$itemId = $_GET['item_id'] ?? false;
$getAction = $_POST['action'] ?? false;

$faqQuestionValue = '';
$faqAnswerValue = '';

switch ($getAction) {
    case 'create':
        $itemQuestion = $_POST['faq_question'];
        $itemAnswer = $_POST['faq_answer'];
        createFaqItem($itemQuestion, $itemAnswer);
        break;
}

if ($itemId !== false) {
    $faqItem = getFaqItem($itemId);
    $faqQuestionValue = $faqItem['question'];
    $faqAnswerValue = $faqItem['answer'];
}

?>

<form method="post">
    <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
    <hr>
    <label class="stm-faq-label">Frage</label>
    <input name="faq_question" placeholder="Frage hier eingeben" class="stm-faq-input" value="<?php echo $faqAnswerValue; ?>">

    <label class="stm-faq-label">Antwort</label>
    <?php

    $wpEditorSettings = [
        'media_buttons' => false,
        'drag_drop_upload' => false,
        'textarea_name' => 'faq_answer'
    ];

    wp_editor($faqAnswerValue, 'textarea', $wpEditorSettings);

    ?>

    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="<?php echo $submitValue; ?>">
    </p>

    <input type="hidden" name="action" value="create">
</form>
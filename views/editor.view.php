<?php

$title = 'FAQ erstellen';
$itemId = $_GET['item_id'] ?? false;
$getAction = $_POST['action'] ?? false;

$faqQuestionValue = '';
$faqAnswerValue = '';
$submitValue = 'speichern';

switch ($getAction) {
    case 'create':
        $itemQuestion = $_POST['faq_question'];
        $itemAnswer = $_POST['faq_answer'];

        $result = createFaqItem($itemQuestion, $itemAnswer);

        if ($result === true)
            header('Location: ' . adminUrl([], true) . '#success_created_faq_item');
        else
            header('Location: ' . adminUrl([], true) . '#failed_created_faq_item');

        break;

    case 'edit':
        $itemQuestion = $_POST['faq_question'];
        $itemAnswer = $_POST['faq_answer'];

        $result = editFaqItem($itemId, [
            'question' => $itemQuestion,
            'answer' => $itemAnswer
        ]);

        if ($result === true)
            header('Location: ' . adminUrl([], true) . '#success_saved_faq_item');
        else
            header('Location: ' . adminUrl([], true) . '#failed_saved_faq_item');

        break;
}

if ($itemId !== false) {
    $faqItem = getFaqItem($itemId);
    $faqQuestionValue = $faqItem['question'];
    $faqAnswerValue = $faqItem['answer'];
    $title = 'FAQ bearbeiten';
}

?>

<form method="post" id="stm-faq-editor">
    <h1 class="wp-heading-inline"><?php echo $title; ?></h1>
    <hr>
    <a href="<?php echo adminUrl([], true); ?>">Zurück zur Übersicht</a>
    <main>
        <section>
            <label class="stm-faq-label">Frage</label>
            <input name="faq_question" placeholder="Frage hier eingeben" class="stm-faq-input" value="<?php echo $faqQuestionValue; ?>">
        </section>
        <section>
            <label class="stm-faq-label">Antwort</label>
            <?php

            $wpEditorSettings = [
                'media_buttons' => false,
                'drag_drop_upload' => false,
                'textarea_name' => 'faq_answer'
            ];

            wp_editor($faqAnswerValue, 'textarea', $wpEditorSettings);

            ?>
        </section>
    </main>

    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="<?php echo $submitValue; ?>">
    </p>

    <input type="hidden" name="action" value="<?php echo $itemId ? 'edit' : 'create' ?>">
</form>
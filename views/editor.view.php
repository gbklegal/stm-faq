<?php

$title = 'FAQ erstellen';
$item_id = $_GET['item_id'] ?? false;
$get_action = $_POST['action'] ?? false;

$faq_question_value = '';
$faq_answer_value = '';
$submit_value = 'speichern';

switch ($get_action) {
    case 'create':
        $item_question = $_POST['faq_question'];
        $item_answer = $_POST['faq_answer'];

        $result = create_faq_item($item_question, $item_answer);

        if ($result === true)
            header('Location: ' . rel_admin_url([], true) . '#success_created_faq_item');
        else
            header('Location: ' . rel_admin_url([], true) . '#failed_created_faq_item');

        break;

    case 'edit':
        $item_question = $_POST['faq_question'];
        $item_answer = $_POST['faq_answer'];

        $result = edit_faq_item($item_id, [
            'question' => $item_question,
            'answer' => $item_answer
        ]);

        if ($result === true)
            header('Location: ' . rel_admin_url([], true) . '#success_saved_faq_item');
        else
            header('Location: ' . rel_admin_url([], true) . '#failed_saved_faq_item');

        break;
}

if ($item_id !== false) {
    $faq_item = get_faq_item($item_id);
    $faq_question_value = $faq_item['question'];
    $faq_answer_value = $faq_item['answer'];
    $title = 'FAQ bearbeiten';
}

?>

<form method="post" id="stm-faq-editor">
    <h1 class="wp-heading-inline"><?php echo $title; ?></h1>
    <hr>
    <a href="<?php echo rel_admin_url([], true); ?>">Zurück zur Übersicht</a>
    <main>
        <section>
            <label class="stm-faq-label">Frage</label>
            <input name="faq_question" placeholder="Frage hier eingeben" class="stm-faq-input" value="<?php echo $faq_question_value; ?>">
        </section>
        <section>
            <label class="stm-faq-label">Antwort</label>
            <?php

            $wp_editor_settings = [
                'media_buttons' => false,
                'drag_drop_upload' => false,
                'textarea_name' => 'faq_answer'
            ];

            wp_editor($faq_answer_value, 'textarea', $wp_editor_settings);

            ?>
        </section>
    </main>

    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="<?php echo $submit_value; ?>">
    </p>

    <input type="hidden" name="action" value="<?php echo $item_id ? 'edit' : 'create' ?>">
</form>
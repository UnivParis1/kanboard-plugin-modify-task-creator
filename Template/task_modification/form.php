<?php if ($allowed): ?>
    <?= $this->form->label(t('Creator'), 'creator_id') ?>
    <?= $this->form->select('creator_id', $users, $values, $errors) ?>
<?php endif ?>
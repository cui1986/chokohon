<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('图书一览'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="books form large-9 medium-8 columns content">
    <?= $this->Form->create($book) ?>
    <fieldset>
        <legend><?= __('Add book') ?></legend>
        <?php
            echo $this->Form->control('book_isbn');
            echo $this->Form->control('book_asin');
            echo $this->Form->control('book_name');
            echo $this->Form->control('book_comment');
            echo $this->Form->control('del_flg');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<?php
    use Cake\Core\Configure;
?>

<div class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?= Configure::read("{$this->plugin}.sitename") ?></a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <?= $this->cell("{$this->plugin}.Region", ['rootview' => $this]) ?>
        </div>
    </div>
</div>
<?php
    use Cake\Core\Configure;
?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html lang="<?= Configure::read('App.language') ?>">
<head>
    <?= $this->Html->charset() ?>
    <title><?= Configure::read("{$this->plugin}.sitename") ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Content-Type" content="Text/html; charset=utf-8">
    <meta name="robots" content="noindex">
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <?= $this->Html->css("{$this->plugin}./packages/bootstrap/css/bootstrap.min.css") ?>
    <?= $this->Html->css("{$this->plugin}./packages/bootstrap-material-design-master/css/bootstrap-material-design.min.css") ?>
    <?= $this->Html->css("{$this->plugin}./packages/bootstrap-material-design-master/css/ripples.min.css") ?>
    <?= $this->Html->css("{$this->plugin}.style.css") ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <?= $this->element('default/site-header') ?>
    <div class="container-fluid">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    
    <?= $this->Html->script("{$this->plugin}.jquery-2.2.4.min.js") ?>
    <?= $this->Html->script("{$this->plugin}./packages/bootstrap/js/bootstrap.min.js") ?>
    <?= $this->Html->script("{$this->plugin}./packages/bootstrap-material-design-master/js/material.min.js") ?>
    <?= $this->Html->script("{$this->plugin}./packages/bootstrap-material-design-master/js/ripples.min.js") ?>
    <?= $this->Html->script("{$this->plugin}.bootbox.min.js") ?>
    <script type="text/javascript">$.material.init();</script>
    <?= $this->fetch('script') ?>
</body>
</html>

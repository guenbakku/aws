<?php $rootView->start('script') ?>
<?php echo $rootView->fetch('script') ?>
    <script type="text/javascript">
        // Change display text of region button
        $(function(){
            $('.region-btn .region').click(function(evt){
                var region = $(this).text();
                $('.region-btn .currentRegion').text(region);
            })
        })
    </script>
<?php $rootView->end() ?>

<ul class="nav navbar-nav navbar-right">
    <li class="dropdown region-btn">
        <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="currentRegion"><?= __d('instance', $currentRegion) ?></span> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <?php foreach($regions as $region): ?>
            <li class="narrow">
                <?= $this->Html->link(__d('instance', $region),
                    [
                        'controller' => 'Regions',
                        'action' => 'change',
                        $region,
                    ], 
                    [
                        'class' => 'narrow region',
                    ]
                ) ?>
            </li>
            <?php endforeach ?>
        </ul>
    </li>
</ul>
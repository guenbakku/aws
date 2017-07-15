<?php
use Cake\Core\Configure;
use Cake\Utility\Hash;
    
$this->append('css', $this->html->css("$plugin./packages/jquery-bootgrid/css/jquery.bootgrid.min.css"));
$this->append('script', $this->html->script("$plugin./packages/jquery-bootgrid/js/jquery.bootgrid.min.js"));
?>

<?php $this->start('css') ?>
<?php echo $this->fetch('css') ?>
<style>
    #bootgrid td {
        vertical-align: middle;
    }
</style>
<?php $this->end() ?>

<?php $this->start('script') ?>
<?php echo $this->fetch('script') ?>

<script type="text/javascript">
    var grid = $("#bootgrid").bootgrid({
        rowCount: -1, // Turn off navigation
        caseSensitive: false,
        formatters: {
            "commands": function(column, row) {
                return '<a class="btn btn-danger btn-sm btn-raised command-restart"><?= __d('instance', 'restart') ?></a>';
            }
        }
    }).on("loaded.rs.jquery.bootgrid", function() {
        grid.find('.command-restart').click(function(evt) {
            var rowId = $(this).parents('tr').data('rowId');
            var instanceId = grid.bootgrid('getCurrentRows')[rowId]['instance-id'];
            console.log(instanceId);
        });
    }).on("loaded.rs.jquery.bootgrid", function() {
        $('#bootgrid-header').find('.actionBar').append($("#region-btn"));
        
    });
    
    var load = function (region) {
        $.ajax ({
            url: '/sam/ec2instances/api-read',
            type: "GET",
            data: {'region': region},
            beforeSend: function(){
                grid.hide();
                grid.next('p').remove();
                grid.after('<p class="text-center">Loading...</p>');
            }
        }).done(function (data) {
            data = $.parseJSON(data);
            grid.bootgrid('append', data.rows);
            grid.next('p').remove();
            grid.show();
        }).fail(function (data) {
            console.log(data);
            grid.next('p').text('Error');
        });
    };
    
    load('<?= $region ?>');
</script>

<?php $this->end() ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><?= __('EC2 instances list') ?></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <table id="bootgrid" class="table table-border table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="name"><?= __d('instance', 'name') ?></th>
                            <th data-column-id="public-ip-address"><?= __d('instance', 'public ip address') ?></th>
                            <th data-column-id="instance-id" data-searchable="false"><?= __d('instance', 'instance id') ?></th>
                            <th data-column-id="instance-type"><?= __d('instance', 'instance type') ?></th>
                            <th data-column-id="key-name"><?= __d('instance', 'key name') ?></th>
                            <th data-column-id="status"><?= __d('instance', 'status') ?></th>
                            <th data-column-id="restart" data-formatter="commands" data-sortable="false" data-width="120px"><?= __d('instance', 'restart') ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="pull-left" id="region-btn">
    <label class="control-label"><?= __('Region') ?></label>
    <div class="btn-group">
        <div class="btn-group">
            <a data-target="#" class="btn dropdown-toggle" data-toggle="dropdown">
                <span class="current"><?= __d('instance', $region) ?></span> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php foreach(Configure::read('Sam.regions') as $region): ?>
                <li>
                    <?= $this->Html->link(__d('instance', $region), [
                        'controller' => 'ec2instances',
                        'action' => 'index',
                        $region,
                    ]) ?>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>



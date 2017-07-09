<?php
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
    });
</script>

<?php $this->end() ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><?= __('EC2 instances list') ?></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <label ><?= __('Region') ?></label>
                <div class="btn-group">
                    <div class="btn-group">
                        <a data-target="#" class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                            Dropdown <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)">Dropdown link</a></li>
                            <li><a href="javascript:void(0)">Dropdown link</a></li>
                            <li><a href="javascript:void(0)">Dropdown link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table id="bootgrid" class="table table-border table-hover">
                    <thead>
                        <tr>
                            <th data-column-id="name"><?= __d('instance', 'name') ?></th>
                            <th data-column-id="public-ip-address"><?= __d('instance', 'public ip address') ?></th>
                            <th data-column-id="instance-type"><?= __d('instance', 'instance type') ?></th>
                            <th data-column-id="key-name"><?= __d('instance', 'key name') ?></th>
                            <th data-column-id="status"><?= __d('instance', 'status') ?></th>
                            <th data-column-id="restart" data-formatter="commands" data-sortable="false" data-width="120px"><?= __d('instance', 'restart') ?></th>
                            <th data-column-id="instance-id" data-searchable="false" data-visible="false"><?= __d('instance', 'instance id') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($instances as $item): ?>
                        <tr>
                            <td><?= Hash::get($item, 'Tags.Name') ?></td>
                            <td><?= Hash::get($item, 'PublicIpAddress') ?></td>
                            <td><?= Hash::get($item, 'InstanceType') ?></td>
                            <td><?= Hash::get($item, 'KeyName') ?></td>
                            <td><?= Hash::get($item, 'State.Name') ?></td>
                            <td></td>
                            <td><?= Hash::get($item, 'InstanceId') ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



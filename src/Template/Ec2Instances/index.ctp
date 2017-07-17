<?php
use Cake\Utility\Hash;
    
$this->append('css', $this->html->css("{$this->plugin}./packages/jquery-bootgrid/css/jquery.bootgrid.min.css"));
$this->append('script', $this->html->script("{$this->plugin}./packages/jquery-bootgrid/js/jquery.bootgrid.min.js"));
?>

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
        })
    </script>
<?php $this->end() ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title"><?= __('EC2 instances') ?></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="bootgrid" class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th data-column-id="name"><?= __d('instance', 'name') ?></th>
                                <th data-column-id="public-ip-address"><?= __d('instance', 'public ip address') ?></th>
                                <th data-column-id="instance-id"><?= __d('instance', 'instance id') ?></th>
                                <th data-column-id="instance-type"><?= __d('instance', 'instance type') ?></th>
                                <th data-column-id="key-name"><?= __d('instance', 'key name') ?></th>
                                <th data-column-id="status"><?= __d('instance', 'status') ?></th>
                                <th data-column-id="restart" data-formatter="commands" data-sortable="false" data-width="120px"><?= __d('instance', 'restart') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($instances as $instance): ?>
                            <tr>
                                <td><?= Hash::get($instance, 'Tags.Name'); ?></td>
                                <td><?= Hash::get($instance, 'PublicIpAddress'); ?></td>
                                <td><?= Hash::get($instance, 'InstanceId'); ?></td>
                                <td><?= Hash::get($instance, 'InstanceType'); ?></td>
                                <td><?= Hash::get($instance, 'KeyName'); ?></td>
                                <td><?= Hash::get($instance, 'State.Name'); ?></td>
                                <td><br></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
use Cake\Utility\Hash;
use Cake\Routing\Router;

$this->append('css', $this->Html->css("{$this->plugin}./packages/jquery-bootgrid/css/jquery.bootgrid.min.css"));
$this->append('script', $this->Html->script("{$this->plugin}./packages/jquery-bootgrid/js/jquery.bootgrid.min.js"));
?>

<?php $this->start('script') ?>
<?php echo $this->fetch('script') ?>
    <script type="text/javascript">
        var URLS = {
            api_restart: '<?= $this->Url->build(['controller' => 'Ec2Instances', 'action' => 'api-restart']) ?>',
        };
        
        var grid = $("#bootgrid").bootgrid({
            rowCount: -1, // Turn off navigation
            caseSensitive: false,
            formatters: {
                "commands": function(column, row) {
                    var disabledClass = row.status == 'running'? '' : 'disabled';
                    return '<a class="btn btn-danger btn-sm btn-raised command-restart ' 
                           + disabledClass + '"><?= __d('Guenbakku/Sam', 'Restart') ?></a>';
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function() {
            grid.find('.command-restart').click(function(evt) {
                var rowId = $(this).parents('tr').data('rowId');
                var instanceId = grid.bootgrid('getCurrentRows')[rowId]['instance-id'];
                var name = grid.bootgrid('getCurrentRows')[rowId]['name'];
                var message = "Are you sure you want to restart instance: <ul><li>" + instanceId + ' (' + name + ')' + '</li></ul>';
                var title = 'Restart Instance';
                bootbox.confirm({
                    title: title,
                    message: message, 
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                type: "POST",
                                url: URLS.api_restart,
                                data: {instanceId: instanceId},
                                beforeSend: function(jqXHR, settings) {
                                    bootbox.dialog({
                                        title: title,
                                        message: '<i class="fa fa-spin fa-spinner"></i> Loading...' 
                                    });
                                },
                                success: function(data) {
                                    bootbox.hideAll();
                                    bootbox.alert({
                                        title: title,
                                        message: 'Restart command sent successfully',
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    bootbox.alert({
                                        title: title,
                                        message: 'Fail to send restart command',
                                    });
                                },
                            })
                        }
                    }
                });
            });
        })        
    </script>
<?php $this->end() ?>

<div class="panel panel-default">
    <div class="panel-heading test">
        <div class="panel-title"><?= __d('Guenbakku/Sam', 'EC2 instances') ?></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="bootgrid" class="table table-border table-hover">
                        <thead>
                            <tr>
                                <th data-column-id="name"><?= __d("Guenbakku/Sam", 'Name') ?></th>
                                <th data-column-id="public-ip-address"><?= __d('Guenbakku/Sam', 'Public ip address') ?></th>
                                <th data-column-id="instance-id"><?= __d('Guenbakku/Sam', 'Instance id') ?></th>
                                <th data-column-id="instance-type"><?= __d('Guenbakku/Sam', 'Instance type') ?></th>
                                <th data-column-id="key-name"><?= __d('Guenbakku/Sam', 'Key name') ?></th>
                                <th data-column-id="status"><?= __d('Guenbakku/Sam', 'Status') ?></th>
                                <th data-column-id="restart" data-formatter="commands" data-sortable="false" data-width="120px"><?= __d('Guenbakku/Sam', 'Restart') ?></th>
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



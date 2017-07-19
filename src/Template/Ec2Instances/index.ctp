<?php
use Cake\Utility\Hash;
use Cake\Routing\Router;

$this->append('css', $this->Html->css("{$this->plugin}./packages/jquery-bootgrid/css/jquery.bootgrid.min.css"));
$this->append('script', $this->Html->script("{$this->plugin}./packages/jquery-bootgrid/js/jquery.bootgrid.min.js"));
?>

<?php $this->start('script') ?>
<?php echo $this->fetch('script') ?>
    <script type="text/javascript">
        // Transfer data from PHP to Javascript
        var 
        APIS = {
            restart: '<?= $this->Url->build(['controller' => 'Ec2Instances', 'action' => 'api-restart']) ?>',
            start: '<?= $this->Url->build(['controller' => 'Ec2Instances', 'action' => 'api-start']) ?>',
            stop: '<?= $this->Url->build(['controller' => 'Ec2Instances', 'action' => 'api-stop']) ?>',
        },
        LABELS = {
            restart: '<?= __d('Guenbakku/Sam', 'Restart') ?>',
            start: '<?= __d('Guenbakku/Sam', 'Start') ?>',
            stop: '<?= __d('Guenbakku/Sam', 'Stop') ?>',
        }
        
        // Show command button for reach row
        var showButtons = function(statusCode) {
            var codeBtns = {
                16: ['restart', 'stop'],
                80: ['start'],
            };
            var activeBtns = codeBtns[statusCode] || [];
            
            var btns = {
                restart: $('<a>').text(LABELS.restart)
                                 .addClass('btn cmd')
                                 .attr('href', '#')
                                 .attr('data-cmd', 'restart')
                                 .css('text-align', 'left'),
                start: $('<a>').text(LABELS.start)
                               .addClass('btn cmd')
                               .attr('href', '#')
                               .attr('data-cmd', 'start')
                               .css('text-align', 'left'),
                stop: $('<a>').text(LABELS.stop)
                              .addClass('btn cmd')
                              .attr('href', '#')
                              .attr('data-cmd', 'stop')
                              .css('text-align', 'left'),
            };

            var dropdownMenu = (function(){
                var btnGroup = $('<div>').addClass('btn-group');
                var label = $('<a>').addClass('btn btn-sm btn-raised btn-danger dropdown-toggle')
                                    .attr('data-toggle', 'dropdown')
                                    .attr('data-target', '#')
                                    .attr('aria-expanded', 'true')
                                    .append($('<span>').addClass('fa fa-power-off'));
                var ul = $('<ul>').addClass('dropdown-menu');
                $.each(btns, function(btnName, elm){
                    var li = $('<li>');
                    if ($.inArray(btnName, activeBtns) == -1) {
                        elm.addClass('disabled');
                    }
                    ul.append(li.append(elm));
                });
                btnGroup.append(label).append(ul);
                return btnGroup;
            })();
            
            return dropdownMenu.prop('outerHTML');
        }
        
        var grid = $("#bootgrid").bootgrid({
            rowCount: -1, // Turn off navigation
            caseSensitive: false,
            formatters: {
                "commands": function(column, row) {
                    return showButtons(row.statusCode);
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function() {
            $.material.init(grid.find('.btn-group').find('.dropdown-toggle').dropdown());
        }).on("loaded.rs.jquery.bootgrid", function() {
            grid.find('.cmd').click(function(evt) {
                var cmd = ($(this).data('cmd'));
                var rowId = $(this).parents('tr').data('rowId');
                var instanceId = grid.bootgrid('getCurrentRows')[rowId]['instanceId'];
                var name = grid.bootgrid('getCurrentRows')[rowId]['name'];
                var message = "Are you sure to want to <b>" + cmd + "</b> instance: <ul><li>" + instanceId + ' (' + name + ')' + '</li></ul>';
                var title = cmd.capitalize() + ' instance';
                var url = APIS[cmd];
                bootbox.confirm({
                    title: title,
                    message: message, 
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                type: "POST",
                                url: url,
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
                                        message: 'Succeeded to sent command',
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    bootbox.hideAll();
                                    bootbox.alert({
                                        title: title,
                                        message: 'Fail to send command',
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
                                <th data-column-id="name">
                                    <?= __d("Guenbakku/Sam", 'Name') ?>
                                </th>
                                <th data-column-id="publicIpAddress">
                                    <?= __d('Guenbakku/Sam', 'Public IP address') ?>
                                </th>
                                <th data-column-id="publicDnsName">
                                    <?= __d('Guenbakku/Sam', 'Public DNS name') ?>
                                </th>
                                <th data-column-id="privateIpAddress">
                                    <?= __d('Guenbakku/Sam', 'Private IP address') ?>
                                </th>
                                <th data-column-id="instanceId">
                                    <?= __d('Guenbakku/Sam', 'Instance id') ?>
                                </th>
                                <th data-column-id="instanceType">
                                    <?= __d('Guenbakku/Sam', 'Instance type') ?>
                                </th>
                                <th data-column-id="keyName">
                                    <?= __d('Guenbakku/Sam', 'Key name') ?>
                                </th>
                                <th data-column-id="statusName">
                                    <?= __d('Guenbakku/Sam', 'Status') ?>
                                </th>
                                <th data-column-id="statusCode" data-sortable="false" data-visible="false">
                                    <?= __d('Guenbakku/Sam', 'Status code') ?>
                                </th>
                                <th data-column-id="command" data-formatter="commands" data-sortable="false" data-width="120px">
                                    <?= __d('Guenbakku/Sam', 'Command') ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($instances as $instance): ?>
                            <tr>
                                <td><?= Hash::get($instance, 'Tags.Name'); ?></td>
                                <td><?= Hash::get($instance, 'PublicIpAddress'); ?></td>
                                <td><?= Hash::get($instance, 'PublicDnsName'); ?></td>
                                <td><?= Hash::get($instance, 'PrivateIpAddress'); ?></td>
                                <td><?= Hash::get($instance, 'InstanceId'); ?></td>
                                <td><?= Hash::get($instance, 'InstanceType'); ?></td>
                                <td><?= Hash::get($instance, 'KeyName'); ?></td>
                                <td><?= Hash::get($instance, 'State.Name'); ?></td>
                                <td><?= Hash::get($instance, 'State.Code'); ?></td>
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



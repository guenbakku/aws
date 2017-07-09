<?php
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
        formatters: {
            "commands": function(column, row) {
                return '<a class="btn btn-danger btn-sm btn-raised command-restart" data-instance-id="aaa-bbb"><?= __d('instance', 'restart') ?>'+row.id+'</a>';
                // return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> ";
            }
        }
    }).on("loaded.rs.jquery.bootgrid", function() {
        grid.find('.command-restart').click(function(evt) {
            alert($(this).data('instance-id'));
        });
    });
</script>

<?php $this->end() ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= __('Instances list') ?></h3>
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
                            <th data-column-id="id" data-type="numeric" data-width="50px">#</th>
                            <th data-column-id="name"><?= __d('instance', 'name') ?></th>
                            <th data-column-id="instance_type"><?= __d('instance', 'instance type') ?></th>
                            <th data-column-id="ip4_address"><?= __d('instance', 'ip4 address') ?></th>
                            <th data-column-id="status"><?= __d('instance', 'status') ?></th>
                            <th data-column-id="restart" data-formatter="commands" data-sortable="false" data-width="120px"><?= __d('instance', 'restart') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=1; $i<10; $i++): ?>
                        <tr>
                            <td><?=$i?></td>
                            <td>Column content</td>
                            <td>Column content</td>
                            <td>Column content</td>
                            <td>Column content</td>
                            <td></td>
                        </tr>
                        <?php endfor ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



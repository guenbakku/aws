<?=$this->Form->create(null, [
    'setValueSources' => 'data',
    'templates' => [
        'inputContainer' => '{{content}}',
        'label' => false,
    ],
])?>
    <div class="form-group label-floating">
        <label class="control-label">Username</label>
        <?=$this->Form->input('username', [
            'class' => 'form-control',
        ])?>
        <p class="help-block">Nhập tên đăng nhập vào ô trên</p>
    </div>
    <div class="form-group label-floating">
        <label class="control-label">Password</label>
        <?=$this->Form->input('password', [
            'class' => 'form-control',
        ])?>
        <p class="help-block">Nhập mật khẩu đăng nhập vào ô trên</p>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox"> Ghi nhớ đăng nhập
            </label>
        </div>
    </div>
    <?=$this->Form->button(__('Submit'), [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-raised',
    ])?>
<?=$this->Form->end()?>


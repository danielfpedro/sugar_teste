<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });

if (isset($modelObject) && $modelObject->behaviors()->has('Tree')) {
    $fields = $fields->reject(function ($field) {
        return $field === 'lft' || $field === 'rght';
    });
}
%>

<div class="sugar-breadcrumb">
    <h1>Configurações de Conta</h1>
    <?php
        $this->Html->addCrumb('Configurações de Conta');
        echo $this->Html->getCrumbList();
    ?>
</div>

<?= $this->Form->create($<%= $singularVar %>, [
    'horizontal' => true,
    'novalidate' => true,
    'type' => 'file',
    'columns' => [
        'label' => 2,
        'input' => 4,
        'error' => 6
    ]
]) ?>

    <div class="panel panel-default sugar-panel-content sugar-panel-form">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-2 sugar-account-settings-profile-picture-container">
                    <?= $this->Html->image($user->profile_picture_path) ?>
                </div>
            </div>
            <?php
                echo $this->Form->input('profile_picture', ['type' => 'file']);
                echo $this->Form->input('name');
                echo $this->Form->input('username');
            ?>
        </div>
    </div>

    <div class="panel panel-default sugar-panel-content sugar-panel-form">
        <div class="panel-body">
            <?php
                echo $this->Form->input('new_password');
                echo $this->Form->input('confirm_new_password');
            ?>
        </div>
    </div>

    <div class="panel panel-default sugar-panel-content sugar-panel-form">
        <div class="panel-body">
            <?php
                echo $this->Form->input('current_password', [
                    'help' => 'Para a sua segurança você deve confirmar a sua senha atual para alterar qualquer dado da sua conta.'
                ]);
            ?>
        </div>
    </div>

    <div class="panel panel-default sugar-panel-content">
        <div class="panel-body text-right">
            <button type="submit" class="btn btn-primary">
                <span class="fa fa-check"></span> Salvar
            </button>
        </div>
    </div>

<?= $this->Form->end() ?>
<div class="sugar-container-login">
	<div class="sugar-login-overlay"></div>

	<div class="panel panel-login">
		<div class="panel-body">
			<?= $this->Flash->render('auth') ?>
		    <?= $this->Form->create() ?>
		        <?= $this->Form->input('username') ?>
		        <?= $this->Form->input('password') ?>
		        <button type="submit" class="btn btn-primary btn-block">
		        	Entrar
		        </button>
		    <?= $this->Form->end() ?>
	    </div>
    </div>
</div>

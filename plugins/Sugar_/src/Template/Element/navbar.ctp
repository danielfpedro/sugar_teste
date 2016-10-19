<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button
                type="button"
                class="navbar-toggle collapsed"
                data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Google Drive</a>
        </div>              
            <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse sugar-navbar-body" id="bs-example-navbar-collapse-1">
<!--             <ul class="nav navbar-nav">
                <li class="active">
                    <a href="#">Link</a>
                </li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
<!--                 <li>
                    <a href="#">Link</a>
                </li> -->
                <li class="dropdown sugar-navbar-main-control">
                    <a
                        href="#"
                        class="dropdown-toggle"
                        data-toggle="dropdown">
                        <?php // $this->Html->image($loggedinUser['profile_picture_path'], ['class' => 'img-circle sugar-navbar-profile-picture']) ?><?= $this->Sugar->shortName($loggedinUser['first_name']) ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <?= $this->Html->link(
                                $this->Html->faIcon('cog fa-fw') . ' Configurações',
                                [
                                    'controller' => 'Users',
                                    'action' => 'profileSettings'
                                ],
                                ['escape' => false]
                            ) ?>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <?= $this->Html->link(
                                $this->Html->faIcon('sign-out fa-fw') . ' Sair',
                                [
                                    'controller' => 'Users',
                                    'action' => 'logout'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->    
    </div>
    </div><!-- /.container-fluid -->
</nav>
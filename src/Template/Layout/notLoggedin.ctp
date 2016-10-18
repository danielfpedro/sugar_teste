<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <?= $this->Html->css('Sugar./../lib/bootstrap/dist/css/bootstrap.min') ?>

    <!-- Animation library for notifications   -->
    <?= $this->Html->css('Sugar./../lib/animate.css/animate.min') ?>

    <!--  Light Bootstrap Table core CSS    -->
    <?= $this->Html->css('Sugar.style') ?>
    <?= $this->Html->css('Sugar./../lib/optiscroll/dist/optiscroll') ?>
    <?= $this->Html->css('sugar-custom-scroll') ?>
    <?= $this->Html->css('Sugar./../lib/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox') ?>

    <!--     Fonts and icons     -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->

    <?= $this->Html->css('../lib/font-awesome/css/font-awesome.min') ?>
    <!-- <?= $this->Html->css('../lib/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox') ?> -->

    <?= $this->fetch('css') ?>
</head>
<body style="background-image: url(img/background-login.jpg); background-size: cover;">
<div class="sugar-container-login">
	<div class="sugar-login-overlay"></div>

	<div class="panel panel-login">
		<div class="panel-body">
			<?= $this->fetch('content') ?>
	    </div>
    </div>
</div>

</body>

    <!--   Core JS Files   -->
    <?= $this->Html->script('Sugar./../lib/jquery/dist/jquery.min') ?>
    <?= $this->Html->script('Sugar./../lib/bootstrap/dist/js/bootstrap.min') ?>
    <?= $this->Html->script('Sugar./../lib/optiscroll/dist/jquery.optiscroll.min') ?>

	<?= $this->fetch('script') ?>

	<script>
		$(function(){
			$(".sugar-sidebar").optiscroll();
			$('.has-submenu').click(function(){
				var $this = $(this);
				var orientation = $this.orientation;
				var $caret = $('.has-submenu > a > #caret');

				$this.find('ul').slideToggle();

				if ($this.hasClass('submenu-open')) {
					$this
						.removeClass('submenu-open');
					$caret
						.removeClass('fa-caret-up')
						.addClass('fa-caret-down');
				} else {
					$this
						.addClass('submenu-open');
					$caret
						.removeClass('fa-caret-down')
						.addClass('fa-caret-up');
				}

				return false;
			})
			$('.has-submenu > a')
				.append('<span class="fa fa-caret-down" id="caret"></span>');

			// $('.sidebar > li').each(function(){
			// 	var $this = $(this);
			// 	var $a = $this.find('a');
			// 	var icon = $a.data('icon');

			// 	if (icon) {
			// 		$icon = $('<span/>')
			// 			.addClass('fa fa-'+icon)
			// 			.hide();
			// 		$a
			// 			.prepend($icon.fadeIn());
			// 	}
			// });
		});
	</script>

</html>

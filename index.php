<?php
/*if (session_status() == PHP_SESSION_NONE) {
    session_start();
}*/
?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>
			<?php
			require("route.php");
			$config = new namespace\core\config();

			echo $config->APP_NAME;
			?>
        </title>
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style/bootstrap-reboot.min.css">
        <link rel="stylesheet" href="style/bootstrap-grid.min.css">
        <link rel="stylesheet" href="style/bootstrap.min.css">
        <link rel="stylesheet" href="style/style1.css"/>
    </head>
    <body>
	<?php
	$controller = new namespace\core\controller();
	$controller::autoload();
	?>
    </body>
    </html>
<?php

<?php
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$headerHeightOptions = array('Default', 'Small', 'Tiny');
$skinOptions = array('poser Default', 'Flat','MantisMan');

html_page_top();

$queryInfo = $_SERVER["QUERY_STRING"];
if ($queryInfo) parse_str($queryInfo);

if (!isset($tailN)) $tailN = 10;
else if ($tailN > 4096) $tailN = 4096;
?>
<head>
    <link media="all" type="text/css" rel="stylesheet" href="plugins/ISCASRabbitMQ/pages/assets/lib/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1><p class="text-center"><?php echo plugin_lang_get("title") ?></p></h1>
        <div class="col-sm-6 col-sm-offset-3">
            <form class="form-horizontal" role="form" method="post" action="<?php echo plugin_page( 'config_update' ) ?>">
                <?php echo form_security_field( 'plugin_ISCASRabbitMQ_config_update' ) ?>
                <div class="form-group">
                    <label for="prefQUEUENAME" class="col-sm-5 control-label">queue_name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefQueueName" placeholder="mantis" value="<?php echo plugin_config_get('queue_name'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefEXCHANGENAME" class="col-sm-5 control-label">exchange_name</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefExchangeName" placeholder="demo" value="<?php echo plugin_config_get('exchange_name'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefHOST" class="col-sm-5 control-label">host</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefHost" placeholder="124.16.141.142" value="<?php echo plugin_config_get('host'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefPORT" class="col-sm-5 control-label">port</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefPort" placeholder="6007" value="<?php echo plugin_config_get('port'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefUSERNAME" class="col-sm-5 control-label">username</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefUsername" placeholder="iscas" value="<?php echo plugin_config_get('username'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefPASSWORD" class="col-sm-5 control-label">password</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefPassword" placeholder="123456" value="<?php echo plugin_config_get('password'); ?>">
                    </div>
                </div>
				<div class="form-group">
                    <label for="prefVIRTUALHOST" class="col-sm-5 control-label">virtual_host</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="prefVirtualHost" placeholder="abc" value="<?php echo plugin_config_get('virtual_host'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-8">
						<?php if(isset($rabbitInfo)) { ?>
						<p style="color:blue;"><?php echo $rabbitInfo; ?></p>
						<?php } ?>
                        <input id="submit" name="submit" type="submit" value="<?php echo plugin_lang_get("save") ?>" class="btn btn-primary">
						<input id="exec" name="exec" type="submit" value="<?php echo plugin_lang_get("exec") ?>" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
		<div class="col-sm-12" id="RabbitMQLOG">
			<h2><p class="text-center">Mantis RabbitMQ 日志</p></h2>
			<table  class="table text-info" ><thead><tr class="success"><th><p class="text-center text-info">tail <?php  echo ' -n '. $tailN . ' ';?> /var/mantis/mantis.log</p>			
			<form class="form-horizontal" role="form" method="post" action="<?php echo plugin_page( 'config_load&tailN=' . $tailN ) ?>">
			 <?php echo form_security_field( 'plugin_ISCASRabbitMQ_config_load' ) ?>
			<p class="text-right text-info">
			<input class="btn btn-info" id="submit" name="submit" type="submit" value="<?php echo plugin_lang_get("load_more") ?>">
			</p>
			</form>
			</th><tr></thead><tbody>
			<style type="text/css">
			.wordbreak {
				word-wrap: break-word;
				word-break: break-all;
			}
			</style>
			<?php 
			if ($tailN) { 
				$data = array_slice(file('/var/mantis/mantis.log'), 0-$tailN);
				foreach ($data as $line) {
					if (strstr($line, "INFO")) echo "<tr class=\"info wordbreak\"><td>" . $line . "</td></tr>";
					else if (strstr($line, "WARNING")) echo "<tr class=\"warning wordbreak\"><td>" . $line . "</td></tr>";
					else if (strstr($line, "ERROR")) echo "<tr class=\"danger wordbreak\"><td>" . $line . "</td></tr>";
					else echo "<tr class=\"success wordbreak\"><td>" . $line . "</td></tr>";
				}
			} ?>
			</tbody></table>
		</div>
		
    </div>

</body>

<?php

    html_page_bottom();

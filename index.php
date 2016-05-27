<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" /><title>Vie</title>
    <link media="all" type="text/css" rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.min.css">
</head>

<body>
	<br><br><br>
	<div class="container">      
		<div class="col-sm-12 col-sm-offset-3">
			<form class="form-horizontal" role="form" method="post" action="string.php">
			<div class="form-group">
				<label for="string" class="col-sm-12 control-label">String json_decode</label>
				<div class="col-sm-12">
					<input type="text" class="form-control" name="string" placeholder="string" value="">
				</div>
			</div>
						
			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-8">
					<?php if(isset($info)) { ?>
					<p style="color:blue;"><?php echo $info; ?></p>
					<?php } ?>
					<input id="submit" name="submit" type="submit" value="submit" class="btn btn-primary">
				</div>
			</div>
			</form>
		</div>
	</div>
</body>

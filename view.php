<?php

$success = false;

if(isset($_GET["id"])) {
	$id = $_GET["id"];
} elseif(isset($_POST["id"])) {
	$id = $_POST["id"];
}

if(isset($id)) {
	$data = json_decode(file_get_contents("http://crushedpixel.eu/analytics/get_stats.php?id=".$id), true);
	if(array_key_exists("error", $data)) {
		$success = false;
	} else {
		$success = true;
	}
}

if(!$success) {
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="MCMapAnalytics - Analytics for your Minecraft Map">
		<title> MCMapAnalytics </title>
		<!--<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="">-->
		<link rel="stylesheet" href="/analytics/static/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
	</head>
	<style>
	p
	{
		font-size: 20px;
	}
	code /*If you want code*/
	{
		font-size: 130%;
	}
	code#inline
	{
		font-size: 100%;
	}
	.navbar
	{
		border: 0px !important;
		border-radius: 0px !important;

	}
	</style>
<body>
	
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<div class="navbar-header">
			<a href="/analytics/" class="navbar-brand">MCMapAnalytics</a>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
			<li>
				<a href="../help/">Remove me if not wanted.</a>
			</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
			<li><a href="http://crushedpixel.eu" target="_blank">CrushedPixel</a></li>
			<li><a href="http://thedestruc7i0n.ca" target="_blank">TheDestruc7i0n</a></li>
			</ul>

		</div>
		</div>
	</div>

	<div class="container bcon">
		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<div class="page-header">
					<div class="jumbotron">
						<h1>MCMapAnalytics</h1>
						<p>Results.</p>
						<form method="post" action="/analytics/view.php" id="resolver">
						<div class="form-group">
							<label class="control-label">Copy Command</label>
							<div class="input-group col-xs-6">
							<?php
								echo '<input class="form-control" id="focusedInput" type="text" value="'.$data["command"].'" readonly="readonly" style="width:600px;">';
							?>
							</div>
							<br />
							<label class="control-label">Copy This URL</label>
							<div class="input-group col-xs-6">
							<input class="form-control url-link" id="focusedInput" type="text" readonly="readonly" style="width:600px;">
							</div>
						</div>
					 </form>
				</div>
				</div>
		</div>
	<div class="row">
	<table class="table table-striped table-hover ">
		<thead>
			<tr>
				<th>#</th>
				<th>Column heading</th>
				<th>Column heading</th>
				<th>Column heading</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr class="info">
				<td>3</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr class="success">
				<td>4</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr class="danger">
				<td>5</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr class="warning">
				<td>6</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
			<tr class="active">
				<td>7</td>
				<td>Column content</td>
				<td>Column content</td>
				<td>Column content</td>
			</tr>
		</tbody>
	</table>
	</div>	
		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="intro"></a>
				<h2> Introduction </h2>
				<p> Blah </p>

				<p> More stuff if you want.</p>
			</div>
		</div>
		<div class="row" id="main-row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="regular"></a>
				<h2> Sub 1 </h2>

				<p> Words </p>
				
			</div>
		</div>
		<div class="row" id="main-row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="regular"></a>
				<h2> Sub 2 </h2>

				<p> Words</p>
				
			</div>
		</div>
		<div class="row" id="main-row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="regular"></a>
				<h2> Sub 3 </h2>

				<p> Words</p>
			</div>
		</div>
		<div class="row" id="main-row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="regular"></a>
				<h2> Sub 4 </h2>

				<p> Words</p>
				
			</div>
		</div>
	</div>
</div>
	<hr />		 
	<ul class="breadcrumb">
		<center><li class="active">&copy; <a href="http://crushedpixel.eu" target="_blank">CrushedPixel</a> &amp; <a href="http://thedestruc7i0n.ca" target="_blank">TheDestruc7i0n</a></li></center>
	</ul>
	</body>
</html>
<script src="/analytics/static/jquery-1.11.1.min.js"></script>
<script type="text/javascript">$(document).ready(function(){var n=$(".url-link");n.val(window.location.href)});</script>
<script src="/analytics/static/bootstrap.min.js"></script> <!--Just in case-->
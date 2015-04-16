<?php
REQUIRE_ONCE "database_connection.php";
REQUIRE_ONCE "get_stats.php";

function curPageURL() {
	$pageURL = 'http://';
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

$success = false;

if(isset($_GET["id"])) {
	$id = $_GET["id"];
} elseif(isset($_POST["id"])) {
	$id = $_POST["id"];
}

if(isset($id)) {
	$data = get_stats($id);
	if(array_key_exists("error", $data)) {
		$success = false;
	} else {
		$success = true;
	}
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
					<a href="https://github.com/CrushedPixel/MCMapAnalytics">Source Code on GitHub</a>
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
					<?php
					if($success) {
						echo '<p>Statistics Overview</p>';
					} else {
						echo '<p><font color="#8A0808">This Project does not exist.</font></p>';
					}
					?>
					<form method="post" action="/analytics/view.php" id="resolver">
						<?php
						if($success) {
							echo '<div class="form-group">';
							echo '<label class="control-label">Copy Command</label>
										  <div class="input-group col-xs-6">';
							echo '<input class="form-control copyme" id="focusedInput" type="text" value="' . $data["command"] . '" readonly="readonly" style="width:600px;">';
							echo '<span class="input-group-btn">';
							echo '<button class="btn btn-default copyable" type="button" data-clipboard-text="' . $data["command"] . '">Copy</button>';
							echo '</span>';
							echo '</div>';

							echo '<br/>
								<label class="control-label">Copy This URL</label>
								<div class="input-group col-xs-6">
								<input class="form-control copyme" id="focusedInput" type="text" value="'. curPageURL() .'" readonly="readonly" style="width:600px;">';
							echo '<span class="input-group-btn">';
							echo '<button class="btn btn-default copyable" type="button" data-clipboard-text="' . curPageURL() . '">Copy</button>';
							echo '</span>';
							echo '</div>';
						}
						?>

				</div>
				</form>
			</div>
		</div>
	</div>
	<?php
	if($success) {
		if($data["total"] > 0) {

			echo '<div class="row">
				<div class="col-lg-8 col-sm-offset-2">
				<a id="count"></a>
				<p>Total Players: '. $data["total"] . '</p>
				</div>
				</div>';


			echo '<div class="row">
			  <table class="table table-striped table-hover">
			  <thead>
			  	<tr>
					<th>#</th>
					<th>Country</th>
					<th>Player Count</th>
					<th>Relative Amount</th>
			    </tr>
			  </thead>
			  <tbody>';

			$i = 1;
			foreach ($data["countries"] as $pair) {
				echo '<tr>
 				  <td>' . $i . '</td>
				  <td><img id="flag" width="30px" height="20px" src="http://www.geonames.org/flags/x/'. strtolower($pair["country"]) . '.gif"/> ' . $pair["country"] . '</td>
			      <td>' . $pair["count"] . '</td>
			      <td>' . $pair["percentage"] . '%</td>
			      </tr>';
				$i++;
			}

			echo '</tbody>
			  </table>';
		} else {
			echo '<div class="row">
				<div class="col-lg-8 col-sm-offset-2">
				<a id="count"></a>
				<p><font color="#8A0808">No Statistics tracked for this Project.</font></p>
				</div>
				</div>';
		}
		//TODO: Add statistics
	}
	?>
</div>
</div>
<hr/>

<ul class="breadcrumb">
	<center><li class="active">&copy; <a href="http://crushedpixel.eu" target="_blank">CrushedPixel</a> &amp; <a href="http://thedestruc7i0n.ca" target="_blank">TheDestruc7i0n</a></li></center>
</ul>
</body>
</html>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
<script src="/analytics/static/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	var client = new ZeroClipboard( $(".copyable") );
</script>
<script src="/analytics/static/bootstrap.min.js"></script> <!--Just in case-->
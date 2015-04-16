<?php
REQUIRE_ONCE "database_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="description" content="MCMapAnalytics - Analytics for your Minecraft Map">
	<title>MCMapAnalytics - General Statistics</title>
	<!--<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="">-->
	<link rel="stylesheet" href="/analytics/static/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="/analytics/favicon.ico" />
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
					<a href="https://github.com/CrushedPixel/MCMapAnalytics" target="_blank">Source Code on GitHub</a>
				</li>
			</ul>

			<ul class="nav navbar-nav">
				<li>
					<a href="/analytics/stats">View General Statistics</a>
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
					<p>General Statistics</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-sm-offset-2">
			<?php
			global $con;

			$sql = 'SELECT COUNT(*) as count FROM projects';
			$stmt = $con->prepare($sql);
			$stmt->execute();

			$projects = 0;
			while($row = $stmt->fetch()) {
				$projects = $row["count"];
				break;
			}

			$sql = 'SELECT COUNT(*) as count FROM tracked';
			$stmt = $con->prepare($sql);
			$stmt->execute();

			$tracked = 0;
			while($row = $stmt->fetch()) {
				$tracked = $row["count"];
				break;
			}

			$average = round($tracked/$projects, 2);

			echo '<h2>Total Projects: <b>'. $projects .'</b></h2>';
			echo '<h2>Total Players tracked: <b>'. $tracked .'</b></h2>';
			echo '<h2>Average Players per Project: <b>'. $average .'</b></h2>';

			echo '<br>';

			$sql = "SELECT country,COUNT(*) as count FROM tracked GROUP BY country ORDER BY count DESC, country ASC";
			$stmt = $con->prepare($sql);
			$stmt->execute();

			//The Country table
			echo '<div class="row">
			  <table class="table table-striped table-hover">
			  <thead>
			  	<tr>
					<th width="10%">#</th>
					<th width="30%">Country</th>
					<th width="30%">Player Count</th>
					<th width="30%">Relative Amount</th>
			    </tr>
			  </thead>
			  <tbody>';

			$i = 1;
			while($row = $stmt->fetch()) {
				echo '<tr>
 				  <td>' . $i . '</td>
				  <td><img id="flag" width="30px" height="20px" src="http://www.geonames.org/flags/x/'. strtolower($row["country"]) . '.gif"/> ' . $row["country"] . '</td>
			      <td>' . $row["count"] . '</td>
			      <td>' . (int)(100*($row["count"]/$tracked)) . '%</td>
			      </tr>';
				$i++;
				if($i > 15) {
					break;
				}
			}

			echo '</tbody>
			  </table>';

			$sql = "SELECT java,COUNT(*) as count FROM tracked GROUP BY java ORDER BY count DESC";
			$stmt = $con->prepare($sql);
			$stmt->execute();

			//The Java Version table
			echo '<table class="table table-striped table-hover">
			  <thead>
			  	<tr>
					<th width="10%">#</th>
					<th width="30%">Java Version</th>
					<th width="30%">Player Count</th>
					<th width="30%">Relative Amount</th>
			    </tr>
			  </thead>
			  <tbody>';

			$i = 1;
			while($row = $stmt->fetch()) {
				echo '<tr>
 				  <td>' . $i . '</td>
				  <td>' . $row["java"] . '</td>
			      <td>' . $row["count"] . '</td>
			      <td>' . (int)(100*($row["count"]/$tracked)) . '%</td>
			      </tr>';
				$i++;
				if($i > 15) {
					break;
				}
			}

			echo '</tbody>
			  </table>';


			$sql = "SELECT org,COUNT(*) as count FROM tracked GROUP BY org ORDER BY count DESC";
			$stmt = $con->prepare($sql);
			$stmt->execute();

			//The Providers Table
			echo '<table class="table table-striped table-hover">
			  <thead>
			  	<tr>
					<th width="10%">#</th>
					<th width="30%">Provider</th>
					<th width="30%">Player Count</th>
					<th width="30%">Relative Amount</th>
			    </tr>
			  </thead>
			  <tbody>';

			$i = 1;
			while($row = $stmt->fetch()) {
				echo '<tr>
 				  <td>' . $i . '</td>
				  <td>' . $row["org"] . '</td>
			      <td>' . $row["count"] . '</td>
			      <td>' . (int)(100*($row["count"]/$tracked)) . '%</td>
			      </tr>';
				$i++;
				if($i > 15) {
					break;
				}
			}

			echo '</tbody>
			  </table>';
			?>
		</div>
	</div>
</div>
<hr/>

<ul class="breadcrumb">
	<center><li class="active">&copy; 2015 <a href="http://crushedpixel.eu" target="_blank">CrushedPixel</a> &amp; <a href="http://thedestruc7i0n.ca" target="_blank">TheDestruc7i0n</a></li></center>
</ul>
</body>
</html>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/zeroclipboard/2.2.0/ZeroClipboard.min.js"></script>
<script src="/analytics/static/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	var client = new ZeroClipboard( $(".copyable") );
</script>
<script src="/analytics/static/bootstrap.min.js"></script> <!--Just in case-->
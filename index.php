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
			<a href="../analytics/" class="navbar-brand">MCMapAnalytics</a>
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
					<p>A tool that will give you analytics for your Minecraft Map.</p>
					<form method="post" action="/analytics/add_skull.php" id="resolver">
						<div class="form-group">
							<label class="control-label">Enter Username for Skin</label>
							<div class="input-group col-xs-6">
								<input type="text" name="player" class="form-control" id="resolve-input" placeholder="Steve" style="width:500px;">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">Resolve and Get Link</button>
							</span>
							</div>
						</div>
					</form>
					<?php
					if(isset($_GET["empty"])) {
						$empty = $_GET["empty"];
						if($empty == true) {
							echo '<p><font color="#8A0808">Username must not be empty! For the default skin, use "char".</font></p>';
						}
					}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="intro"></a>
				<h2>Introduction</h2>
				<p>MCMapAnalytics is a tool for Mapmakers that allows them to collect statistics about the Minecraft Players using their maps.</p>
				<p>It's easy to use - simply place a Player Head in your creation, and every individual player loading this Head gets tracked in your statistics.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="intro"></a>
				<h2>Transparency</h2>
				<p>All of the statistics are publicly accessible on this website, so everyone can see what we're tracking.</p>
				<p>Additionally, the source code to MCMapAnalytics is <a href="https://github.com/CrushedPixel/MCMapAnalytics">published on GitHub</a>,
					proving this website trustworthy and secure.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<a id="intro"></a>
				<h2>How it works</h2>
				<p>The Custom Player Head in your map or contraption that loads it's skin file from the MCMapAnalytics servers.
					Once a Minecraft client downloads the skin, the player's Java Version, Country and Provider are stored <b>anonymously</b>.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-8 col-sm-offset-2">
				<h2>Support the developers</h2>
				<p>The code behind MCMapAnalytics was created by CrushedPixel, the design was made by TheDestruc7i0n.</p>
				<p>CrushedPixel is currently raising funds for an awesome Minecraft Mod on Kickstarter,
						please back the project to support him!</p>
				<center><iframe width="100%" height="455px" src="https://www.kickstarter.com/projects/crushedpixel/minecraft-replay-mod/widget/video.html"
								frameborder="2" scrolling="no"></iframe></center>

				<br>
				<p>Alternatively, you can donate to us via PayPal:</p>
				<p><a href="http://bit.ly/DonorCP">CrushedPixel on PayPal</a></p>
				<p><a href="http://bit.ly/DonorTheDestruc7i0n">TheDestruc7i0n on PayPal</a></p>
			</div>
		</div>

	</div>
</div>
<hr />
<ul class="breadcrumb">
	<center><li class="active">&copy; 2015 <a href="http://crushedpixel.eu" target="_blank">CrushedPixel</a> &amp; <a href="http://thedestruc7i0n.ca" target="_blank">TheDestruc7i0n</a></li></center>
</ul>
</body>
</html>

<script src="./static/bootstrap.min.js"></script> <!--Just in case-->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php" target="_self">Home</a>
		</div>

		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="/index.php">Main</a></li>
				<li><a href="../petstore/index.php">Stores</a></li>
				<li><a href="../customer/index.php">Customers</a></li>
				<li><a href="../pet/index.php">Pets</a></li>
				<li><a href="../../index.php">Test</a></li>
			</ul>
		</div> <!--/.nav-collapse -->

	</div>
</nav>


<?php
date_default_timezone_set('Africa/Lagos');
$today = date('m/d/y g:ia');
echo $today;
?>
<!DOCTYPE html>
<html>

<head><title></title></head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<style type="text/css">

	.nav-link{
		text-decoration: none;
		font-color: #ffffff;
		font-weight: bold;
	}

	a:hover{
		text-decoration: none;
	}

	/*li{
		width: 60px;
	}

	.search{
		width:80px;
	}*/

	.search{
		text-decoration: none;
		border-collapse: collapse;
		border: hidden;
		border-radius: 5px;
		background-color: #000000;
		color: #ffffff;
		font-weight: bold;
	}

</style>
<body>

	<!--<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid" style="width:100%;">
			<div class="navbar-header">
				<a style="position:relative;" href="/Project1_July2015/home_page.php">Home</a>
			</div>
			<div>
				<ul class="nav navbar-nav">
					<li><form class="search-wrapper" role="search" name="search_form"  onsubmit="document.getElementById('submit_button').disabled = 1;">
				<input name="search_term" type="text" placeholder="Search" style="color:#000000;"></input>
				<button name="search" type="submit" value="Submit" formmethod="GET" formtarget="_self" formaction="search_results.php"><span class="glyphicon glyphicon-search"></span></button>
				</form></li>
					<li><a href="/Project1_July2015/wall.php"><?php //echo "<br>" . $_SESSION["name"];?>'s Wall</a></li>
					<li style="float:right;"><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>-->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid" style="width:100%;position:fixed;">
	    <div class="navbar-nav">
	      	<div>
	      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_main" aria-expanded="false" style="float:right;top:-10px;">
        		<span class="sr-only">Toggle navigation</span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
      		</button>
      		<a style="position:absolute;left:15px;margin-top:10px;width=20px" href="/Project1_July2015/home_page.php">Home</a>
    		</div>
    	<div class="collapse navbar-collapse" id="#navbar_main">
    		<ul class="navbar-nav" style="margin-top:-20px;">

			<li><div style="position:absolute;left:420px;float:left;margin-top:10px;width=80px;">
				<form class="search-wrapper inline" name="search_form"  onsubmit="document.getElementById('submit_button').disabled = 1;">
				<input name="search_term" type="text" placeholder="Search" style="border-radius:6px;"></input>
				<button name="search" type="submit" value="Submit" formmethod="GET" formtarget="_self" formaction="search_results.php" style="border-radius:6px;"><span class="glyphicon glyphicon-search"></span></button>
				</form>
			</div></li>

			<li><div style="position:absolute;margin-top:-10px;left:80px;">
				<a href="/Project1_July2015/wall.php"><?php echo "<br>" . $_SESSION["name"];?>'s Wall</a>
			</div></li>
		
			<li><div style="position:absolute;margin-top:10px;right:20px;">
				<a href="logout.php">Logout</a>
			</div></li>
			</ul>
		</div>
		</div>
	</div>
</nav>




</body>
</html>
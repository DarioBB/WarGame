<?php 
require_once 'lib/config.php';
ini_set('display_errors', 0);

$played_game['stats'] = null;
$played_game['info'] = null;
if( isset($_GET['army1']) && is_numeric($_GET['army1']) && isset($_GET['army2']) && is_numeric($_GET['army2']) )
{
	require_once 'lib/includes.php';
	
	$game = new WarGame((int)$_GET['army1'], (int)$_GET['army2']);

	$played_game = $game->play_game(true, true); // params: show_stats, show_prize
}
else 
{
	$played_game['info'] = 'Please enter player parameters (example: ?army1=5&army2=5) ';
}
?>
<html>
<head>
<title>War game</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="author" content="Dario Benšić" />
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

	<div class="container">
		
		<?php echo $played_game['stats'].$played_game['info'];?>
		
	</div>

</body>

</html>
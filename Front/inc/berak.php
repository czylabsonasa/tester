<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title> <?php echo $Nevem ; ?> </title>
		<?php include( "css.php" ) ; ?>
	</head>
	<body>
		<div> 
			<h1><?php echo $Nevem ; ?> </h1> 
			<?php 
				foreach( $Berakni as $i => $ezt )
					include( $ezt ) ;
			?>
			<?php include( "lab.php" ) ; ?>
		</div>
	</body>
</html>

<?php
require('Pagination.php');
$mysqli = mysqli_connect('localhost', 'root', '', 'test');
$result = $mysqli->query("SELECT id, title FROM tovar")->fetch_all(MYSQLI_ASSOC);
$Pagination = new Pagination(3, 4, $result);
?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<title>Test</title>
</head>

<body>
	<?php
	foreach($Pagination->inhalt as $value){
		echo "<a href=\"/link?id=".$value['id']."\">".$value['title']."</a></br>";
	}
	?>
	<nav aria-label="Page navigation example">
	  <ul class="pagination">
		<?php $Pagination->pagipunct(); ?>
	  </ul>
	</nav>
</body>
</html>
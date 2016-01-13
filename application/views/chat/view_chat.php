<!doctype html>
<html>
<head>
<title>chat</title>
</head>
<body>
	<h3>Data Chat</h3>
	<table class="table table-bordered table-hover">
		<tr>
			<td>no</td>
			<td>nama user</td>
			<td>Chat</td>
			<td>Waktu Chat</td>
		</tr>
		<?php 
		$no =1;
			foreach($chat->result() as $c)
			{
				echo "<tr>
						<td>$no</td>
						<td>$c->user</td>
						<td>$c->pesan</td>
						<td>$c->waktu</td>
				";

			$no++;
			}

		?>
	</table>
</body>
</html>

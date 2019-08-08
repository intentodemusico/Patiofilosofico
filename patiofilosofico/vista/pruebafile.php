<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('form').submit( function () {
			var formdata = $(this).serialize();
			$.ajax({
			    type: "POST",
			    url: "../controlador/upload.php",
			    data: formdata
			 });
			return false;
		});
	});
</script>
</head>
<body>
<form>
<input name="my_file" type="file">
<input type="submit" name="submit" value="upload" />
</form>
</body>
</html>
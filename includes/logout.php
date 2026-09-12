<!DOCTYPE html>
<html>
<head>
<?php  
	session_start(); 
	if (isset($_GET['al'])) {
		$url = "../src/index.php?al=".$_GET['al'];
	} else {
		$url = "../src/index.php";
	}
?>
<meta http-equiv="refresh" content="0;url=<?php echo $url; ?>">
<title>Policy Development and Management System</title>
<script language="javascript">
    window.location.href = "<?php echo $url; ?>"
</script>
</head>
<body>
	<?php session_destroy(); ?>
	Go to <a href="<?php echo $url; ?>">/src/index.php</a>
</body>
</html>
<?php
	include "db.php";
	// deleting all $_SESSION variables
	session_destroy();
?>
<meta charset="utf-8">
<script>alert("Logged out"); location.href="/"; </script>
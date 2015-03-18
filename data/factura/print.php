<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
<script type="text/javascript" src="js/jspdf.min.js"></script>
<script type="text/javascript">
	var doc = new jsPDF();
	doc.text(20, 20, 'This is the default font.');

	doc.setFont("courier");
	doc.setFontType("normal");
	doc.text(20, 30, 'This is courier normal.');

	doc.setFont("times");
	doc.setFontType("italic");
	doc.text(20, 40, 'This is times italic.');

	doc.setFont("helvetica");
	doc.setFontType("bold");
	doc.text(20, 50, 'This is helvetica bold.');

	doc.setFont("courier");
</script>
</body>
</html>
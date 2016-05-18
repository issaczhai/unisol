<html>
	<head>
		<title>PHP Mail Sender</title>
		<style media="screen" type="text/css">
			body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,cite,code,dfn,th,var{font-style:normal;font-weight:normal;}ol,ul{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}q:before,abbr,acronym{border:0;}
			section, article, header, footer, nav, aside, hgroup{display:block;zoom:1;}
			body {background: #3b5998;width: 100%;height: 0px;}
			.container {width: 100%;margin: 20px auto;}
			.container .table {position: relative;width: 100%;min-height: 400px;margin: 0 auto;}
			.container .table textarea, .container .table input {position:relative;display:inline-block;width:854px;color:#666;font-size:15px!important;font-style:italic;text-shadow:1px 1px 0 #FFF;text-decoration:none;border:1px solid #d7dada;border-radius:3px;-webkit-border-radius:3px;-moz-border-radius:3px;background-color:#F4F4F4;box-shadow:0 1px #FFF inset, 0 -1px #DDD inset;-moz-box-shadow:0 1px #fff inset, 0 -1px #ddd inset;-webkit-box-shadow:0 1px #FFF inset, 0 -1px #DDD inset;box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;resize:none;outline:none;padding:8px 10px;margin: 0 0 15px 0;}
			.container .table textarea {height: 300px;}
			.container .table textarea.content {height: 70px;}
			.container .table .output {position: relative;width: 821px;color:#FFF;font-size: 21px!important;}
			.container .table input[type=submit]:active {margin-top: 2px;}
			.container .table img.separator {display:block; margin-bottom: 15px;}
			input[type="radio"] {width: 15px !important;}
			body {color: white;}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="logo"></div>
			<div class="table" align="center">
				<form enctype="multipart/form-data" method="POST" action="sendmail.php">	
					<input type="text" name="sender-name" value="" placeholder="Sender name  -- eg: Adi Minune" />
					<input type="text" name="sender-email" value="" placeholder="Sender email -- eg: adiminune@webhost.com" />
					<input type="text" name="replyto" value="" placeholder="Reply-to email -- eg: adiminune@webhost.com" />
					<input type="text" name="subject" value="" placeholder="Subject -- eg: Mail" />
					<textarea class="emails" name="emails" placeholder="Mails">test@yahoo.com</textarea><br>
					<input type="radio" name="htmlortext" value="html" checked>HTML Message &nbsp;&nbsp;&nbsp;&nbsp;or &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="htmlortext" value="text">Text Message<br>
					<textarea class="emails" name="text" placeholder="Message"></textarea>
					<input type="file" name="file" value=""/>
					<input type="submit" value="Send mails">
				</form>
			</div>
		</div>
	</body>
</html>
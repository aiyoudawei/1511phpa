<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<form action="adddo" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table>
				<input type="hidden" name="user_id" value="2">
				<tr>
					<td>标题</td>
					<td><input type="text" name="biaoti"></td>
				</tr>
				<tr>
					<td>内容：</td>
					<td><textarea name="neirong"></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" value="提交"></td>
					<td></td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>
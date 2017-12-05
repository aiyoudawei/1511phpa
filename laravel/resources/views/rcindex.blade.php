<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<form action="rcdl" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<caption><h2>日程登录</h2></caption>
			<table>
				<tr>
					<td>用户名：</td>
					<td><input type="text" name="username"></td>
				</tr>
				<tr>
					<td>密码：</td>
					<td><input type="password" name="userpwd"></td>
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
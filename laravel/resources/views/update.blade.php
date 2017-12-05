<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<form action="update_do" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" value="<?php echo $data->id?>">
			<input type="hidden" name="user_id" value="2">
			<table>
				<tr>
					<td>标题</td>
					<td><input type="text" name="biaoti" value="<?php echo $data->biaoti?>"></td>
				</tr>
				<tr>
					<td>内容：</td>
					<td><textarea name="neirong"><?php echo $data->neirong?></textarea></td>
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
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<caption><h2>展示页面</h2></caption>
		<table>
			<tr>
				<td>ID</td>
				<td>用户名</td>
				<td>标题</td>
				<td>内容</td>
				<td>操作</td>
			</tr>
			<?php foreach ($data as $key => $val): ?>  
       		<tr>  
            	<td><?php echo $val->id; ?></td> 
            	<td><?php echo $val->username; ?></td>
            	<td><?php echo $val->biaoti; ?></td>
            	<td><?php echo $val->neirong; ?></td>
            	<td>
            		<a href="del?id=<?php echo $val->id; ?>">删除</a>
            		<a href="update?id=<?php echo $val->id; ?>">修改</a>
            	</td>
        </tr>    
        <?php endforeach ?>  
		</table>
		<a href="add">添加留言</a>
	</center>
</body>
</html>
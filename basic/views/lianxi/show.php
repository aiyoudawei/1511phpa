<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html>
<head>
	<title>展示</title>
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
			<?php foreach($data as $k=>$v){?>
			<tr>
		 		<td><?php echo $v['id']?></td>
		 		<td><?php echo $v['username']?></td>
				<td><?php echo $v['biaoti']?></td>
				<td><?php echo $v['neirong']?></td>
				<td>
					<a href="<?php echo Url::toRoute(['lianxi/del','id'=>$v['id']])?>">删除</a>
					<a href="<?php echo Url::toRoute(['lianxi/update','id'=>$v['id']])?>">修改</a>
				</td>
			</tr>
			<?php }?>
		</table>
		<a href="<?php echo Url::toRoute(['lianxi/add','id'=>$v['id']])?>">添加留言</a>
	</center>
</body>
</html>
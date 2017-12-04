<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <center>
        <form action="index.php?r=lianxi/update_do" method="post">
        <caption><h2>修改留言</h2></caption>
        <table>
        	<input type="hidden" name="id" value="<?php echo $data['id']?>">
        	<input type="hidden" name="user_id" value="<?php echo $data['user_id']?>">
            <tr>
                <td>标题：</td>
                <td><input type="text" name="biaoti" value="<?php echo $data['biaoti']?>"></td>
            </tr>
            <tr>
                <td>内容：</td>
                <td><textarea name="neirong"><?php echo $data['neirong']?></textarea></td>
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
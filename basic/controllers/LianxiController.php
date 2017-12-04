<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Liuyan;
use app\models\User;
use DfaFilter\SensitiveHelper;
class LianxiController extends Controller
{
    public $layout = false;
   	public $enableCsrfValidation = false;
   	public function actionAdd()
   	{
   		return $this->render('add');
   	}
   	public function actionSelone()
   	{
   		$data = Yii::$app->request->post();
   		$model = new User();
   		$res=$model->find()->where(['username'=>$data['username'],'userpwd'=>$data['userpwd']])->asArray()->One();
   		//print_r($res);die;
    //     return $this->render('show',['data'=>$query]);
    	// $sql="SELECT * FROM user WHERE username = :username and userpwd = :userpwd";
   		// $res = Yii::$app->db->createCommand($sql,[':username' => $data['username'],':userpwd'=>$data['userpwd']])->queryOne();
   		if($res)
		{
			$cookie = new \yii\web\Cookie();
			$cookie -> name = 'user_id';        //cookie的名称
			$cookie -> expire = time() + 3600;	   //存活的时间
			$cookie -> httpOnly = true;		   //无法通过js读取cookie
			$cookie -> value = $res['id'];	   //cookie的值
			\Yii::$app->response->getCookies()->add($cookie);
           	echo "<script>alert('登录成功');location.href='index.php?r=lianxi/show'</script>";
        }else{
           echo "<script>alert('登录失败');location.href='index.php?r=site/index'</script>";
        }
   	}
    public function actionNewadd_do()
    {
		//返回一个\yii\web\Cookie对象
		$cookie = \Yii::$app->request->cookies;
		//返回一个\yii\web\Cookie对象
		$user_id = $cookie->get('user_id');

        $data = Yii::$app->request->post();
        //print_r($data['biaoti']);die;
        $biaoti = $data['biaoti'];
        $neirong = $data['neirong'];
        //var_dump($data);die;
        $wordData = array(
            '察象蚂',
            '拆迁灭',
            '车牌隐',
            '成人电',
            '成人卡通',
            'cnm',
            '日绿',
        );

        $neirong = SensitiveHelper::init()->setTree($wordData)->replace($neirong, '***');
        $model = new Liuyan();
    		$model->biaoti = "$biaoti";
    		$model->neirong = "$neirong";
    		$model->user_id = "$user_id";
    		$res = $model->save();
        // $sql= "INSERT INTO user (username,userpwd) VALUES ('$username','$userpwd')";
        // $res=Yii::$app->db->createCommand($sql)->execute();
        if($res){
            echo "<script>alert('添加留言成功');location.href='index.php?r=lianxi/show'</script>";
        }else{
            echo "<script>alert('添加留言失败');location.href='index.php?r=lianxi/index'</script>";
        }
    }
    public function actionShow()
    {
        $sql="select * from user a,liuyan b where a.id = b.user_id";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('show',['data'=>$data]);

    }
    public function actionDel()
    {
    	 $id = Yii::$app->request->get('id');
    	 $model = new Liuyan();
    	 $res = $model->deleteAll("id = $id");
		 if($res)
		 {
            echo "<script>alert('删除成功');location.href='index.php?r=lianxi/show'</script>";
         }else{
            echo "<script>alert('删除失败');location.href='index.php?r=lianxi/show'</script>";
         }
    }
    public function actionUpdate()
    {
    	$id = Yii::$app->request->get('id');
    	$model = new Liuyan();
   		$data=$model->find()->where(['id'=>$id])->asArray()->One();
  		//$sql="select * FROM user WHERE id = $id";
		//$query = Yii::$app->db->createCommand($sql,[':id' => $id])->queryOne();
		//print_r($query);die;

		return $this->render('update',['data'=>$data]);
    }
    public function actionUpdate_do()
    {
    	$data = Yii::$app->request->post();
        //print_r($data['biaoti']);die;
        $biaoti = $data['biaoti'];
        $neirong = $data['neirong'];
        $id = $data['id'];
        $user_id = $data['user_id'];
        $model = new Liuyan();
    		$model->biaoti = "$biaoti";
    		$model->neirong = "$neirong";
    		$model->user_id = "$user_id";
    		$res = $model->save("id = $id");
  //   	$id = Yii::$app->request->get('id');
  //   	$username = Yii::$app->request->get('username');
  //   	$userpwd = Yii::$app->request->get('userpwd');
  //   	$sql="UPDATE user SET username = :username and userpwd = :userpwd WHERE id = :id";
		// $res = Yii::$app->db->createCommand($sql,[':id'=>$id,':username'=>$username,':userpwd'=>$userpwd])->execute();
    		if($res)
    		{
            echo "<script>alert('修改成功');location.href='index.php?r=lianxi/show'</script>";
        }else{
         echo "<script>alert('修改失败');location.href='index.php?r=lianxi/show'</script>";
        }
    }
}
?>
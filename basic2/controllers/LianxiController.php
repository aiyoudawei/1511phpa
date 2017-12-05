<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Liuyan;
use app\models\User;
use app\models\Field;
use DfaFilter\SensitiveHelper;

class LianxiController extends Controller
{
    public $layout = false;
   	public $enableCsrfValidation = false;
    public function actionSelone()
   	{
   		$data = Yii::$app->request->post();
   		$model = new User();
   		$res=$model->find()->where(['username'=>$data['username'],'userpwd'=>$data['userpwd']])->asArray()->One();
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
    public function actionShow()
    {
      $model = new Field();
      $data=$model->find()->asArray()->All();
      return $this->render('show',['data'=>$data]);
    }
    public function actionAddone()
    {
      return $this->render('addone');
    }
    public function actionAddone_do()
    {
       $name = Yii::$app->request->post('name');
       $value = Yii::$app->request->post('value');
       $type = Yii::$app->request->post('type');
       $rule = Yii::$app->request->post('rule');
       $required = Yii::$app->request->post('required');
       $limit = Yii::$app->request->post('limit');
       if($type == 'input-radio'){
           $xx1 = Yii::$app->request->post('xx1');
           $xx2 = Yii::$app->request->post('xx2');
           $array=array(
              'xx1'=>$xx1,
              'xx2'=>$xx2,
           );
           $xuanxiang = json_encode($array);
           $model = new Field();        
           $model->name = $name;
           $model->value = $value;
           $model->type = $type;
           $model->required = $required;
           $model->limit = $limit;
           $model->rule = $rule;
           $model->xuanxiang = $xuanxiang;
           $res = $model->save();
          if($res){
            echo "<script>alert('添加成功');location.href='index.php?r=lianxi/show'</script>";
          }else{
              echo "<script>alert('添加失败');location.href='index.php?r=lianxi/show'</script>";
          }
       }else{
           $model = new Field();      
           $model->name = $name;
           $model->value = $value;
           $model->type = $type;
           $model->required = $required;
           $model->limit = $limit;
           $model->rule = $rule;
           $res = $model->save();
           if($res){
              echo "<script>alert('添加留言成功');location.href='index.php?r=lianxi/show'</script>";
           }else{
              echo "<script>alert('添加留言失败');location.href='index.php?r=lianxi/show'</script>";
           }
       }
    }
    public function actionDelone()
    {
      $id = Yii::$app->request->get('id');
      $model = new Field();
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
      $model = new Field();
      $data=$model->find()->where(['id'=>$id])->asArray()->One();
      $xuanxiang = $data['xuanxiang'];
      $array = json_decode($xuanxiang,true);
      $data['xx1'] = $array['xx1'];
      $data['xx2'] = $array['xx2'];
      return $this->render('update',['data'=>$data]);
    }
    public function actionUpdate_do()
    {
       $id = Yii::$app->request->post('id');
       $name = Yii::$app->request->post('name');
       $value = Yii::$app->request->post('value');
       $type = Yii::$app->request->post('type');
       $rule = Yii::$app->request->post('rule');
       $required = Yii::$app->request->post('required');
       $limit = Yii::$app->request->post('limit');
       if($type == 'input-radio'){
           $xx1 = Yii::$app->request->post('xx1');
           $xx2 = Yii::$app->request->post('xx2');
           $array=array(
              'xx1'=>$xx1,
              'xx2'=>$xx2,
           );
           $xuanxiang = json_encode($array);
           $model = new Field();        
           $model->name = $name;
           $model->value = $value;
           $model->type = $type;
           $model->required = $required;
           $model->limit = $limit;
           $model->rule = $rule;
           $model->xuanxiang = $xuanxiang;
           $res = $model->save("id = $id");
          if($res){
            echo "<script>alert('添加成功');location.href='index.php?r=lianxi/show'</script>";
          }else{
            echo "<script>alert('添加失败');location.href='index.php?r=lianxi/show'</script>";
          }
       }else{
           $model = new Field();        
           $model->name = $name;
           $model->value = $value;
           $model->type = $type;
           $model->required = $required;
           $model->limit = $limit;
           $model->rule = $rule;
           $res = $model->save("id = $id");
           if($res){
              echo "<script>alert('修改成功');location.href='index.php?r=lianxi/show'</script>";
           }else{
              echo "<script>alert('修改失败');location.href='index.php?r=lianxi/show'</script>";
           }
       }
    }
}
?>
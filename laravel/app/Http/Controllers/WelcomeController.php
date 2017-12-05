<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Cookie;
use session;
use Sensitive;
use Illuminate\Support\Facades\Redis;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('index');
	}
	//日程
	public function richeng()
	{
		return view('rcindex');
	}
	public function rcdl()
	{
		$username  = $_POST['username'];
		$userpwd  = $_POST['userpwd'];
		//$username =  Input::all();
		$res=DB::select("select * from user where username = '$username' and userpwd = '$userpwd'");
		if($res){
			
			return redirect()->action('WelcomeController@rcshow');
		}else{
			
			return redirect()->action('WelcomeController@rcshow');
		}
	}
	public function rcshow()
	{
		return view('rcshow');
	}
	public function rcadd()
	{
		$time = $_POST['time'];
		$shi = $_POST['shi'];
		$fen = $_POST['fen'];
		$newtime = $time.''.$shi.':'.$fen.':00'; 
		$neirong = $_POST['neirong'];
		$type = $_POST['type'];
		$res=DB::table('richeng')->insert(['newtime'=>$newtime,'neirong'=>$neirong,'type'=>$type]);     
		if($res)
		{
			if($type == '1')
			{
				$arr = array(
					'newtime'=>$newtime,
					'neirong'=>$neirong, 
					'type'=>$type
				);
				$newarr=json_encode($arr);
				//echo $newarr;die;
				 Redis::rpush('rc',$newarr);
				//$ww = Redis::rpop('rc');
				//echo $ww;die;
			}
			return redirect()->action('WelcomeController@rcshow');
		}else{
			return redirect()->action('WelcomeController@rcshow');
		}
	}
	//留言操作
	public function liuyan()
	{
		return view('llindex');
	}
	//用户登录
	public function ww2(){
		$username  = $_POST['username'];
		$userpwd  = $_POST['userpwd'];
		//$username =  Input::all();
		$res=DB::select("select * from user where username = '$username' and userpwd = '$userpwd'");
		if($res){
			return redirect()->action('WelcomeController@show');
		}else{
			return redirect()->action('WelcomeController@index');
		}
	}
	public function show()
	{
		$data=DB::select("select * from user a,liuyan b where a.id = b.user_id");
     	//print_r($data);die;
		return view('show',['data'=>$data]);
	}
	public function del()
	{
		$id = $_GET['id'];
		$res= DB::table('liuyan')->where('id',$id)->delete();  
	    if($res)  
	    {  
	        return redirect('show'); 
	    }else{
	    	return redirect('show');
	    }

	}
	public function update()
	{
		$id = $_GET['id']; 
		//print_r($id);die;
		$data = DB::table('liuyan')->where('id',$id)->first();
		//print_r($data);die;
      	return view('update',['data'=>$data]);
	}
	public function add()
	{
		return view('add');
	}
	public function adddo()
	{
		$biaoti=$_POST['biaoti'];  
      	$neirong=$_POST['neirong'];
      	$user_id=$_POST['user_id'];


      	$interference = ['&', '*'];
		$filename = 'D:\phpStudy\WWW\shixun1\diyizhou\laravel\vendor\yankewei\laravel-sensitive\demo\words.txt'; //每个敏感词独占一行
		Sensitive::interference($interference); //添加干扰因子
		Sensitive::addwords($filename); //需要过滤的敏感词
		
		$neirong = Sensitive::filter($neirong);
		
      	$res=DB::table('liuyan')->insert(['biaoti'=>$biaoti,'neirong'=>$neirong,'user_id'=>$user_id]);       
	    if($res)  
	    {  
	        return redirect('show'); 
	    }else{
	    	return redirect('show');
	    }    

	}
	public function update_do()
	{
		$biaoti=$_POST['biaoti'];  
      	$neirong=$_POST['neirong'];
      	$user_id=session('user_id');
      	//print_r($user_id);die;
      	$id=$_POST['id']; 
       	$arr=array('biaoti'=>$biaoti,'neirong'=>$neirong,'user_id'=>$user_id,'id'=>$id);  
       	$re=DB::table('liuyan')  
            ->where('id','=',$id )  
         	->update($arr);  
        if($re)  
      	{  
           return redirect('show');  
       	}
       	else{
	    	return redirect('show');
	    } 
	}
}

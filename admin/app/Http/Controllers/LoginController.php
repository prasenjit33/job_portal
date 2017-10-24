<?php 
namespace App\Http\Controllers;
use App\Classes\SimpleImage;
use Illuminate\Support\Facades\Input;
use Request;
use DB;
use Session;

class LoginController extends Controller {

	public function __construct()
	{
		//$this->middleware('guest');
	}
        
        public function login()
        {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            
            $checkLogin = DB::table('tbl_admin_master')->where('username',$username)->where('password', sha1($password))->where('flag',1)->get();
            if(count($checkLogin) > 0)
            {
                foreach($checkLogin AS $checkLogin){}
                Session::put('admin_ID',$checkLogin->id);
                Session::put('admin_slug',$checkLogin->slug);
                Session::put('admin_name',$checkLogin->f_name.' '.$checkLogin->l_name);
                Session::put('admin_username',$checkLogin->username);
                Session::put('admin_email',$checkLogin->email);
                return redirect()->action('LoginController@dashboard');
                Session::forget('login_msg');
            }
            else
            {
                Session::put('login_msg',"Wrong Username / Password");
                echo "<Script>window.location.href='http://localhost/job_portal/admin/'</script>";
            }
        }
        
        public function dashboard()
        {
            if(Session::get('admin_ID')!='') 
            {
                return view('dashboard');
            }
            else
            {
                echo "<script>window.location.href='http://localhost/job_portal/admin/'</script>";
            }
        }
        
        public function logout()
        {
            Session::flush();
            echo "<script>window.location.href='http://localhost/job_portal/admin/'</script>";
        }

}

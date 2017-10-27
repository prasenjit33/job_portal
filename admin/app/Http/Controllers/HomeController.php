<?php 
namespace App\Http\Controllers;
use App\Classes\SimpleImage;
use Illuminate\Support\Facades\Input;
use Request;
use DB;
use Session;

class HomeController extends Controller {

	public function __construct()
	{
		//$this->middleware('guest');
	}
        
        public function index()
        {
            return view('home.top-slider');
        }
        
        /*
         * Upload Top Section Image
         */
        
        function UploadTopSectionImage()
        {
            $sFileName = $_FILES['top_slider_image']['name'];
            $arrFileExtensionCheck = $this->checkfile($_FILES['top_slider_image']);
            if($arrFileExtensionCheck['safe'] == 1)
            {
                $size = getimagesize($_FILES['top_slider_image']['tmp_name']);                
                $imageWidth = $size[0];
               echo $imageHeight = $size[1];
                
                
            }
            else
            {
                echo "invalidFile";
            }
        }
        
        //Check the file is of correct format.  
        function checkfile($input)
        {
        $ext = array('jpeg', 'JPEG', 'JPG', 'jpg', 'PNG', 'png');
        $extfile = substr(strrchr($input['name'], "."), 1);      
        
        $extfile = explode('.',$extfile);
        $good = array();
        $extfile = $extfile[0];
        if(in_array($extfile, $ext))
        {
            $good['safe'] = 1;
        }
        else
        {
            $good['safe'] = 0;
        }
         return $good;
        }
}
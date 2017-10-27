<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Request;
use Response;
use DB;
use Session;

class LocationController extends Controller {

	public function __construct()
	{
		//$this->middleware('guest');
	}
        
        public function index()
        {
        }
        
        public function GetCountries()
        {
            return view('location.country.country');
        }
        
        /*
         * Ajax script to get all countries
         */
        public function AjaxGetAllCountries()
        {
            if(Request::json()) 
            {
                $countries = DB::table('tbl_country')->where('country_status', '=', 1)->orderBy('country_id','DESC')->get();
                $total_records =  DB::table('tbl_country')->where('country_status', '=', 1)->count();

                    echo '{"iTotalRecords":'.$total_records.',
                                       "iTotalDisplayRecords":'.$total_records.',
                                       "aaData":['; 

                              $iCount=0; 
                    foreach ($countries as $countries)
                    {
                        if($iCount++) echo ','; 
                        echo '["',stripslashes($iCount).'","'.stripslashes($countries->country).'","<a href=\'javascript:void(0);\' onclick=\'GetCountryByID(\"'.$countries->country_slug.'\");\' class=\'btn btn-block btn-primary\'>Edit</a><a href=\'javascript:void(0);\' onclick=\'TrashCountry(\"'.$countries->country_slug.'\");\' class=\'btn btn-block btn-danger\'>Trash</a>"]'; 
                    } 
                        echo ']}'; 
            }
        }
        
        /*
         * Get the Country Page to Save country
         */
        public function AddCountry()
        {
            return view('location.country.add-country');
        }
        
        /*
         * Ajax Script to save country data
         */
        
        public function AjaxSaveCountry()
        {
            $country_slug = $_POST['country_slug'];
            $country_name = $_POST['country_name'];
            $date = date('Y-m-d H:i:s');
            if($country_slug == '')
            {
                $country_slug = str_slug($country_name).'-'.rand(100000,9999999);;
                $arrCountry =   [
                                    'country_slug' => $country_slug,
                                    'country' => $country_name,
                                    'created_at' => $date
                                ];
            
                if(DB::table('tbl_country')->insert($arrCountry))
                {
                    echo "success";
                }
                else
                {
                    echo "error";
                }
            }
            else
            {
                $arrCountry =   [
                                    'country' => $country_name,
                                    'updated_at' => $date
                                ];
            
                if(DB::table('tbl_country')->where('country_slug',$country_slug)->update($arrCountry))
                {
                    echo "success";
                }
                else
                {
                    echo "error";
                }
            }
        }
        
        /*
         * Ajax script to get country by ID
         */
        
        function AjaxGetCountryByID()
        {
            $arrCountry = DB::table('tbl_country')->where('country_slug', '=', $_POST['country_slug'])->get();
            foreach($arrCountry AS $value)
            {
                $country_slug = $value->country_slug;
                $country_name = $value->country;
                
            }
            $returnResult = array ('country_slug'=>$country_slug,'country_name'=>$country_name);
            return Response::json($returnResult);
        }
        
        /*
         * Trash Country by slug
         */
        
        public function AjaxTrashCountry()
        {
            $country_slug = $_POST['country_slug'];
            $date = date('Y-m-d H:i:s');
            
            $arrCountry =   [
                                'country_status' => 0,
                                'updated_at' => $date
                            ];
            
            if(DB::table('tbl_country')->where('country_slug',$country_slug)->update($arrCountry))
            {
                $returnResult = array ('msg'=>'1','message'=>'<strong>Success!</strong> You have successfully trashed an item.');
                return Response::json($returnResult);
            }
            else
            {
                $returnResult = array ('msg'=>'0','message'=>'<strong>Error!</strong> There is some technical error. Please try again.');
                return Response::json($returnResult);
            }
        }
        
        /*
         * Get All Trashed Country
         */
        
        public function AjaxGetAllTrashedCountries()
        {
            if(Request::json()) 
            {
                $countries = DB::table('tbl_country')->where('country_status', '=', 0)->orderBy('country_id','DESC')->get();
                $total_records =  DB::table('tbl_country')->where('country_status', '=', 0)->count();

                    echo '{"iTotalRecords":'.$total_records.',
                                       "iTotalDisplayRecords":'.$total_records.',
                                       "aaData":['; 

                              $iCount=0; 
                    foreach ($countries as $countries)
                    {
                        if($iCount++) echo ','; 
                        echo '["',stripslashes($iCount).'","'.stripslashes($countries->country).'","<a href=\'javascript:void(0);\' onclick=\'RestoreCountry(\"'.$countries->country_slug.'\");\' class=\'btn btn-block btn-primary\'>Restore</a><a href=\'javascript:void(0);\' onclick=\'DeleteCountry(\"'.$countries->country_slug.'\");\' class=\'btn btn-block btn-danger\'>Delete</a>"]'; 
                    } 
                        echo ']}'; 
            }
        }
        
        /*
         * Delete Country by country slug
         */
        
        public function AjaxDeleteCountryByCountrySlug()
        {
            $country_slug = $_POST['country_slug'];
            if(DB::table('tbl_country')->where('country_slug',$country_slug)->delete())
            {
                $returnResult = array ('msg'=>'1','message'=>'<strong>Success!</strong> You have successfully deleted an item.');
                return Response::json($returnResult);
            }
            else
            {
                $returnResult = array ('msg'=>'0','message'=>'<strong>Error!</strong> There is some technical error. Please try again.');
                return Response::json($returnResult);
            }
        }
        
        /*
         * Restore Country by country slug
         */
        
        public function AjaxRestoreCountryByCountrySlug()
        {
            $country_slug = $_POST['country_slug'];
            $date = date('Y-m-d H:i:s');
            
            $arrCountry =   [
                                'country_status' => 1,
                                'updated_at' => $date
                            ];
            
            if(DB::table('tbl_country')->where('country_slug',$country_slug)->update($arrCountry))
            {
                $returnResult = array ('msg'=>'1','message'=>'<strong>Success!</strong> You have successfully restored an item.');
                return Response::json($returnResult);
            }
            else
            {
                $returnResult = array ('msg'=>'0','message'=>'<strong>Error!</strong> There is some technical error. Please try again.');
                return Response::json($returnResult);
            }
        }
        
        
}
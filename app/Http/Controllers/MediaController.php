<?php

namespace App\Http\Controllers;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Config;
use Form;
use Image;
use App\Models\Media_m;


class MediaController extends Controller
{
	 public function __construct() {
      //$this->middleware('auth');
    }
    public function index(){
    	 
    	 $data=[];
    	 $mediaData = Media_m::where('status', '<', 2)->orderBy('media_id','desc')->paginate(Config::get('constants.PER_PAGE',10));
    	 $data['breadcrumb'] = [
            [
                'href' => Config::get('app.url'),
                'title' => 'Dashboard'
            ],[
                'href' => 'javascript:void(0)',
                'title' => 'Media Management'
            ]
        ];
        $data['sub_nav'] = [
            [
                'href' => Config::get('app.url').'media/sample',
                'icon' => 'fa fa-add',
                'title' => 'Add Sample'
            ],
        ];
    	$data['add_js'] = ['fileinput.min.js'];
    	$data['add_css'] = [];
    	$data['mediaData'] = $mediaData;
       $data['page_title'] = 'Media Management';
      $data['page_desc'] = 'Media  Management';
    	return view('/media/list',$data);
    }
    public function sample(Request $request){

      $data['breadcrumb'] = [
            [
                'href' => Config::get('app.url'),
                'title' => 'Dashboard'
            ],[
                'href' => Config::get('app.url').'media/',
                'title' => 'Media Management'
            ],[
                'href' => 'javascript:void(0)',
                'title' => 'Add Sample'
            ]
        ];
        $data['sub_nav'] = [
            [
                'href' => Config::get('app.url').'media/',
                'icon' => 'fa fa-list',
                'title' => 'List'
            ],
        ];

      $data['sampleMedia'] = Media_m::where('status', '<', 2)->first();;
      $data['add_js'] = ['fileinput.min.js'];
      $data['add_css'] = [];
      $data['page_title'] = 'Media Sample Management';
      $data['page_desc'] = 'Media Sample  Management';
      return view('/media/sample',$data);

    }
    public function getimages(Request $request){
    	if(!$request->ajax()){
               exit('No direct script access allowed');
        }
    	

        $getData = $request->All();
        $page = $getData['page'];
        $get_module = isset($getData['module'])?$getData['module']:'';
        $search =  isset($getData['search'])?$getData['search']:'';
        $offset = isset($page) ? ($page-1)*Config::get('constants.PER_PAGE',10) : 0;
        
        $set_module = '';
        if(!empty($get_module)){
            $set_module = strip_tags($get_module);
            if($set_module == 'Uncategorised'){
                $set_module = '';
            }
        }
        if(!empty($search)){
                //$cond['search_query'][] = '(file_name  LIKE "%'.$search.'%")';
                
        }
        $Media_m = new Media_m();
    	$modules = $Media_m->getmediacategory();
        $moduleArr = '<option value="">- All -</option>';
        if(!empty($modules)){
            foreach($modules as $module){
                $module_name = empty($module->module)?'Uncategorised':$module->module;
                //$moduleArr[$module_id] = $module['module'];
                $selected_modules = '';
                if($set_module == $module_name){
                    $selected_modules = 'selected="selected"';
                }
                $moduleArr .= '<option value="'.$module_name.'" '.$selected_modules.' >'.$module_name.'</option>';
            }
        }
    	$whereData = ['status' => 1];
	      if(!empty($set_module)){
	      	 $whereData['module'] = $set_module;
	      }
        $total_images = DB::table('media')->where($whereData)->count();
         $mediaList = DB::table('media')->where($whereData)
                ->offset($offset)
                ->limit(Config::get('constants.PER_PAGE',10))
                ->get();
        $imgArr = [];
        if(!empty($mediaList)){
            foreach($mediaList as $list){
                $imgArr[] = [
                    'image_id' => $list->media_id,
                    'image_url' => $list->base_url.'/small/'.$list->file_name,
                    'image_name' => $list->file_name,
                ];
            }
        }
        $pages = ceil($total_images / Config::get('constants.PER_PAGE',10));
        
        echo json_encode(['list' => $imgArr, 'total' => $total_images, 'pages' => $pages, 'module' => $moduleArr]);




    }
    /*
     * Upload images
     */
    public function uploadimages(Request $request){
       	

        $validator = Validator::make($request->all(), [
            'upload_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
       
        if(!$validator->fails())
        {
        	
        
           $date=date('m/Y');
           $date = str_replace( '/', '', $date);
           $upload_path = Config::get('constants.CND_PATH').'uploads/'.$date;
           $upload_path_base_url = Config::get('app.url').'assets/uploads/'.$date.'/';
           
           if (!is_dir( $upload_path)) {
               mkdir( $upload_path, 0777, TRUE);
           }
           if (!is_dir( $upload_path.'/large')) {
               mkdir( $upload_path.'/large', 0777, TRUE);
           }
           if (!is_dir( $upload_path.'/medium')) {
               mkdir( $upload_path.'/medium', 0777, TRUE);
           }
           if (!is_dir( $upload_path.'/small')) {
               mkdir( $upload_path.'/small', 0777, TRUE);
           }
           
            $file_module =  !empty($request->get('m'))?$request->get('m'):'';
        	$file = $request->upload_img;
        	$OriginalName = $file->getClientOriginalName();
        	$OriginalExtension = $file->getClientOriginalExtension();
        	$size = $file->getSize();
        	$MimeType = $file->getMimeType();
        	$RealPath = $file->getRealPath();
	        $imageName = time().'.'.$OriginalExtension;
	        
	        $this->_resize_image($RealPath, $upload_path, '/medium/', 400, 300,$imageName);
            $this->_resize_image($RealPath, $upload_path, '/small/', 200, 200,$imageName);
            $file->move($upload_path.'/large/', $imageName); 
	        $result = DB::table('media')->insert([
	        				'base_url' => $upload_path_base_url,
	                        'original_name' => $OriginalName,
	                        'file_name' => $imageName,
	                        'file_path' => $date,
	                        'file_size' => $size,
	                        'mime_type' => $MimeType,
	                        'module' => $file_module
	                    ]
			);  

       	 $res['success'] =  'You have successfully upload images.';
          
            
        } else {
            $res['error'] = 'Image not found!';
        }
        echo json_encode($res);
        exit;
    }
    
    private function _resize_image($getRealPath, $root_path = '', $folder_name = 'small', $width = 200, $height = 200,$filename){
      Image::make($getRealPath)->resize($width, $height)->save($root_path.$folder_name.$filename);
        
    }
    public function delete(Request $request, $media_id){
   
         $mediaInfo =	DB::table('media')->where(['media_id' => $media_id,'status'=>1])->first();
        if(!empty($mediaInfo)){
            $res = DB::table('media')
            ->where('media_id', $media_id)
            ->update(['status' => 2]);
            return redirect('media')->withSuccess('Image deleted successfully.');
        }else {
            	return redirect('media')
                        ->withErrors('Image not found.');
         }
    }
}

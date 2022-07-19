<?php
namespace App\Http\Controllers;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;
use App\Helpers\Helper;


class NewsController extends Controller
{
    protected $newsModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->newsModel= new News();
    }
   
    // TODO : Code refactor and move the data fetching to model
    public function getNews(Request $request) {
        $news = $this->newsModel->getNews($request);
        //TODO:  Create the reusable method for response and move all strings to constant file
        return response()->json([ 'status' => 'success',"data" => $news]);
    }

    public function getById($id)
    {
      $news =  $this->newsModel->getById($id);
      return response()->json([ 'status' => 'success',"data" => $news]);

    }

    public function createNews(Request $request) { 
        try {
            //TODO : Validations Improvement and move the validation logic to validation class
            $validation_rules = array(
                'title' => 'required|max:255',
            );
            $validator = Validator::make($request->all(), $validation_rules);

            $err_msgs = [];
            if(!Helper::isValidUrl($request->image)){
                array_push($err_msgs, "Invalid image url");
            }

            if ($validator->fails()) {
                $err_msgs = $validator->messages();
            }
            if($err_msgs){
                return response()->json([ 'status' => 'error',"message" => $err_msgs]);
            }
            $news = $this->newsModel->createNews($request);
            return response()->json([ 'status' => 'success',"data" => $news]);
        } catch(ModelNotFoundException $e) {
            return response(['status' => 'error', "message" => $e->getMessage()], 200);
        }
    }

    public function updateNews(Request $request, $id){
        try {
            $news = $this->newsModel->updateNews($request, $id); 
            if(!$news){
                return response(['status' => "error", "message" =>'News not found with the id: '.$id], 200);
            }else{
                return response(['status' => "success", "data" =>$news], 200);
            }
        } catch(ModelNotFoundException $e) {
            return response(['status' => 'error', "message" => $e->getMessage()], 200);
        }
    } 

    public function deleteNews($id){
        try {
            $resp = News::findOrFail($id)->delete();
            return response(['status' => $resp, "message" =>'News has been deleted Successfully'], 200);
        } catch(ModelNotFoundException $e) {
            return response(['status' => 'error', "message" => $e->getMessage()], 200);
        }
    }
}
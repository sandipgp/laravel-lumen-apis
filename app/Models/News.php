<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class News extends Model
{
    use HasFactory;
  
    protected $fillable = ['id', 'title', 'description', 'keywords', 'category_ids', 'author_ids', 'image'];
    protected $table = 'news';

    public static function generate_like_condition($key,$value,$append_and = false){
        $ret = '';
        if($append_and) {
            $ret .=  " AND ";
        }
        $ret .=  "{$key} LIKE '%{$value}%' ";
       
        return  $ret;
    
    }  
    public function getAllNews() {
        return $this->all();
        // $news = News::join('authors', 'news.author_ids', '=', 'authors.id')
       //         ->get(['news.*']);
    }

    public function getNews($request) {
        $search = '';
        if ($request->has('title')) {
            $search = $this->generate_like_condition('title',$request->input('title'));
        }

        if ($request->has('description')) {
            if($search) {  $search .=  $this->generate_like_condition('description',$request->input('description'), true); }
            else {  $search .=  $this->generate_like_condition('description',$request->input('description'), false);}
        }

        if ($request->has('keyword')) {
            if($search) {  $search .=  $this->generate_like_condition('keywords',$request->input('keyword'), true); }
            else {  $search .=  $this->generate_like_condition('keywords',$request->input('keyword'), false);}
        }

        if ($request->has('category')) {
            if($search) {  $search .=  $this->generate_like_condition('category_ids',$request->input('category'), true); }
            else {  $search .=  $this->generate_like_condition('category_ids',$request->input('category'), false);}
        }

        if($search == ""){
            $news =  $this->newsModel->getAllNews();
            
        } else {
            $news = News::select("*")
                       ->whereRaw($search)
                       ->get();
        }
        
        return $news;
    }

    public function getById($id) {
        return $this->find($id);
    }

    public function createNews($request) {
        $news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->keywords = $request->keywords;
        $news->category_ids = $request->category_ids;
        $news->author_ids = $request->author_ids;
        $news->image = $request->image;
        $news->save();
        return $news;
    }

    public function updateNews($request, $id) {
        $news  = $this->find($id);
        if($news){
            $news->title = $request->input('title');
            $news->description = $request->input('description');
            $news->keywords = $request->input('keywords');
            $news->image = $request->input('image');
            $news->updated_at = date('Y-m-d G:i:s');
            $news->save();
        }
        return $news;
    }
}
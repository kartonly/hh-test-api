<?php

namespace App\Http\Controllers;

use App\Http\Managers\CommentsManager;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage as Stor;

class NewsController extends Controller
{
    var $commentsManager;

    function __construct() {
        $this->commentsManager = app(CommentsManager::class);
    }

    public function all(){
        return News::with(['category', 'tags'])->paginate(5);
    }

    public function getOne($id){
        $news = News::where('id', $id)->with(['comments', 'tags', 'category'])->get();
        $photo = $news[0]->photo;
        $new = $news[0];
        $new->photo = Stor::url($photo);

        return $new;
    }

    public function createComment(Request $request){
        $new = $this->commentsManager->create($request->toArray());

        return $new;
    }

    public function newsByCats($id){
        return News::where('category', $id)->get();
    }

    public function newsByTags($id){
        $news = News::whereHas('tags', function($q) use ($id){
            $q->where('id', $id);})
            ->get();

        return $news;
    }

    public function find($news){
        $news = News::where('name', 'LIKE', "%{$news}%")->get();
        $categories = Category::where('name', 'LIKE', "%{$news}%")->get();

        return new Response([$news, $categories]);
    }

    public function popularTags(){
        $tags = Tag::all();
        $array = [];
        foreach ($tags as $tag){
            $count = 0;
            $news = News::whereHas('tags', function($q) use ($tag){
                $q->where('id', $tag->id);})
                ->get();
            foreach ($news as $i){
                $comments = Comment::where('news', $i->id)->get();
                $count = $count + count($comments);
            }
            $array += [$tag->id => $count];
        }

        arsort($array);
        $popularTags = [];

        foreach ($array as $key => $value){
            array_push($popularTags, Tag::where('id', $key)->first());
        }
        $cut = array_slice($popularTags, 0, 3);

        return $cut;
    }
}

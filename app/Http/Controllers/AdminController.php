<?php

namespace App\Http\Controllers;

use App\Http\Managers\CommentsManager;
use App\Http\Managers\NewsManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    var $newsManager;
    var $commentsManager;

    function __construct() {
        $this->newsManager = app(NewsManager::class);
        $this->commentsManager = app(CommentsManager::class);
    }

    public function addNews(Request $request){
        $path = $request->file('photo')->store('public/images');
        $new = $this->newsManager->create($request->toArray(), $path);

        return $new;
    }

    public function deleteNews($id){
        return $this->newsManager->delete($id);
    }

    public function deleteComment($id){
        return $this->commentsManager->delete($id);
    }
}

<?php


namespace App\Http\Managers;


use App\Models\Comment;
use App\Models\News;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class NewsManager
{
    private ?News $news;

    public function __construct(?News $news = null)
    {
        $this->news = $news;
    }

    public function create($data, $path): ?News
    {
        $this->news = app(News::class);
        $this->news->fill($data);
        $this->news->photo = $path;
        $this->news->category = $data['category'];
        $this->news->save();

        if($data['tags']){
            foreach ($data['tags'] as $tag){
                $this->news->tags()->attach(['news'=>$this->news->id, 'tag'=>$tag->id]);
            }
        }
        return $this->news;
    }

    public function delete($id){
        $this->news = News::where('id', $id)->first();
        $this->news->delete();

        return "deleted";
    }

}

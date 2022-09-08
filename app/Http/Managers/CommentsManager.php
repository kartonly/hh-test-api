<?php


namespace App\Http\Managers;


use App\Models\Comment;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CommentsManager
{
    private ?Comment $comment;

    public function __construct(?Comment $comment = null)
    {
        $this->comment = $comment;
    }

    public function create($data): ?Comment
    {
        $this->comment = app(Comment::class);
        $this->comment->fill($data);
        $this->comment->save();

        return $this->comment;
    }

    public function delete($id){
        $this->comment = Comment::where('id', $id)->first();
        $this->comment->delete();

        return "deleted";
    }

}

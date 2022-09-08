<?php


namespace App\Http\Managers;


use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserManager
{
    private ?User $user;

    /**
     * Auth functions
     */

    public function __construct(?User $user = null)
    {
        $this->user = $user;
    }

    public function create($data): ?User
    {
        $this->user = app(User::class);
        $this->user->fill($data);
        $this->user->password = Hash::make($data['password']);
        $this->user->save();

        return $this->user;
    }

    public function auth($email, $password)
    {
        $this->user = User::where('email', $email)->first();

        if($this->user == null){
            return 0;
        } else {
            if(!Hash::check($password, optional($this->user)->password)){
                return 1;
            } else {
                $ttl = env('JWT_TTL');

                return auth()->setTTL($ttl)->login($this->user);
            }
        }
    }

    public function logout(){
        auth()->logout();
    }
}

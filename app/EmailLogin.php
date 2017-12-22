<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmailLogin extends Model
{
    public $guarded = [];
    protected $primaryKey = 'email';


    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    public static function createForEmail($email)
    {
        return self::create([
            'email' => $email,
            'token' => str_random(20)
        ]);
    }

    public static function updateForEmail($email)
    {
        $obj = self::where('email', $email)->firstOrFail();
        $obj->token = str_random(20);
        $obj->save();
        return $obj;
    }

    public static function validFromToken($token)
    {
        return self::where('token', $token)
            ->where('created_at', '>', Carbon::parse('-15 minutes'))
            ->firstOrFail();
    }
}

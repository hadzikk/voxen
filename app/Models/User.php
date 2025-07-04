<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function received_friend_requests()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id')->where('status', 'pending');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'user_id');
    }

    public function friendOf()
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }

    public function allFriends()
    {
        $friendsA = $this->friends()->with('friend')->get()->pluck('friend');
        $friendsB = $this->friendOf()->with('user')->get()->pluck('user');

        return $friendsA->merge($friendsB)->unique('id')->values();
    }

    public function isFriendWith($userId)
    {
        return Friend::where(function ($query) use ($userId) {
            $query->where('user_id', $this->id)->where('friend_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('friend_id', $this->id);
        })->exists();
    }

    public function hasPendingRequestWith($userId)
    {
        return FriendRequest::where('sender_id', $this->id)
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->exists();
    }
}

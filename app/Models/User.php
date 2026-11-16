<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password' , 'type'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
    function role(){
        return $this->belongsTo(Role::class)->withDefault();
        //انا شخص اتبع لمسمى وظيفي مثلا مدرس
    }
    function image(){
        return $this->morphOne(Image::class ,'imageable');
    }
    function reviews(){
        return $this->hasMany(Review::class);
    }
    function orders(){
        return $this->hasMany(Order::class);
    }
    function order_details(){
         return $this->hasMany(OrderDetail::class);
    }
    function payment(){
        return $this->hasMany(Payment::class);
    }
    function testimonials(){
        return $this->hasMany(Testimonial::class);
    }
}

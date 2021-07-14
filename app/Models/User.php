<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
//use Laravel\Passport\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements JWTSubject //, MustVerifyEmail
{
    use Notifiable,
        HasFactory,
        HasPermissions,
        HasSlug;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',	
        'identity',
        'birth',
        'phone',
        'address',
        'city',
        'country',
        'slug',
        'activity',
        'authorization',
        'iban',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url',
    ];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return vsprintf('https://www.gravatar.com/avatar/%s.jpg?s=200&d=%s', [
            md5(strtolower($this->email)),
            $this->name ? urlencode("https://ui-avatars.com/api/$this->name") : 'mp',
        ]);
    }
    
     /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the oauth providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function announce()
    {
        return $this->hasMany(Announce::class);
    }
    
    public function property()
    {
        return $this->hasMany(Property::class);

    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
    
   public function hasRole(...$roles)
   {
       return $this->roles()->whereIn('slug', $roles)->count();

   } 
   public function permissions()
   {
       return $this->belongsToMany(Role::class, 'users_permissions');
   }

   public function review()
   {
       return $this->hasOne(HouseReview::class); 
   }
   
   public function appointment()
   {
       return $this->hasMany(Appointments::class); 
   }

   public function promoservice()
   {
       return $this->hasMany(PromoService::class); 
   }
   public function verifyservice()
   {
       return $this->hasMany(VerifyService::class); 
   }
   public function scheduleservice()
   {
       return $this->hasMany(ScheduleService::class); 
   }
   public function favourite()
   {
       return $this->hasMany(Favourite::class); 
   }
   public function history()
   {
       return $this->hasMany(History::class); 
   }


}

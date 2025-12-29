<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_active', 'role_id', 'verify', 'mobile_number', 'photo', 'category_id', 'provider', 'provider_id',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function coaching()
    {
        return $this->hasMany('App\Coaching');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function personal()
    {
        return $this->belongsTo('App\Personal');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function claim()
    {
        return $this->belongsTo('App\Claim');
    }
    public function report()
    {
        return $this->belongsTo('App\Report');
    }
    public function plan()
    {
        return $this->belongsTo('App\UserPlan');
    }
    public function isUser()
    {
        if ($this->role->name == "User" && $this->is_active == 1) 
        {
            return true;
        }
        return false;
    }
    public function isAdmin()
    {
        if ($this->role->name == "Admin") 
        {
            return true;
        }
        return false;
    }
    public function isAgent()
    {
        if ($this->role->name == "Agent" && $this->is_active == 1) 
        {
            return true;
        }
        return false;
    }
    public function isEditor()
    {
        if ($this->role->name == "Editor" && $this->is_active == 1) 
        {
            return true;
        }
        return false;
    }
    public function isPost()
    {
        if ($this->is_active == 1) 
        {
            return true;
        }
        return false;
    }
}
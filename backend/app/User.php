<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @SWG\Definition(required={"name", "email", "password", "pointsAviable", "ban", "validEmail", "admin"}, type="object", @SWG\Xml(name="User"))
 */
class User extends Authenticatable
{
    use Notifiable;



    /**
     * @var string
     * @SWG\Property(example="SuperUserOfTheDead666")
     */
    protected $name = "name";

    /**
     * @var string
     * @SWG\Property(example="example@domain.io")
     */
    protected $email = "email";

    /**
     * @var string
     * @SWG\Property()
     */
    protected $password = "password";

    /**
     * @var integer
     * @SWG\Property(format="int64")
     */
    protected $pointsAviable = "pointsAviable";

    /**
     * @var boolean
     * @SWG\Property(format="boolean")
     */
    protected $ban = "ban";

    /**
     * @var boolean
     * @SWG\Property(format="boolean")
     */
    protected $validEmail = "validEmail";

    /**
     * @var boolean
     * @SWG\Property(format="boolean")
     */
    protected $admin = "admin";



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pointsAviable', 'ban', 'validEmail', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }
}
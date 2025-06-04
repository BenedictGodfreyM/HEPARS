<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Uuids, Notifiable, HasRoleAndPermission;

    /**
     * The Primary Key Attribute.
     *
     * @var string
     */
    public $primaryKey  = 'id';

    /**
     * Indicates if the Primary-Key Should be Incremented.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'surname',
        'email',
        'profile_photo',
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

    /**
    * Interact with the user's firstname
    */
    protected function firstname(): Attribute
    {
        return Attribute::make(
                    get: fn(string $value) => ucfirst($value),
                    set: fn(string $value) => strtolower($value),
                );
    }

    /**
    * Interact with the user's surname
    */
    protected function surname(): Attribute
    {
        return Attribute::make(
                    get: fn(string $value) => ucfirst($value),
                    set: fn(string $value) => strtolower($value),
                );
    }
    
    /**
     * Get the user's fullname.
     * 
     * @return string
     */
    public function getFullnameAttribute(): string
    {
        return ($this->firstname . " " . $this->surname);
    }

    /**
     * Get the user's roles.
     * 
     * @return array
     */
    public function getRolesAttribute()
    {
        return $this->getRoles();
    }

    /**
     * Get the user's permissions.
     * 
     * @return array
     */
    public function getPermissionsAttribute()
    {
        return $this->getPermissions();
    }
}

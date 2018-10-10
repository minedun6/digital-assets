<?php

namespace App;

use App\Enums\AssetType;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $with = ['rootFolder'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rootFolder()
    {
        return $this->hasOne(LibraryFile::class)
                    ->where([
                        'type_id' => AssetType::Folder,
                        'level'        => 0,
                        'is_deletable' => false,
                        'parent_id' => null
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function personalFolder()
    {
        return $this->hasOne(LibraryFile::class)
                    ->where([
                         'level'        => 1,
                         'is_deletable' => false,
                         'folder_flag'  => 1
                    ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sharedFolder()
    {
        return $this->hasOne(LibraryFile::class)
                    ->where([
                        'level'        => 1,
                        'is_deletable' => false,
                        'folder_flag'  => 2
                    ]);
    }

}

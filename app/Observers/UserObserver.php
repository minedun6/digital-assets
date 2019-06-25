<?php

namespace App\Observers;

use App\Enums\AssetType;
use App\LibraryFile;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        // get the user and create the necessary initial folders (Assets/My Assets/Shared with me)
//        $rootFolder = factory(LibraryFile::class)->states(
//            'non-deletable', 'folder'
//        )->create([
//            'user_id' => $user->id,
//            'parent_id' => null,
//            'text' => 'Assets',
//            'level' => 0,
//            'is_batch' => false
//        ]);
//
//        factory(LibraryFile::class)->states(
//            'non-deletable', 'folder'
//        )->create([
//            'user_id' => $user->id,
//            'parent_id' => $rootFolder->id,
//            'text' => 'My assets',
//            'level' => 1,
//            'folder_flag' => 1,
//            'is_batch' => true
//        ]);
//
//        factory(LibraryFile::class)->states(
//            'non-deletable', 'folder'
//        )->create([
//            'user_id' => $user->id,
//            'parent_id' => $rootFolder->id,
//            'text' => 'Shared with me',
//            'level' => 1,
//            'folder_flag' => 2,
//            'is_batch' => true
//        ]);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\User;
use App\NewsItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsItemPolicy
{
    use HandlesAuthorization;

    public function index(User $user) {
        return true;
    }

    /**
     * Determine whether the user can view the newsItem.
     *
     * @param  \App\User  $user
     * @param  \App\NewsItem  $newsItem
     * @return mixed
     */
    public function view(User $user, NewsItem $newsItem)
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create newsItems.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //        
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the newsItem.
     *
     * @param  \App\User  $user
     * @param  \App\NewsItem  $newsItem
     * @return mixed
     */
    public function update(User $user, NewsItem $newsItem)
    {
        //        
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the newsItem.
     *
     * @param  \App\User  $user
     * @param  \App\NewsItem  $newsItem
     * @return mixed
     */
    public function delete(User $user, NewsItem $newsItem)
    {
        //
        return $user->is_admin;
    }
}

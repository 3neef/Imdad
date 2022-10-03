<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function created(User $User)
    {
        if ($User instanceof MustVerifyEmail && ! $User->hasVerifiedEmail()) {
            $User->sendEmailVerificationNotification();
        }
        //
        // SendEmailVerificationNotification::class;
        // Mail::to($User->email)->send(new VerifyEmail());
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'User Has Been Created Successfully'
        // ]);

    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function updated(User $User)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function deleted(User $User)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function restored(User $User)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $User
     * @return void
     */
    public function forceDeleted(User $User)
    {
        //
    }
}

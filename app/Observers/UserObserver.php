<?php

namespace App\Observers;

use App\Models\User;
use App\Jobs\SendEmailJob;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {

        $message ="You have successfully completed registration use the below Credentials <br>";
        $message .="Username is ".$user->email.'<br>';
        $message .=" Password is 123456 <br>";
        $message .="start using our System and Enjoy the service";
        $receiver_email =$user->email;
        $receiver_name  =$user->name;
        $subject        ="System Registration";
       // SendEmailJob::dispatch($message,$receiver_email,$receiver_name,$subject)->onQueue('emails');
       // SendEmailJob::dispatch($message,$receiver_email,$receiver_name,$subject)->onQueue('emails');
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}

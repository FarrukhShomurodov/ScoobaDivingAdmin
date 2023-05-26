<?php

namespace App\Services;

use Aloha\Twilio\Twilio;
use App\Mail\ApplicationMail;
use App\Models\Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Twilio\Exceptions\TwilioException;

class ApplicationService
{
    /**
     * @return Collection|array
     */
    public function index(): Collection|array
    {
        return Application::query()->get();
    }

    /**
     * @param $validated
     * @return Model|Builder
     */
    public function store($validated): Model|Builder
    {
        $app = Application::query()->create($validated);
        return $app->refresh();
    }

    /**
     * @param Application $application
     * @return Application|null
     */
    public function change_state(Application $application): ?Application
    {
        $application->update([
            "state" => 1
        ]);
//        $mailData = [
//            'title' => 'Mail from const.group.uz@gmail.com',
//            'body' => 'This is for testing email using smtp.'
//        ];
//        $twilio = new Twilio(getenv("TWILIO_SID"), getenv("TWILIO_TOKEN"), getenv("TWILIO_FROM"));
//        try {
//            $twilio->message("+998995759559", "Hello, I writing this message from Const Company");
//        }catch (TwilioException $e) {
//            dd("Message".$e->getMessage());
//        }
//        Mail::to($application->email)->send(new ApplicationMail($mailData));

        return $application->fresh();
    }

    /**
     * @return Collection|array
     */
    public function show_done_app(): Collection|array
    {
        return Application::query()->where('state',"=",1)->get();
    }
}

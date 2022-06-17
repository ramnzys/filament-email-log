<?php

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\actingAs;
use Ramnzys\FilamentEmailLog\Filament\Resources\EmailResource;
use Ramnzys\FilamentEmailLog\Models\Email;
use Ramnzys\FilamentEmailLog\Tests\Models\User;

it('redirects on non logged users', function () {
    $this->get(Config::get('filament.path'))
        ->assertRedirect();
});



it('shows dashboard to logged users', function () {
    actingAs($this->adminUser)->get(Config::get('filament.path'))->assertSuccessful();
});



it('can render EmailResourcePage', function () {
    actingAs($this->adminUser)->get(EmailResource::getUrl('index'))->assertSuccessful();
});



it('can display an email', function () {
    $faker = Factory::create();
    $recipient = $faker->email();
    $subject = $faker->words(5, asText: true);

    Mail::raw('Test e-mail text', function ($message) use ($recipient, $subject) {
        $message->to($recipient)
            ->subject($subject);
    });

    $email = Email::where('to', $recipient)->first();

    actingAs($this->adminUser)
        ->get(EmailResource::getUrl('view', $email->id))
        ->assertSee($recipient)
        ->assertSee($subject);
});

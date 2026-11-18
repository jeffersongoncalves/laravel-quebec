<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use JeffersonGoncalves\Quebec\Events\PersonalDataAnonymized;
use JeffersonGoncalves\Quebec\Facades\Quebec;
use JeffersonGoncalves\Quebec\Tests\Fixtures\Customer;

beforeEach(function () {
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->string('email')->unique()->nullable();
        $table->text('health_notes')->nullable();
        $table->string('tax_id')->nullable();
        $table->string('plan')->nullable();
    });

    config()->set('quebec.models', [Customer::class]);
});

function customer(): Customer
{
    return Customer::create([
        'name' => 'Maria Silva',
        'email' => 'maria@example.com',
        'health_notes' => 'diabetes',
        'tax_id' => '123.456.789-09',
        'plan' => 'pro',
    ]);
}

it('builds the inventory from attributes', function () {
    $inventory = Quebec::inventory();

    expect($inventory)->toHaveCount(4)
        ->and($inventory[0])->toBe([
            'model' => Customer::class,
            'table' => 'customers',
            'column' => 'name',
            'category' => 'personal',
            'purpose' => 'Identification',
            'retention' => null,
            'anonymize' => 'mask',
            'outside_quebec' => false,
            'profiling' => false,
        ])
        ->and($inventory[1]['outside_quebec'])->toBeTrue()
        ->and($inventory[2]['category'])->toBe('sensitive')
        ->and($inventory[3]['profiling'])->toBeTrue();
});

it('exports only declared columns, decrypted', function () {
    expect(customer()->exportPersonalData())->toBe([
        'name' => 'Maria Silva',
        'email' => 'maria@example.com',
        'health_notes' => 'diabetes',
        'tax_id' => '123.456.789-09',
    ]);
});

it('anonymizes each column with its strategy', function () {
    $customer = customer();
    $customer->anonymizePersonalData();
    $fresh = $customer->fresh();

    expect($fresh->name)->toBe('M**********')
        ->and($fresh->email)->toBe(hash_hmac('sha256', 'maria@example.com', config('app.key')))
        ->and($fresh->health_notes)->toBeNull()
        ->and($fresh->tax_id)->toBe('123.456.789-09')
        ->and($fresh->plan)->toBe('pro');
});

it('dispatches PersonalDataAnonymized with the changed columns', function () {
    Event::fake([PersonalDataAnonymized::class]);
    $customer = customer();

    $customer->anonymizePersonalData();

    Event::assertDispatched(PersonalDataAnonymized::class, fn (PersonalDataAnonymized $event) => $event->model->is($customer)
        && $event->columns === ['name', 'email', 'health_notes']);
});

it('throws and dispatches nothing when an observer cancels the save', function () {
    Event::fake([PersonalDataAnonymized::class]);
    $customer = customer();
    Customer::updating(fn () => false);

    expect(fn () => $customer->anonymizePersonalData())->toThrow(RuntimeException::class, 'cancelled')
        ->and(Customer::find($customer->id)->name)->toBe('Maria Silva');

    Event::assertNotDispatched(PersonalDataAnonymized::class);
});

it('rejects models that do not implement the contract', function () {
    config()->set('quebec.models', [stdClass::class]);

    Quebec::models();
})->throws(InvalidArgumentException::class);

it('prints the inventory as json', function () {
    Artisan::call('quebec:inventory', ['--json' => true]);

    expect(json_decode(Artisan::output(), true))->toHaveCount(4);
});

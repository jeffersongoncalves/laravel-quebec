<?php

namespace JeffersonGoncalves\Quebec\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Quebec\Attributes\PersonalData;
use JeffersonGoncalves\Quebec\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Quebec\Contracts\HasPersonalData;
use JeffersonGoncalves\Quebec\Enums\AnonymizeStrategy;
use JeffersonGoncalves\Quebec\Enums\DataCategory;

#[PersonalData('name', purpose: 'Identification', anonymize: AnonymizeStrategy::Mask)]
#[PersonalData('email', retention: '5 years', anonymize: AnonymizeStrategy::Hash, outsideQuebec: true)]
#[PersonalData('health_notes', category: DataCategory::Sensitive)]
#[PersonalData('tax_id', anonymize: AnonymizeStrategy::Keep, profiling: true)]
class Customer extends Model implements HasPersonalData
{
    use InteractsWithPersonalData;

    protected $guarded = [];

    public $timestamps = false;

    protected function casts(): array
    {
        return ['health_notes' => 'encrypted'];
    }
}

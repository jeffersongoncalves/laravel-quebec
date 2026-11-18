<?php

namespace JeffersonGoncalves\Quebec;

use JeffersonGoncalves\Privacy\Privacy;
use JeffersonGoncalves\Quebec\Contracts\HasPersonalData;

class Quebec extends Privacy
{
    protected string $config = 'quebec';

    protected string $contract = HasPersonalData::class;
}

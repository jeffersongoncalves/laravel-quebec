<?php

namespace JeffersonGoncalves\Quebec\Commands;

use JeffersonGoncalves\Privacy\Commands\KAnonymityCommand as BaseKAnonymityCommand;
use JeffersonGoncalves\Quebec\Quebec;

class KAnonymityCommand extends BaseKAnonymityCommand
{
    protected $signature = 'quebec:k-anonymity
        {model : Eloquent model class}
        {columns* : Quasi-identifier columns}
        {--k=5 : Minimum group size}
        {--sensitive= : Sensitive column for l-diversity}';

    protected string $privacy = Quebec::class;
}

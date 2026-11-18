<?php

namespace JeffersonGoncalves\Quebec\Commands;

use JeffersonGoncalves\Privacy\Commands\InventoryCommand as BaseInventoryCommand;
use JeffersonGoncalves\Quebec\Quebec;

class InventoryCommand extends BaseInventoryCommand
{
    protected $signature = 'quebec:inventory {--json : Output as JSON}';

    protected string $privacy = Quebec::class;
}

<?php

namespace CodeWithDennis\FilamentPriceFilter\Commands;

use Illuminate\Console\Command;

class FilamentPriceFilterCommand extends Command
{
    public $signature = 'filament-price-filter';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

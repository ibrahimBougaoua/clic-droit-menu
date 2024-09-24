<?php

namespace IbrahimBougaoua\ClicDroitMenu\Commands;

use Illuminate\Console\Command;

class ClicDroitMenuCommand extends Command
{
    public $signature = 'clic-droit-menu';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

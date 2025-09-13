<?php

namespace App\Console\Commands;

use App\Http\Controllers\FooterLinkController;
use Illuminate\Console\Command;

class RegenerateFooterLinksCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'footer-links:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate footer links cache file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Regenerating footer links cache...');

        $controller = new FooterLinkController();
        $controller->generateFooterLinksCache();

        $this->info('Footer links cache regenerated successfully!');

        return Command::SUCCESS;
    }
}

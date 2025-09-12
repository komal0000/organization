<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveViewCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viewcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    protected $patterns = [
        'home*',
        'news*',
        'notices*',
        'gallery*',
        'faq*',
        'committees*',
        'issues*',
        'about*',
        'contact*',
    ];
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publicPath = public_path();

        foreach ($this->patterns as $pattern) {
            $folders = glob($publicPath . DIRECTORY_SEPARATOR . $pattern, GLOB_ONLYDIR);

            if ($folders !== false) {
                foreach ($folders as $folder) {
                    File::deleteDirectory($folder);
                    $this->info("Removed folder: $folder");
                }
            }
        }

        $this->info('Folders matching specified patterns have been removed.');
        return Command::SUCCESS;
    }
}

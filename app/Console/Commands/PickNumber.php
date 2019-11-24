<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PickNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'picknumber';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PHP Artisan game';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Hi there, pick a number: 1, 2 or 3\n";
        $handle = fopen("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) == '1'){
            echo "You picked number 1. I think my program works :)\n";
            exit;
        }

        elseif(trim($line) == '2') {
            echo "You picked number 2! I knew it!\n";
            exit;
        }

        fclose($handle);
        echo "\n"; 
        echo "I bet you picked number 3. Am I right or am I right?\n";
        }
}

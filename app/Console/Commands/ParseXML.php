<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Environment\Environment;

class ParseXML extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ParseXML';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To parse the XML file and store the data in the database.';

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
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $response = $client->get(config('xml.url'));

        $contents = $response->getBody()->getContents();
        $xml = simplexml_load_string($contents);

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use App\Services\Product\ProductCreator;
use App\Services\Xml\XmlParser;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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
     * Undocumented variable
     *
     * @var ProductCreator
     */
    protected $productCreator;

    /**
     * Undocumented variable
     *
     * @var XmlParser
     */
    protected $xmlService;

    /**
     * Create a new command instance.
     *
     * @return void
     */


    public function __construct(ProductCreator $productCreator, XmlParser $xmlService)
    {
        parent::__construct();
        $this->productCreator = $productCreator;
        $this->xmlService = $xmlService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('XmlParser executing...');
        Log::info('XmlParser executing...');
        try {
            $client = new Client();
            $response = $client->get(config('xml.url'));

            $contents = $response->getBody()->getContents();
            $xml = $this->xmlService->parse($contents);

            foreach ($xml->product as $productXml) {
                $this->productCreator->createOrUpdateProductFromXml($productXml);
            }
            Log::info('XmlParser executed successfully.');
            $this->info('XmlParser executed successfully.');
        } catch (\Exception $e) {
            Log::error('An error occurred during execution of XmlParser: ' . $e->getMessage());
            $this->error('An error occurred during execution of XmlParser.');
        }
    }
}

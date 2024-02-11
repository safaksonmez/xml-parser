<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\Product\ProductCreator;
use App\Services\Xml\XmlParser;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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


    public function __construct(XmlParser $xmlService)
    {
        parent::__construct();
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
            DB::beginTransaction();
            $client = new Client();
            $response = $client->get(config('xml.url'));

            $contents = $response->getBody()->getContents();
            $xml = $this->xmlService->parse($contents);
            $products = [];

            foreach ($xml->product as $productXml) {
                $products[] = [
                    'id' => (int) $productXml->id,
                    'name' => (string) $productXml->name,
                    'description' => (string) $productXml->description,
                    'price' => (float) $productXml->price,
                    'quantity' => (int) $productXml->quantity,
                    'photo_url' => (string) $productXml->photo_url,
                ];
            }
            $chunked = array_chunk($products, 100);
            array_map(function ($chunk) {
                Product::upsert(
                    $chunk,
                    ['id'],
                    ['name', 'description', 'price', 'quantity', 'photo_url']
                );
            }, $chunked);

            DB::commit();
            Log::info('XmlParser executed successfully.');
            $this->info('XmlParser executed successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('An error occurred during execution of XmlParser: ' . $e->getMessage());
            $this->error('An error occurred during execution of XmlParser.');
        }
        return 0;
    }
}

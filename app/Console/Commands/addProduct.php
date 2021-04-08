<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Goutte\Client;
use App\Models\Tbl_product;
use Str;

class addProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl sản phẩm từ fpt shop';

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
        $crawler = $client->request('GET','https://laptopworld.vn/laptop-dell/dell-inspiron-series.html');
        $crawler->filter('.p-container')->each(function($node)
        {
            $url = $node->filter('a')->attr('href');
            $this->CrawlDetail($url); 
        });
    }
    public function CrawlDetail($url)
    {
        try {
            $client = new Client();
            $crawler = $client->request('GET','https://laptopworld.vn'.$url);
            $name = $crawler->filter('#product_detail h1')->first()->text();
            $desc = $crawler->filter('.nd')->first()->text();
            $content = $crawler->filter('.nd')->first()->text();
            
            $product =  new Tbl_product();
            $product->name = $name;
            $product->description = $desc;
            $product->content = $desc;
            $product->price = 33390000;
            $product->category_id = 4;
            $product->brand_id = 1;
            $product->quantity = 1;
            $product->slug = Str::slug($name);
            $product->status = 1;
            $product->image = '1.jpg';
            $product->product_sold = 0;
            $product->save();
            $this->info('crawl tin thành công: '.$name);

            
        } 
        catch (Exception $e) {

        }
    }

}

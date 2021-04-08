<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Goutte\Client;
use App\Models\Tbl_product;
use Str;

class addProduct_2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:add_2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl sản phẩm từ ipromax';

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
        $crawler = $client->request('GET','https://promaxshop.vn/collections/may-choi-game-cam-tay');
        $crawler->filter('.pdLoopImg ')->each(function($node)
        {
            $url = $node->filter('a')->attr('href');
            $this->CrawlDetail($url); 
        });
    }
    public function CrawlDetail($url)
    {
        try {
            $client = new Client();
            $crawler = $client->request('GET','https://promaxshop.vn'.$url);
            $name = $crawler->filter('.wrapPdInfo h1')->first()->text();
            $price = $crawler->filter('#pdPriceNumber')->first()->text();
            $price = str_replace('₫', '', $price);
            $price = str_replace(',', '', $price);
            $desc = $crawler->filter('.content')->first()->text();

            
            $product =  new Tbl_product();
            $product->name = $name;
            $product->description = $desc;
            $product->content = $desc;
            $product->price = $price;
            $product->category_id = 5;
            $product->brand_id = 10;
            $product->quantity = 100;
            $product->slug = Str::slug($name);
            $product->status = 1;
            $product->image = '2.jpg';
            $product->product_sold = 0;
            $product->save();
            $this->info('crawl tin thành công: '.$name);

            
        } 
        catch (Exception $e) {

        }
    }

}

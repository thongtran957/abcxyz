<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Helpers\GoogleDrive;

class TestController extends Controller
{
    public function index(){
    	$client = new Client();
    	$client = new Client(HttpClient::create(['timeout' => 60]));
		// $this->getCategories($client, "https://sachvui.com/");
     	// $this->getInfoEbooks($client, "https://sachvui.com/the-loai/tam-ly-ky-nang-song.html");
    	// $this->getChapterEbook($client, "https://sachvui.com/ebook/bi-mat-hanh-trinh-tinh-yeu.4740.html");
    	$this->getContentChapterEbook($client, "https://sachvui.com/doc-sach/bi-mat-hanh-trinh-tinh-yeu/chuong-1-kham-pha-bi-mat-hanh-trinh-cua-tinh-yeu.html");

    }

    //get name and link of category
    public function getCategories($client, $url){
    	$crawler = $client->request('GET', $url);
    	$crawler->filter('.cat-item > a')->each(function($node){
		   	$name_category = $node->text();
		   	$link_category = $node->filter('a')->extract(array('href'))[0];	
		   	//luu db	
		});
    }

    //get info for ebook
    public function getInfoEbooks($client, $url){
    	$crawler_page_1 = $client->request('GET', $url);
    	$last_page_number = (int) $crawler_page_1->filter('.pagination-sm > li > a')->last()->text();
    	for($i = 1; $i <= 1; $i++){
    		if($url != 1){
    			$crawler = $client->request('GET', $url.'/'.$i);
    		}else{
    			$crawler = $client->request('GET', $url);
    		}

    		try {
    			$crawler->filter('.ebook')->each(function($node){
				   	$name_ebook = ($node->text());
				   	$link_ebook = $node->filter('a')->extract(array('href'))[0];	
				   	$image_ebook = $node->filter('a > img')->extract(array('src'))[0];	
				   	//luu db	
				});
    		} catch (Exception $e) {
    			print($e);
    		}
    		
    	}
    }

    //get chapter of ebook
    public function getChapterEbook($client, $url){
    	$crawler = $client->request('GET', $url);
    	$author = trim(explode(':', $crawler->filter('.col-md-8 > h5')->first()->text())[1]);
    	$crawler->filter('#list-chapter > li')->each(function($node){
		   	$name_chapter = $node->text();
		   	$link_chapter = $node->filter('a')->extract(array('href'))[0];	
		   	//luu db
		});
    }

    //get content of chapter
    public function getContentChapterEbook($client, $url){
    	$crawler = $client->request('GET', $url);
    	$crawler->filter('.noi_dung_online')->each(function($node){
		   	$content = trim($node->html());
		   	//luu db
		});
    }

    //test connect with gg drive
    public function testGoogleDrive(){
        \Storage::cloud()->put('test.txt', 'Hello World');
        return 'File was saved to Google Drive';
    }
}

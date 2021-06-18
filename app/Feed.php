<?php
namespace App;.

use Goutte\Client;

class Feed
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function scrape() : array
	{
		$crawler = $this->client->request('GET', 'https://archive.mv/dv/onthisday');


        $feeds = [];
        $crawler->filter('.loop-article')->each(function ($node) use (&$feeds) {

            $feeds[] = [
                "title" => $node->filter('.article-title')->text(),
                "link" => $node->filter('.article-title a')->attr('href'),
                "date" => $node->filter('.meta-item time')->first()->attr('datetime'),
                "source" => $node->filter('.media-left a')->attr('title')
            ];

        });   

        return $feeds;  
	}
}
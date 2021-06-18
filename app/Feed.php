<?php
namespace App;

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

	public function scrapeArticle(string $link)
	{
		$crawler = $this->client->request('GET', $link);

		return [
			"guid" => basename($link),
			"title" => $crawler->filter('.article-title')->first()->text(),
			"link" => $link,
			"original_link" => $crawler->filter('.ext-link')->first()->attr('href'),
			"source" => [
				"name" => $crawler->filter('.media-left a')->first()->attr('title'),
				"image" => $crawler->filter('.media-left a img')->first()->attr('src')
			],
			"featured_image" => $crawler->filter('.photo a')->first()->attr('href'),
			"meta" => $crawler->filter('.meta-author')->first()->text(),
			"content" => $crawler->filter('.article-content')->first()->html()

		];
	}
}
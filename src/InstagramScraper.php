<?php

namespace angeljunior;

/**
 * Instagram Scraper V1
 *
 * TERMS OF USE:
 * - This code is in no way affiliated with, authorized, maintained, sponsored
 *   or endorsed by Icarros or any of its affiliates or subsidiaries. This is
 *   an independent and unofficial API. Use at your own risk.
 * - We do NOT support or tolerate anyone who wants to use this API to send spam
 *   or commit other online crimes.
 *
 */
 
class InstagramScraper
{

	
	/**
	* Rapid API
	* Endpoint
	*
	* @var string
	**/
	const RAPID_API = 'https://instagram-scraping-data.p.rapidapi.com';

	/**
	* Rapid API
	* Host
	*
	* @var string
	**/
	const RAPID_HOST = 'instagram-scraping-data.p.rapidapi.com';

	/**
	* Rapid API
	* Key
	*
	* @var string
	**/
	public $rapidapi_key = '';



	/**
	*
	* @var string
	*		   Rapid Api Key
	**/
	public function __construct($rapid_api_key = null){

		if(empty($rapid_api_key) || is_null($rapid_api_key))
			throw new Exception("Construct request a Rapid API Key", 1);

		
		$this->rapidapi_key = $rapid_api_key;
			


    }

    

	/**
	* 
	* Get Pofile by USERNAME
	*
	* @username : string
	* @return array 	
	*
	**/
    public function getProfileByUsername($username){


		$_request = $this->request('/api/v1/account_username')
				            ->addParam('username', $username)
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
	* 
	* Get Medias
	*
	* @user_id : int
	* @limit : int
	* @after_cursor : string
	* @return array 	
	*
	**/
    public function getMedias($user_id, $limit = 40, $after_cursor = ''){


		$_request = $this->request('/api/v1/medias')
				            ->addParam('user_id', $user_id)
				            ->addParam('limit', $limit)
				            ->addParam('after_cursor', $after_cursor)
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
	* 
	* Get Media by Shortcode
	*
	* @user_id : int
	* @return array 	
	*
	**/
    public function getMediaByCode($code){


		$_request = $this->request('/api/v1/media_code')
				            ->addParam('code', $code)
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
	* 
	* Get Media by URL
	*
	* @url : string
	* @return array 	
	*
	**/
    public function getMediaByUrl($url){


		$_request = $this->request('/api/v1/media_url')
				            ->addParam('url', urlencode($url))
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
	* 
	* Get Medias by Hashtag
	*
	* @tag : string
	* @return array 	
	*
	**/
    public function getMediaByHashtag($tag){


		$_request = $this->request('/api/v1/hashtag_medias')
				            ->addParam('query', urlencode($tag))
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
	* 
	* Get Medias by Hashtag
	*
	* @tag : string
	* @return array 	
	*
	**/
    public function getMediaByLocation($tag){


		$_request = $this->request('/api/v1/location_medias')
				            ->addParam('query', urlencode($tag))
				            ->getResponse();


		if($_request['code'] != 200) throw new Exception('Wrong response code.');
		if($_request['body']['status'] != 'ok') throw new Exception($_request['body']['message']);


		return $_request['body'];
		
	}


	/**
     *
     * Default Header
     *
     * @param string $url
     *
     * @return array
     */
	public function defaultHeader(){

		return [
			'x-rapidapi-host' => RAPID_HOST,
			'x-rapidapi-key' => $this->rapidapi_key,
		];



	}




	/**
     *
     * Used internally, but can also be used by end-users if they want
     * to create completely custom API queries without modifying this library.
     *
     * @param string $url
     *
     * @return array
     */
    public function request(
        $url)
    {
        return new Request($this, $url);
    }
}
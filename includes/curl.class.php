<?php

/**
 * Simple Curl Based Http Client Library
 */

class CurlHttp
{
	protected $ch;
	protected $UserAgent = 'PHP Curl';
	protected $ReturnTransfer = TRUE;
	
	public function __construct()
	{
		$isCurlInstalled = array_search('curl',get_loaded_extensions());

		if($isCurlInstalled===FALSE)
		{
			throw new Exception("Module Curl is Not Installed.");
		}

		$this->ch = curl_init();
		curl_setopt($this->ch,CURLOPT_USERAGENT,$this->UserAgent);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,$this->ReturnTransfer);
	}

	public function __destruct()
	{
    	curl_close($this->ch);
  	}

  	private function setUrl(string $url)
  	{
  		curl_setopt($this->ch,CURLOPT_URL,$url);
  	}

    public function setTimeout(int $seconds)
    {
        curl_setopt($ch,CURLOPT_TIMEOUT,$seconds);
    }

    public function setHeaders(array $headers)
    {
        curl_setopt($this->ch,CURLOPT_HTTPHEADER,$headers);
    }

  	public function getError()
  	{
  		return ['code'=>curl_errno($this->ch),'msg'=>curl_error($this->ch)];
  	}

  	public function getStatusCode()
  	{
  		return curl_getinfo($this->ch,CURLINFO_HTTP_CODE);
  	}


    /*** request methods ***/

  	public function get(string $url)
  	{
  		$this->setUrl($url);
  		return curl_exec($this->ch);
  	}

    public function post(string $url, array $params=[])
    {
        $this->setUrl($url);
        curl_setopt($this->ch,CURLOPT_POST,TRUE);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS,$params);
        return curl_exec($this->ch);
    }

}

?>


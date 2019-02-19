<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
        // Data API
		$this->api_url 	= "http://localhost/rest-api/api/mahasiswa"; // URL API
		$this->api_key 	= "rest1234"; // Api Key
		$this->api_auth = "admin:admin"; // Autentikasi
	}

    // Ambil Data
    public function getAllData($limit, $offset = NULL)
	{
        $curl = curl_init();
		if ($offset === NULL || $offset == 0) {
			// Jika offset NULL atau 0
			curl_setopt_array($curl, array(
				CURLOPT_URL => $this->api_url."?limit=".$limit,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_USERPWD => $this->api_auth,
				CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json",
					"Cache-Control: no-cache",
					"key: ".$this->api_key
				),
			));
		} else {
			// Jika offset tidak NULL atau 0
			curl_setopt_array($curl, array(
				CURLOPT_URL => $this->api_url."?limit=".$limit."&offset=".$offset,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_USERPWD => $this->api_auth,
				CURLOPT_HTTPHEADER => array(
					"Content-Type: application/json",
					"Cache-Control: no-cache",
					"key: ".$this->api_key
				),
			));
		}
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	// Ambil Data Berdasarkan ID
	public function getData($id)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->api_url."?id=".$id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_USERPWD => $this->api_auth,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Cache-Control: no-cache",
				"key: ".$this->api_key
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

    // Menambahkan Data
	public function post($data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->api_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => http_build_query($data),
			CURLOPT_USERPWD => $this->api_auth,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
				"cache-control: no-cache",
				"key: ".$this->api_key
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

    // Memperbarui Data
	public function put($data)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->api_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "PUT",
			CURLOPT_POSTFIELDS => http_build_query($data),
			CURLOPT_USERPWD => $this->api_auth,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
				"cache-control: no-cache",
				"key: ".$this->api_key
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
    }
    
    // Menghapus Data
	public function delete($id)
	{
		$data = array('id' => $id);
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->api_url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_POSTFIELDS => http_build_query($data),
			CURLOPT_USERPWD => $this->api_auth,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
				"cache-control: no-cache",
				"key: ".$this->api_key
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
}
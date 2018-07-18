<?php

class GoogleSpreadsheetsApi
{
	public function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {	
		$url = 'https://docs.google.com/spreadsheets/d/1S1qhDHwoUsDjmWhTQ9wZV8uotk2FVO1EuBpqIa3uwlw/edit?ts=5b4dbab9';			
		
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
		$ch = curl_init();		
		curl_setopt($ch, curlopt_url, $url);		
		curl_setopt($ch, curlopt_returntransfer, 1);		
		curl_setopt($ch, curlopt_post, 1);		
		curl_setopt($ch, curlopt_ssl_verifypeer, false);
		curl_setopt($ch, curlopt_postfields, $curlPost);	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,curlinfo_http_code);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to receieve access token');
			
		return $data;
	}

	public function CreateSpreadsheet($spreadsheet_title, $access_token) {
		$curlPost = array('properties' => array('title' => $spreadsheet_title));
		
		$ch = curl_init();		
		curl_setopt($ch, curlopt_url, 'https://docs.google.com/spreadsheets/d/1S1qhDHwoUsDjmWhTQ9wZV8uotk2FVO1EuBpqIa3uwlw/edit?ts=5b4dbab9');		
		curl_setopt($ch, curlopt_returntransfer, 1);		
		curl_setopt($ch, curlopt_post, 1);		
		curl_setopt($ch, curlopt_ssl_verifypeer, false);
		curl_setopt($ch, curlopt_httpheader, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, curlopt_postfields, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,curlinfo_http_code);		
		if($http_code != 200) 
			throw new Exception('Error : Failed to create spreadsheet');

		return array('spreadsheet_id' => $data['spreadsheetId'], 'spreadsheet_url' => $data['spreadsheetUrl']);
	}

	public function UpdateSpreadsheetProperties($spreadsheet_id, $spreadsheet_title, $access_token) {
		$curlPost = array('name' => $spreadsheet_title);
		
		$ch = curl_init();		
		curl_setopt($ch, curlopt_url, 'https://docs.google.com/spreadsheets/d/1S1qhDHwoUsDjmWhTQ9wZV8uotk2FVO1EuBpqIa3uwlw/edit?ts=5b4dbab9' . $spreadsheet_id);		
		curl_setopt($ch, curlopt_returntransfer, 1);		
		curl_setopt($ch, curlopt_customrequest, 'PATCH');	
		curl_setopt($ch, curlopt_ssl_verifypeer, false);
		curl_setopt($ch, curlopt_httpheader, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));	
		curl_setopt($ch, curlopt_postfields, json_encode($curlPost));	
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,curlinfo_http_code);
		if($http_code != 200) 
			throw new Exception('Error : Failed to update spreadsheet properties');
	}

	public function DeleteSpreadsheet($spreadsheet_id, $access_token) {
		$ch = curl_init();		
		curl_setopt($ch, curlopt_url, 'https://docs.google.com/spreadsheets/d/1S1qhDHwoUsDjmWhTQ9wZV8uotk2FVO1EuBpqIa3uwlw/edit?ts=5b4dbab9' . $spreadsheet_id);		
		curl_setopt($ch, curlopt_returntransfer, 1);		
		curl_setopt($ch, curlopt_customrequest, 'DELETE');		
		curl_setopt($ch, curlopt_ssl_verifypeer, false);
		curl_setopt($ch, curlopt_httpheader, array('Authorization: Bearer '. $access_token, 'Content-Type: application/json'));		
		$data = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch,curlinfo_http_code);
		if($http_code != 204) 
			throw new Exception('Error : Failed to delete spreadsheet');
	}
}

?>
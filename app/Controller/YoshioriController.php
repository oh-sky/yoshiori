<?php
App::uses('AppController', 'Controller');

class YoshioriController extends AppController {

	public function index() {

		$message = '';
		$lang = 'ja';

		if(
			isset($this->request->query['q'])
			&& preg_match('/love/',$this->request->query['q'])
		){
			//英語対応
			$lang = 'en';
			$message = 'I love you.';
		}
		else if(
			isset($this->request->query['q'])
			&& preg_match('/((好|す)き|愛してる)[\?？]?/u',$this->request->query['q'])
		){
			//レスポンスのデフォルトは日本語

			//レスポンスにランダム性を持たせる
			$message_ary = array(
				'好きだよ。',
				'愛してる。',
			);
			$message = $message_ary[mt_rand(0,count($message_ary)-1)];
		}
		else{
			$message = 'ん？';
		}

    $response = array(
			'lang'=>$lang,
			'message'=>$message,
    );

		//jsonで返す
		$this->set('response',$response);
		$this->viewClass = 'Json';
		$this->set('_serialize','response');
	}
}

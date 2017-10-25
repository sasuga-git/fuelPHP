<?php

class Controller_Status extends Controller
{

	public function action_index()
	{
		//Statusモデルから結果を取得する
		$result = Model_Status::find_body_by_username('foo');

		//$resultをダンプして確認する
		Debug::dump($result);
	}

}

<?php

class Controller_ViewSample3 extends Controller
{

	public function action_index()
	{
		//Viewオブジェクトを生成する
		$view = View::forge('viewsample');

		//Viewに変数をセットする
		$view->set('title', 'ビューのサンプル3');
		$view->set('username', '<del>Azunyan</del>Azusa', false);

		//Viewオブジェクトを返す
		return $view;
	}

}

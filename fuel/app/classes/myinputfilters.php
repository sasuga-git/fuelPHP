<?php

class MyInputFilters
{

	/**
	 * 文字エンコーディングの検証フィルタ
	 * 
	 * @param string|array $value
	 * @return string|array
	 * @throws HttpInvalidInputException
	 */
	public static function check_encoding($value)
	{
		//配列の場合は佐伯的に処理
		if (is_array($value))
		{
			array_map(array('MyInputFilters', 'check_encoding'), $value);
			return $value;
		}

		//文字エンコーディングを検証
		if (mb_check_encoding($value, Fuel::$encoding))
		{
			return $value;
		} else
		{
			//エラーの場合はログを残す
			static::log_error('Invalid control encoding', $value);
			//エラーを表示して終了
			throw new HttpInvalidInputException('Invalid input data');
		}
	}

	/**
	 * 改行コードとタブを除く制御文字が含まれていないかの検証フィルタ
	 * 
	 * @param string|array
	 * @return string|array
	 * @throws HttpInvalidInputException
	 */
	public static function check_control($value)
	{
		//配列の場合は再帰的に処理
		if (is_array($value))
		{
			array_map(array('MyInputFilters', 'check_control'), $value);
			return $value;
		}

		//改行コードとタブを除く制御文字が含まれていないか
		if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $value) === 1)
		{
			return $value;
		} else
		{
			//含まれている場合はログに記録
			static::log_error('Invalid control characters', $value);
			//エラーを表示して終了
			throw new HttpInvalidInputException('Invalid input data');
		}
	}

	//エラーをログに記録
	public static function log_error($msg, $value)
	{
		Log::error($msg . ':' . Input::uri() . ' ' . rawurldecode($value) . ' ' . Input::ip() . '"' . Input::user_agent() . '"');
	}

}

<?php

namespace Kit\Core;

final class Output
{
	private static $startObLevel = false;
	private static $content = '';

	public static function run()
    {
		self::$startObLevel = ob_get_level();

		ob_start();
	}

	public static function get()
    {
		if(ob_get_level() > self::$startObLevel){
			self::$content .= ob_get_contents();

			ob_clean();
		}

		return self::$content;
	}

	public static function clean()
    {
		if(ob_get_level() > self::$startObLevel)
			ob_clean();

		self::$content = '';

		return true;
	}

	public static function end()
    {
		while(self::$startObLevel < ob_get_level()){
			self::get();
			ob_end_clean();
		}
	}

	public static function flush()
    {
		echo self::$content;

		return true;
	}
}

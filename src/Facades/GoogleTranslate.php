<?php

namespace Akib\Translate\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleTranslate extends Facade {
	protected static function getFacadeAccessor(){
		return 'akib-translate';
	}
}
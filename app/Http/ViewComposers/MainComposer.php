<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class MainComposer
{
	public function compose(View $view)
	{
		$view->with('current_series', resolve('ValidYearParser')->getPreviousOrPresentValidYears(true));
		$view->with('start_month', resolve('ValidYearParser')->startMonthToName());
	}
}

?>
<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
	/**
	 * Create a new component instance.
	 */
	public function __construct(
		public string $name,
		public string $prefix = 'fa-solid'
	)
	{
		$this->name = $name;
		$this->prefix = $prefix;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.icon');
	}
}

<?php

namespace App\Domain;

abstract class DoctrineModel
{
	protected function describe($item)
	{
		return is_null($item) ? [] : $item->getAsArray();
	}
}

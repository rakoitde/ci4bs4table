<?php

namespace Rakoitde\Ci4bs4table\Exceptions;

use CodeIgniter\Exceptions\FrameworkException;

/**
 * Table Exceptions.
 */

class TableException extends FrameworkException
{
	public static function forNoModel(string $modelName = "")
	{
		return new static("there is no valid model");
	}
	public static function forWrongModelType()
	{
		return new static("the model must be of the string or object type");
	}
}

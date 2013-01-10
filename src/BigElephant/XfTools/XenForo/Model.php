<?php namespace BigElephant\XfTools\XenForo;

use XenForo_DataWriter;
use XenForo_Model;
use XenForo_Application;

abstract class Model {

	protected function getDw($dw)
	{
		if (strpos($dw, '_') === false)
		{
			$dw = 'XenForo_DataWriter_'.$dw;
		}

		return XenForo_DataWriter::create($dw);
	}

	protected function getXfModel($model)
	{
		if (strpos($model, '_') === false)
		{
			$model = 'XenForo_Model_'.$model;
		}

		return XenForo_Model::create($model);
	}

	protected function getConfig()
	{
		return XenForo_Application::getConfig();
	}
}
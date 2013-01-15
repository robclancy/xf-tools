<?php namespace BigElephant\XfTools;

use BigElephant\XfConsole\CommanderInterface;
use BigElephant\XfConsole\Application as ConsoleApp;

class ToolsCommander implements CommanderInterface {

	public function build(ConsoleApp $consoleApp)
	{
		$consoleApp->resolve('BigElephant\XfTools\Console\PhraseCommand');
	}
}
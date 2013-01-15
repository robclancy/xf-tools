<?php

use Mockery as m;
use BigElephant\XfTools\Console\PhraseCommand;

class PhraseCommandTest extends PHPUnit_Framework_TestCase {

	public function setUp()
	{
		
	}

	public function tearDown()
	{
		m::close();
	}

	public function testNoArgumentsInsert()
	{
		$command = new PhraseCommand($phrase = m::mock('BigElephant\XfTools\XenForo\Phrase'));
		$command->setHelperSet($helperSet = m::mock('Symfony\Component\Console\Helper\HelperSet'));

		$dialogHelper = m::mock('Symfony\Component\Console\Helper\DialogHelper');
		$helperSet->shouldReceive('get')->times(3)->andReturn($dialogHelper);

		$dialogHelper->shouldReceive('ask')->once()->andReturn('test_title');
		$dialogHelper->shouldReceive('ask')->once()->andReturn('test_text');
		$dialogHelper->shouldReceive('ask')->once()->andReturn('');

		$phrase->shouldReceive('insert')->once()->with('test_title', 'test_text', 0, '');

		$this->runCommand($command);
	}

	public function testOneArgumentInsert()
	{
		$command = new PhraseCommand($phrase = m::mock('BigElephant\XfTools\XenForo\Phrase'));
		$command->setHelperSet($helperSet = m::mock('Symfony\Component\Console\Helper\HelperSet'));

		$dialogHelper = m::mock('Symfony\Component\Console\Helper\DialogHelper');
		$helperSet->shouldReceive('get')->times(2)->andReturn($dialogHelper);

		$dialogHelper->shouldReceive('ask')->once()->andReturn('test_text');
		$dialogHelper->shouldReceive('ask')->once()->andReturn('y');

		$phrase->shouldReceive('insert')->once()->with('test_title', 'test_text', 1, '');

		$this->runCommand($command, array('title' => 'test_title'));
	}

	public function testTwoArgumentsInsert()
	{
		$command = new PhraseCommand($phrase = m::mock('BigElephant\XfTools\XenForo\Phrase'));
		$command->setHelperSet($helperSet = m::mock('Symfony\Component\Console\Helper\HelperSet'));

		$dialogHelper = m::mock('Symfony\Component\Console\Helper\DialogHelper');
		$helperSet->shouldReceive('get')->once()->andReturn($dialogHelper);

		$dialogHelper->shouldReceive('ask')->once()->andReturn('y');

		$phrase->shouldReceive('insert')->once()->with('test_title', 'test_text', 1, '');

		$this->runCommand($command, array('title' => 'test_title', 'text' => 'test_text'));
	}

	protected function runCommand($command, $input = array())
	{
		return $command->run(new Symfony\Component\Console\Input\ArrayInput($input), new Symfony\Component\Console\Output\NullOutput);
	}
}

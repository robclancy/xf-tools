<?php namespace BigElephant\XfTools\XenForo;

class Phrase extends Model {

	public function insert($title, $text, $global = false, $addonId = false)
	{
		if ($this->xfPhraseModel()->getPhraseInLanguageByTitle($title))
		{
			throw new \Exception('Failed, phrase already exists');
		}

		if ( ! $addonId AND $this->getConfig()->development->default_addon)
		{
			$addonId = $this->getConfig()->development->default_addon;
		}

		$dw = $this->getDw('Phrase');
		$dw->set('language_id', 0);
		$dw->set('title', $title);
		$dw->set('phrase_text', $text);
		$dw->set('global_cache', (int) $global);
		$dw->set('addon_id', $addonId);
		$dw->save();

		return 'Phrase inserted!';
	}

	protected function xfPhraseModel()
	{
		return $this->getXfModel('Phrase');
	}
}
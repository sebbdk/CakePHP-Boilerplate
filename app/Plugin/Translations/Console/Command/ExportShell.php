<?php
App::uses('AppShell', 'Console/Command');
App::uses('Translation', 'Translations.Model');

/**
 * ExportShell
 */
class ExportShell extends AppShell {

/**
 * _settings
 *
 * @var array
 */
	protected $_settings = array(
		'domain' => 'default',
		'locale' => 'en',
		'category' => 'LC_MESSAGES'
	);

/**
 * Gets the option parser instance and configures it.
 * By overriding this method you can configure the ConsoleOptionParser before returning it.
 *
 * @return ConsoleOptionParser
 * @link http://book.cakephp.org/2.0/en/console-and-shells.html#Shell::getOptionParser
 */
	public function getOptionParser() {
		$this->_settings = Translation::config();
		$parser = parent::getOptionParser();
		return $parser
			->addArgument('file', array(
				'help' => 'relative or abs path to translations file',
				'required' => true
			))
			->addOption('locale', array(
				'help' => 'the locale to export, defaults to "en"'
			))
			->addOption('domain', array(
				'help' => 'the domain to export, defaults to "default"'
			))
			->addOption('category', array(
				'help' => 'the category to export, defaults to "LC_MESSAGES"'
			));
	}

/**
 * Export translations to the specified path
 * Currently supports:
 * 	json
 *
 * @throws \Exception if the file specified is not writable
 */
	public function main() {
		$file = $this->args[0];
		foreach ($this->params as $key => $val) {
			$this->_settings[$key] = $val;
		}

		$return = Translation::export($file, $this->_settings);

		if ($return['success']) {
			$this->out(sprintf('Wrote %d translations', $return['count']));
		} else {
			$this->out(sprintf('Error creating %s', $file));
		}
		$this->out('Done');
	}
}

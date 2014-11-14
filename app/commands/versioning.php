<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Versioning extends Command {

	/**
	 * Big thanks to afarazit.
	 * http://afaraz.it/post/laravel-4-versioning-your-app-using-git
	 */

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'versioning:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate and update app\'s version via git.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
        // Path to the file containing your version
        // This will be overwritten everything you commit a message
        $versionFile = app_path().'/config/version.php';

        // The git's output
        $version = $this->argument('version');

        // Here we save the version array in a variable
        $array = var_export(['tag' => $version], true);

        // Construct our file content
        $content = '<?php' . PHP_EOL . PHP_EOL . 'return ' . $array . ";";

        // And finally write the file and output the current version
        \File::put($versionFile, $content);
        $this->line('Setting version: '. \Config::get('version.tag'));
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
			return [
      	['version', InputArgument::REQUIRED, 'version number is required.'],
      ];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}

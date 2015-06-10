<?
/**
 * Provides rendering capabilities.
 **/
class View
{

	/**
	 * Renders the specified template.
	 **/
	public function make($path, $vars = null)
	{
		$file = 'views/'.$path.'.php';

		if (!file_exists($file)) {
			throw new InvalidArgumentException('The $path argument points to a non-existent template: "'.$path.'".');
		}

		if (!empty($vars)) {
			extract($vars);
		}

		include $file;
	}

}

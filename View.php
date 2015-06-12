<?
/**
 * Provides rendering capabilities.
 */
class View
{

	/**
	 * Renders the specified template.
	 *
	 * @param string $path Name of the template.
	 * @param array $vars Variables to expose.
	 *
	 * @throws Exception The $path argument points to a non-existent template.
	 */
	public function make($path, $vars = null)
	{
		$file = 'views/'.$path.'.php';

		if (!file_exists($file)) {
			throw new Exception('The $path argument points to a non-existent template: "'.$path.'".');
		}

		if (!empty($vars)) {
			extract($vars);
		}

		include $file;
	}

}
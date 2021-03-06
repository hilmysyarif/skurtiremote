<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Creativearts - by Creativelab
 *
 * @package		Creativearts
 * @author		Creativearts Dev Team
 * @copyright	Copyright (c) 2003 - 2014, Creativelab, Inc.
 * @license		http://Creativearts.com/user_guide/license.html
 * @link		http://Creativearts.com
 * @since		Version 2.7
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Markdown Plugin
 *
 * @package			Creativearts
 * @category		Plugin
 * @author			Creativelab Dev Team
 * @copyright		Copyright (c) 2004 - 2014, Creativelab, Inc.
 * @link			http://creativelab.com
 */

$plugin_info = array(
	'pi_name'        => 'Markdown',
	'pi_version'     => '1.0',
	'pi_author'      => 'Creativelab',
	'pi_author_url'  => 'http://creativelab.com/',
	'pi_description' => 'Parse text using Markdown and Smartypants',
	'pi_usage'       => Markdown::usage()
);


class Markdown {

	public $return_data;

	public function __construct($tagdata = '')
	{
		$tagdata       = (empty($tagdata)) ? ee()->TMPL->tagdata : $tagdata;
		$smartypants   = ee()->TMPL->fetch_param('smartypants', 'yes');
		$convert_curly = ee()->TMPL->fetch_param('convert_curly', 'yes');

		ee()->load->library('typography');
		ee()->typography->convert_curly = get_bool_from_string($convert_curly);
		$this->return_data = ee()->typography->markdown(
			$tagdata,
			compact('smartypants')
		);

		return $this->return_data;
	}

	// -------------------------------------------------------------------------

	/**
	 * Plugin Usage
	 *
	 * @return string Usage documentation
	 */
	public static function usage()
	{
		ob_start();
?>

This plugin parses text using Markdown and Smartypants. To use this plugin wrap
any text in this tag pair:

{exp:markdown}
Text to be **parsed**.
{/exp:markdown}

There are two parameters you can set:

- convert_curly - ('yes'/'no') defaults to 'yes', when set to 'no' will not
  convert all curly brackets to entities, which can be useful to display
  variables
- smartypants - ('yes'/'no') defaults to 'yes', when set to 'no' stops
  SmartyPants from running which leaves your quotes and hyphens alone

<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.markdown.php */
/* Location: /system/creativearts/third_party/markdown/pi.markdown.php */

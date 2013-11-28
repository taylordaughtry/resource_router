<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_routes
{
	public function __call($name, $args)
	{
		$data = ee()->session->cache('template_routes', $name);

		if ( ! $data)
		{
			return ee()->TMPL->no_results();
		}

		if (is_array($data))
		{
			if ( ! $data)
			{
				return ee()->TMPL->no_results();
			}

			$method = 'parse_variables';

			//is it associative?
			foreach (array_keys($data) as $key => $val)
			{
				if ($key !== $val)
				{
					$method = 'parse_variables_row';
					break;
				}
			}

			return ee()->TMPL->$method(ee()->TMPL->tagdata, $data);
		}

		return $data;
	}
}
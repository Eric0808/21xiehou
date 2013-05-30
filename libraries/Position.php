<?php

final class Position
{
	
	function __construct()
	{
		
	}
	
	function data($model_name, $posid, $isthumb = 0, $num = 0, $cachetime = 0, $where = '', $order='ORDER BY listorder ASC,id DESC')
	{
		$CI =& get_instance();
		switch($model_name)
		{
			case 'member':
				$CI->load->model('userpos_model', 'member');
				$data = $CI->member->get_pos_data($posid, $isthumb, $num, $cachetime, $where, $order);
				return $data;
			case 'news':
				$CI->load->model('newspos_model', 'news');
				$data = $CI->news->get_pos_data($posid, $isthumb, $num, $cachetime, $where, $order);
				return $data;
			case 'teacher':
				$CI->load->model('teacherpos_model', 'teacher');
				$data = $CI->teacher->get_pos_data($posid, $isthumb, $num, $cachetime, $where, $order);
				return $data;
			default:
				return null;
			
		}
	}

}
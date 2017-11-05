<?php
/**
 * https://neofr.ag
 * @author: Michaël BILCOT <michael.bilcot@neofr.ag>
 */

$rules = [
	'title' => [
		'label'       => '{lang game_title}',
		'value'       => $this->form->value('title'),
		'type'        => 'text',
		'rules'       => 'required'
	],
	'parent_id' => [
		'label'       => '{lang parent_game}',
		'value'       => $this->form->value('parent_id'),
		'values'      => $this->form->value('games'),
		'type'        => 'select'
	],
	'image' => [
		'label'       => '{lang banner}',
		'value'       => $this->form->value('image_id'),
		'upload'      => 'games',
		'type'        => 'file',
		'info'        => $this->lang('file_picture', file_upload_max_size() / 1024 / 1024),
		'check'       => function($filename, $ext){
			if (!in_array($ext, ['gif', 'jpeg', 'jpg', 'png']))
			{
				return $this->lang('select_image_file');
			}
		}
	],
	'icon' => [
		'label'       => '{lang icon}',
		'value'       => $this->form->value('icon_id'),
		'upload'      => 'games/icons',
		'type'        => 'file',
		'info'        => $this->lang('file_icon', 16, file_upload_max_size() / 1024 / 1024),
		'check'       => function($filename, $ext){
			if (!in_array($ext, ['gif', 'jpeg', 'jpg', 'png']))
			{
				return $this->lang('select_image_file');
			}

			list($w, $h) = getimagesize($filename);

			if ($w != $h)
			{
				return $this->lang('icon_must_be_square');
			}
			else if ($w < 16)
			{
				return $this->lang('icon_size_error', 16);
			}
		},
		'post_upload' => function($filename){
			image_resize($filename, 16, 16);
		}
	]
];

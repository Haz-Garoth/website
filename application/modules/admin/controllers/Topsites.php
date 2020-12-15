<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2020, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsites extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (! $this->website->isLogged())
		{
			redirect(site_url('login'));
		}

		if (! $this->auth->is_admin())
		{
			redirect(site_url('user'));
		}

		if ($this->auth->is_banned())
		{
			redirect(site_url('user'));
		}

		$this->load->model('topsites_model');

		$this->template->set_theme();
		$this->template->set_layout('admin_layout');
		$this->template->set_partial('alerts', 'static/alerts');
	}

	public function index()
	{
		$get  = $this->input->get('page', TRUE);
		$page = ctype_digit((string) $get) ? $get : 0;

		$config = [
			'base_url'    => site_url('admin/topsites'),
			'total_rows'  => $this->topsites_model->count_all(),
			'per_page'    => 25,
			'uri_segment' => 3
		];

		$this->pagination->initialize($config);

		// Calculate offset if use_page_numbers is TRUE on pagination
		$offset = ($page > 1) ? ($page - 1) * $config['per_page'] : $page;

		$data = [
			'topsites' => $this->topsites_model->get_all($config['per_page'], $offset),
			'links'    => $this->pagination->create_links()
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		$this->template->build('topsites/index', $data);
	}

	public function create()
	{
		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');
			$this->form_validation->set_rules('time', 'Time', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('points', 'Points', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('image', 'Image', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('topsites/create');
			}
			else
			{
				$this->db->insert('topsites', [
					'name'   => $this->input->post('name'),
					'url'    => $this->input->post('url', TRUE),
					'time'   => $this->input->post('time'),
					'points' => $this->input->post('points'),
					'image'  => $this->input->post('image', TRUE)
				]);

				$this->session->set_flashdata('success', lang('alert_topsite_created'));
				redirect(site_url('admin/topsites/create'));
			}
		}
		else
		{
			$this->template->build('topsites/create');
		}
	}

	public function edit($id = null)
	{
		if (empty($id) || ! $this->topsites_model->find_id($id))
		{
			show_404();
		}

		$data = [
			'topsite' => $this->topsites_model->get($id)
		];

		$this->template->title(config_item('app_name'), lang('admin_panel'));

		if ($this->input->method() == 'post')
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('url', 'Url', 'trim|required|valid_url');
			$this->form_validation->set_rules('time', 'Time', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('points', 'Points', 'trim|required|is_natural_no_zero');
			$this->form_validation->set_rules('image', 'Image', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->template->build('topsites/edit', $data);
			}
			else
			{
				$this->db->where('id', $id)->update('topsites', [
					'name'   => $this->input->post('name'),
					'url'    => $this->input->post('url', TRUE),
					'time'   => $this->input->post('time'),
					'points' => $this->input->post('points'),
					'image'  => $this->input->post('image', TRUE)
				]);

				$this->session->set_flashdata('success', lang('alert_topsite_updated'));
				redirect(site_url('admin/topsites/edit/'.$id));
			}
		}
		else
		{
			$this->template->build('topsites/edit', $data);
		}
	}

	public function delete($id = null)
	{
		if (empty($id) || ! $this->topsites_model->find_id($id))
		{
			show_404();
		}

		$this->db->where('id', $id)->delete('topsites');

		$this->session->set_flashdata('success', lang('alert_topsite_deleted'));
		redirect(site_url('admin/topsites'));
	}
}
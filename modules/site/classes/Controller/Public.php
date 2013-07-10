<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public extends Controller_Site
{
	protected $_section = 'public';
	protected $_controller;
	protected $_method;

	public function before()
	{
		parent::before();
		$this->_modal = true;
	}

	public function lead_form($full = false)
	{
		$complete = false;
		$user = new \Tenchi\Model\Lead;
		$lead_form = $user->get_lead_form()
			->add('submit', 'submit', array('text' => __('Send Inquiry!')));

		$lead_form->campaign_id->set('value', $this->_campaign);

		if($lead_form->load()->validate())
		{
			$complete = true;

			if($lead_form->campaign_id->val())
			{
				$this->_campaign = $lead_form->campaign_id->val();
			}
			$campaign = \Kacela::find_one('campaign', \Kacela::criteria()->equals('id', $this->_campaign));
			$this->_lead_download = $campaign->download_link;
		}

		return \View::factory('lead_form', array('language' => true))
			->bind('form', $lead_form)
			->set('lead_download', $this->_lead_download)
			->set('complete', $complete)
			->set('full', $full);
	}
}
<?php
require_once(substr_replace(DIR_SYSTEM, '', -7) . 'vendor/equotix/enets_credit/equotix.php');
class ControllerPaymentEnetsCredit extends Equotix {
	protected $version = '1.0.2';
	protected $code = 'enets_credit';
	protected $folder = 'payment';
	protected $extension = 'eNETS';
	protected $extension_id = '17';
	protected $purchase_url = 'enets';
	protected $purchase_id = '22837';
	protected $error = array();

	public function index() {
		$this->load->language('payment/enets_credit');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('enets_credit', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['tab_general'] = $this->language->get('tab_general');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['entry_test_url'] = $this->language->get('entry_test_url');
		$data['entry_live_url'] = $this->language->get('entry_live_url');
		$data['entry_test_mid'] = $this->language->get('entry_test_mid');
		$data['entry_live_mid'] = $this->language->get('entry_live_mid');
		$data['entry_test_mode'] = $this->language->get('entry_test_mode');
		$data['entry_default_currency'] = $this->language->get('entry_default_currency');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/enets_credit', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/enets_credit', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['enets_credit_test_url'])) {
            $data['enets_credit_test_url'] = $this->request->post['enets_credit_test_url'];
        } elseif ($this->config->get('enets_credit_test_url')) {
			$data['enets_credit_test_url'] = $this->config->get('enets_credit_test_url');
		} else {
			$data['enets_credit_test_url'] = 'https://test.enets.sg/enets2/enps.do';
		}

        if (isset($this->request->post['enets_credit_live_url'])) {
            $data['enets_credit_live_url'] = $this->request->post['enets_credit_live_url'];
        } elseif ($this->config->get('enets_credit_live_url')) {
			$data['enets_credit_live_url'] = $this->config->get('enets_credit_live_url');
		} else {
			$data['enets_credit_live_url'] = 'https://www.enets.sg/enets2/enps.do';
		}

        if (isset($this->request->post['enets_credit_test_mid'])) {
            $data['enets_credit_test_mid'] = $this->request->post['enets_credit_test_mid'];
        } else {
            $data['enets_credit_test_mid'] = $this->config->get('enets_credit_test_mid');
        }

        if (isset($this->request->post['enets_credit_live_mid'])) {
            $data['enets_credit_live_mid'] = $this->request->post['enets_credit_live_mid'];
        } else {
            $data['enets_credit_live_mid'] = $this->config->get('enets_credit_live_mid');
        }

        if (isset($this->request->post['enets_credit_test_mode'])) {
            $data['enets_credit_test_mode'] = $this->request->post['enets_credit_test_mode'];
        } elseif ($this->config->get('enets_credit_test_mode')) {
			$data['enets_credit_test_mode'] = $this->config->get('enets_credit_test_mode');
		} else {
			$data['enets_credit_test_mode'] = false;
		}
		
		$this->load->model('localisation/currency');
		
        $data['currencies'] = $this->model_localisation_currency->getCurrencies();

        if (isset($this->request->post['enets_credit_default_currency'])) {
            $data['enets_credit_default_currency'] = $this->request->post['enets_credit_default_currency'];
        } elseif ($this->config->get('enets_credit_default_currency')) {
            $data['enets_credit_default_currency'] = $this->config->get('enets_credit_default_currency');
        } else {
			$data['enets_credit_default_currency'] = $this->config->get('config_currency');
		}
		
		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['enets_credit_geo_zone_id'])) {
			$data['enets_credit_geo_zone_id'] = $this->request->post['enets_credit_geo_zone_id'];
		} else {
			$data['enets_credit_geo_zone_id'] = $this->config->get('enets_credit_geo_zone_id'); 
		}

		if (isset($this->request->post['enets_credit_total'])) {
			$data['enets_credit_total'] = $this->request->post['enets_credit_total'];
		} elseif ($this->config->get('enets_credit_total')) {
			$data['enets_credit_total'] = $this->config->get('enets_credit_total');
		} else {
			$data['enets_credit_total'] = '0.10';
		}

		if (isset($this->request->post['enets_credit_order_status_id'])) {
			$data['enets_credit_order_status_id'] = $this->request->post['enets_credit_order_status_id'];
		} else {
			$data['enets_credit_order_status_id'] = $this->config->get('enets_credit_order_status_id');
		} 

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['enets_credit_status'])) {
			$data['enets_credit_status'] = $this->request->post['enets_credit_status'];
		} else {
			$data['enets_credit_status'] = $this->config->get('enets_credit_status');
		}

		if (isset($this->request->post['enets_credit_sort_order'])) {
			$data['enets_credit_sort_order'] = $this->request->post['enets_credit_sort_order'];
		} else {
			$data['enets_credit_sort_order'] = $this->config->get('enets_credit_sort_order');
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->generateOutput('payment/enets_credit.tpl', $data);
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/enets_credit') || !$this->validated()) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}
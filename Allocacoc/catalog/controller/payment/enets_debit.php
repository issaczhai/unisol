<?php
require_once(substr_replace(DIR_SYSTEM, '', -7) . 'vendor/equotix/enets_debit/equotix.php');
class ControllerPaymentEnetsDebit extends Equotix {
	protected $code = 'enets_debit';
	protected $extension_id = '17';
	
    public function index() {
        $this->language->load('payment/enets_debit');

        $data['button_confirm'] = $this->language->get('button_confirm');
		
        $default_currency = $this->config->get('enets_default_currency_d');
		
        if (!$this->config->get('enets_debit_test_mode')) {
            $data['merchant_id'] = $this->config->get('enets_debit_live_mid');
        } else {
            $data['merchant_id'] = $this->config->get('enets_debit_test_mid');
        }
		
        $data['umapi_type'] = 'lite';

        if (!$this->config->get('enets_debit_test_mode')) {
            $data['action'] = $this->config->get('enets_debit_live_url');
        } else {
            $data['action'] = $this->config->get('enets_debit_test_url');
        }

        $this->load->model('checkout/order');
		
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
        $data['amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
        
		$data['reference_no'] = $this->session->data['order_id'];
		
		if (!$this->validated()) {
			return;
		}

		if (version_compare(VERSION, '2.2.0.0', '<')) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/enets.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/payment/enets.tpl', $data);
			} else {
				return $this->load->view('default/template/payment/enets.tpl', $data);
			}
		} else {
			return $this->load->view('payment/enets', $data);
		}
    }
}
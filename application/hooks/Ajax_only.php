<?php

/**
 * Description of Ajax_only
 *
 * @author Michel
 */
class Ajax_only {

    private $_controllers = array();
    private $CI;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->config->load('ajax_methods');
        $this->_controllers = $this->CI->config->item('ajax_methods');

    }

    public function show_404_on_illegal_ajax() {
        
        $controller = $this->CI->router->fetch_class();
        $method = $this->CI->router->fetch_method();
        if (array_key_exists($controller, $this->_controllers) && $this->CI->input->is_ajax_request() === FALSE) {
            if (( $this->_controllers[$controller] === TRUE || ( is_array($this->_controllers[$controller]) && array_key_exists($method, $this->_controllers[$controller]) && $this->_controllers[$controller][$method] === TRUE ))) {
                show_404();
            }
        }

    }

}

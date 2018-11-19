<?php

namespace Towersystems\Webhook\Configuration;

/**
 *
 */
class Configuration {

	/**
	 * [$config description]
	 * @var array
	 */
	protected $config = [];

	/**
	 * [__construct description]
	 * @param array $config [description]
	 */
	function __construct(array $config) {
		$this->config = $config;
	}

	/**
	 * [getWebhooks description]
	 * @return [type] [description]
	 */
	public function getWebhooks() {
		return isset($this->config["hooks"]) ? $this->config["hooks"] : [];
	}

	/**
	 * [getWebhook description]
	 * @param  [type] $code [description]
	 * @return [type]       [description]
	 */
	public function getWebhook($code) {
		$hooks = $this->getWebhooks();
		return isset($hooks[$code]) ? $hooks[$code] : null;
	}

	/**
	 * [enabled description]
	 * @return [type] [description]
	 */
	public function enabled() {
		return isset($this->config["enabled"]) ? $this->config["enabled"] : false;
	}

	/**
	 * [getProcessors description]
	 * @return [type] [description]
	 */
	public function getProcessors() {
		return isset($this->config["processor"]) ? $this->config["processor"] : [];
	}

}
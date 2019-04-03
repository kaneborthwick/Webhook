<?php

namespace Towersystems\Webhook\Model;

use Towersystems\Resource\Model\AbstractResourceItem;
use Towersystems\Resource\Model\TimestampableTrait;

/**
 * The callback request of a webhook ( 1 per url )
 */
class Callback extends AbstractResourceItem implements CallbackInterface {

	use TimestampableTrait;

	/**
	 * [$payload description]
	 * @var [type]
	 */
	protected $payload;

	/**
	 * [$header description]
	 * @var [type]
	 */
	protected $header = [
		'Content-Type' => 'application/json',
	];

	/**
	 * [$url description]
	 * @var [type]
	 */
	protected $url;

	/**
	 * [$attempts description]
	 * @var integer
	 */
	protected $attempts = 0;

	/**
	 * [$webhook description]
	 * @var [type]
	 */
	protected $webhook;

	/**
	 * [$lastExecuted description]
	 * @var [type]
	 */
	protected $lastExecuted;

	/**
	 * [$status description]
	 * @var [type]
	 */
	protected $status = CallbackInterface::STATE_PENDING;

	/**
	 * [$lastError description]
	 *
	 * @var [type]
	 */
	protected $lastError;

	/**
	 * [__construct description]
	 */
	public function __construct() {
		$this->createdAt = new \DateTime();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getPayload() {
		return $this->payload;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setPayload($payload) {
		$this->payload = $payload;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function addHeader($name, $content) {
		$this->header[$name] = $content;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setUrl($url) {
		$this->url = $url;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAttempts() {
		return $this->attempts;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setAttempts($attempts) {
		$this->attempts = $attempts;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function addAttempt() {
		$this->attempts += 1;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getWebhook() {
		return $this->webhook;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setWebhook($webhook) {
		$this->webhook = $webhook;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLastExecuted() {
		return $this->lastExecuted;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setLastExecuted($lastExecuted) {
		$this->lastExecuted = $lastExecuted;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setStatus($status) {
		$this->status = $status;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLastError() {
		return $this->lastError;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setLastError($lastError) {
		$this->lastError = $lastError;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canExecute() {
		return $this->getStatus() == CallbackInterface::STATE_IN_QUEUE && $this->getAttempts() < CallbackInterface::MAX_ATTEMPTS;
	}
}
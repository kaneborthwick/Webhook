<?php

namespace Towersystems\Webhook\Model;

use Towersystems\Resource\Model\AbstractResourceItem;
use Towersystems\Resource\Model\CodeAwareTrait;
use Towersystems\Resource\Model\TimestampableTrait;
use Towersystems\Resource\Model\ToggleableTrait;

/**
 * Represents the webhook item
 */
class Webhook extends AbstractResourceItem implements WebhookInterface {

	use ToggleableTrait;
	use TimestampableTrait;
	use CodeAwareTrait;

	/**
	 * [__construct description]
	 */
	public function __construct() {
		$this->createdAt = new \DateTime();
	}

	/**
	 * [$urls description]
	 */
	protected $urls = [];

	/**
	 * [$contentType description]
	 */
	protected $contentType;

	/**
	 * [$name description]
	 * @var [type]
	 */
	protected $name;

	/**
	 * [$description description]
	 */
	protected $description;

	/**
	 * {@inheritdoc}
	 */
	public function getUrls() {
		return $this->urls;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setUrls($urls) {
		$this->urls = $urls;
	}

	/**
	 * {@inheritdoc}
	 */
	public function addUrl($url) {
		if (!in_array($url, $this->urls)) {
			$this->urls[] = $url;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeUrl($url) {
		$index = array_search($url, $this->urls);
		if ($index !== false) {
			unset($this->urls[$index]);
			$this->urls = array_values($this->urls);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContentType() {
		return $this->contentType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setContentType($contentType) {
		$this->contentType = $contentType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
}
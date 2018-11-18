<?php

namespace Towersystems\Webhook\Model;

use Towersystems\Resource\Model\CodeAwareInterface;
use Towersystems\Resource\Model\ToggleableInterface;

interface WebhookInterface extends ToggleableInterface, CodeAwareInterface {

	/**
	 * [getUrls description]
	 * @return [type] [description]
	 */
	public function getUrls();

	/**
	 * [setUrls description]
	 * @param [type] $urls [description]
	 */
	public function setUrls($urls);

	/**
	 * [addUrl description]
	 * @param [type] $url [description]
	 */
	public function addUrl($url);

	/**
	 * [removeUrl description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function removeUrl($url);

	/**
	 * [getContentType description]
	 * @return [type] [description]
	 */
	public function getContentType();

	/**
	 * [setContentType description]
	 * @param [type] $contentType [description]
	 */
	public function setContentType($contentType);

	/**
	 * [getName description]
	 * @return [type] [description]
	 */
	public function getName();

	/**
	 * [setName description]
	 * @param [type] $name [description]
	 */
	public function setName($name);

	/**
	 * [getDescription description]
	 * @return [type] [description]
	 */
	public function getDescription();

	/**
	 * [setDescription description]
	 * @param [type] $description [description]
	 */
	public function setDescription($description);

}
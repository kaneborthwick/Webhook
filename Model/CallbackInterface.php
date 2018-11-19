<?php

namespace Towersystems\Webhook\Model;
use Towersystems\Resource\Model\TimestampableInterface;

/**
 * The callback request of a webhook ( 1 per url )
 */
interface CallbackInterface extends TimestampableInterface {

	const STATE_PENDING = 'pending';
	const STATE_IN_QUEUE = 'in_queue';
	const STATE_PROCESSING = 'processing';
	const STATE_COMPLETE = 'complete';
	const STATE_CANCELLED = 'cancelled';
	const STATE_EXPIRED = 'expired';
	const MAX_ATTEMPTS = 10;

	/**
	 * [getPayload description]
	 * @return [type] [description]
	 */
	public function getPayload();

	/**
	 * [setPayload description]
	 * @param [type] $payload [description]
	 */
	public function setPayload($payload);

	/**
	 * [getHeader description]
	 * @return [type] [description]
	 */
	public function getHeader();

	/**
	 * [setHeader description]
	 * @param [type] $header [description]
	 */
	public function setHeader($header);

	/**
	 * [getUrl description]
	 * @return [type] [description]
	 */
	public function getUrl();

	/**
	 * [setUrl description]
	 * @param [type] $url [description]
	 */
	public function setUrl($url);

	/**
	 * [getAttempts description]
	 * @return [type] [description]
	 */
	public function getAttempts();

	/**
	 * [setAttempts description]
	 * @param [type] $attempts [description]
	 */
	public function setAttempts($attempts);

	/**
	 * [addAttempt description]
	 */
	public function addAttempt();

	/**
	 * [getWebhook description]
	 * @return [type] [description]
	 */
	public function getWebhook();

	/**
	 * [setWebhook description]
	 * @param [type] $webhook [description]
	 */
	public function setWebhook($webhook);

	/**
	 * [getLastExecuted description]
	 * @return [type] [description]
	 */
	public function getLastExecuted();

	/**
	 * [setLastExecuted description]
	 * @param [type] $lastExecuted [description]
	 */
	public function setLastExecuted($lastExecuted);

	/**
	 * [getStatus description]
	 * @return [type] [description]
	 */
	public function getStatus();

	/**
	 * [setStatus description]
	 * @param [type] $status [description]
	 */
	public function setStatus($status);

	/**
	 * [canExecute description]
	 * @return [type] [description]
	 */
	public function canExecute();
}
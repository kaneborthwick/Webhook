<?php

namespace Towersystems\Webhook\Manager;

use Towersystems\Webhook\Model\CallbackInterface;

/**
 *
 */
interface CallbackManagerInterface {

	/**
	 * [process description]
	 * @return [type] [description]
	 */
	public function process();

	/**
	 * [addToQueue description]
	 * @param CallbackInterface $callback [description]
	 */
	public function addToQueue(CallbackInterface $callback);

	/**
	 * [removeFromQueue description]
	 * @param  CallbackInterface $callback [description]
	 * @return [type]                      [description]
	 */
	public function removeFromQueue(CallbackInterface $callback);

}
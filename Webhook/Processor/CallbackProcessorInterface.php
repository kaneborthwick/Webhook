<?php

namespace Towersystems\Webhook\Processor;

use Towersystems\Webhook\Model\CallbackInterface;

interface CallbackProcessorInterface {

	/**
	 * [process description]
	 * @param  CallbackInterface $callback [description]
	 * @return [type]                      [description]
	 */
	public function process(CallbackInterface $callback);
}
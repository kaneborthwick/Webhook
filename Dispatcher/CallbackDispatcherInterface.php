<?php

namespace Towersystems\Webhook\Dispatcher;
use Towersystems\Webhook\Model\CallbackInterface;

interface CallbackDispatcherInterface {

	/**
	 * [dispatch description]
	 * @param  CallbackInterface $callback [description]
	 * @return [type]                      [description]
	 */
	public function dispatch(CallbackInterface $callback): bool;

}
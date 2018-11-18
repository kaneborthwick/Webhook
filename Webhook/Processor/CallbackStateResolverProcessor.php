<?php

namespace Towersystems\Webhook\Processor;

use Towersystems\Webhook\Model\CallbackInterface;

/**
 *
 */
class CallbackStateResolverProcessor implements CallbackProcessorInterface {

	/**
	 * {@inheritdoc}
	 */
	public function process(CallbackInterface $callback) {

		// if the callback has exceded the maxium attempts, then cancel it
		if ($callback->getAttempts() == CallbackInterface::MAX_ATTEMPTS) {
			$callback->setStatus(CallbackInterface::STATE_CANCELLED);
		}

		// if the time passed is beyond sensible, cancel the callback
		$now = strtotime("-60 minutes");
		if ($callback->getLastExecuted() && $now > $callback->getLastExecuted()->getTimestamp()) {
			$callback->setStatus(CallbackInterface::STATE_CANCELLED);
		}

	}

}
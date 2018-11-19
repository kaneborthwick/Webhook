<?php

namespace Towersystems\Webhook\Processor;

use Towersystems\Resource\Repository\RepositoryInterface;
use Towersystems\Webhook\Dispatcher\CallbackDispatcherInterface;
use Towersystems\Webhook\Model\CallbackInterface;

/**
 *
 */
class CallbackDispatcherProcessor implements CallbackProcessorInterface {

	/**
	 * [$callbackDispatcher description]
	 * @var [type]
	 */
	protected $callbackDispatcher;

	/**
	 * [$entityManager description]
	 * @var [type]
	 */
	protected $entityManager;

	/**
	 * [__construct description]
	 * @param RepositoryInterface $callbackRepository [description]
	 */
	public function __construct(
		CallbackDispatcherInterface $callbackDispatcher,
		$entityManager
	) {
		$this->callbackDispatcher = $callbackDispatcher;
		$this->entityManager = $entityManager;
	}

	/**
	 * {@inheritdoc}
	 */
	public function process(CallbackInterface $callback) {

		// make sure that another instance hasnt changed the state of a callback
		// or another process has not cancelled the callback
		if ($callback->canExecute() !== true) {
			return;
		}

		// set the call data
		$callback->addAttempt();
		$callback->setLastExecuted(new \DateTime());

		// dispatch the callback
		$result = $this->callbackDispatcher->dispatch($callback);

		if ($result === true) {
			$callback->setStatus(CallbackInterface::STATE_COMPLETE);
		} else {
			$callback->setStatus(CallbackInterface::STATE_IN_QUEUE);
		}

	}

}
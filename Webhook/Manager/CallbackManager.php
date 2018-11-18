<?php

namespace Towersystems\Webhook\Manager;

use Towersystems\Resource\Repository\RepositoryInterface;
use Towersystems\Webhook\Model\CallbackInterface;
use Towersystems\Webhook\Processor\CallbackProcessorInterface;
use Zend\Stdlib\PriorityQueue;

/**
 *
 */
class CallbackManager implements CallbackManagerInterface {

	/**
	 * [$queue description]
	 * @var [type]
	 */
	protected $queue;

	/**
	 * [$callbackRepository description]
	 * @var [type]
	 */
	protected $callbackRepository;

	/**
	 * [$callbackProcessor description]
	 * @var [type]
	 */
	protected $callbackProcessor;

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
		RepositoryInterface $callbackRepository,
		CallbackProcessorInterface $callbackProcessor,
		$entityManager
	) {
		$this->callbackRepository = $callbackRepository;
		$this->callbackProcessor = $callbackProcessor;
		$this->entityManager = $entityManager;
		$this->queue = new PriorityQueue();
	}

	/**
	 * {@inheritdoc}
	 */
	public function process() {
		$this->loadCallbacks();

		foreach ($this->queue as $callback) {
			// this could be changed to end the processor and wait till its completed
			$this->entityManager->refresh($callback);
			$this->callbackProcessor->process($callback);

			if ($callback->getStatus() == CallbackInterface::STATE_COMPLETE) {
				$this->entityManager->remove($callback);
			}

			$this->entityManager->flush();

		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function addToQueue(CallbackInterface $callback) {
		if (!$this->queue->contains($callback)) {
			$callback->setStatus(CallbackInterface::STATE_IN_QUEUE);
			$this->queue->insert($callback);
			$this->entityManager->flush();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeFromQueue(CallbackInterface $callback) {
		if ($this->queue->contains($callback)) {
			$this->queue->remove($callback);
			$callback->setState(CallbackInterface::STATE_PENDING);
			$this->entityManager->flush();
		}
	}

	/**
	 * {@inheritdoc}
	 * move this into a service ?
	 * add logic for determining which callbacks we want to include
	 */
	private function loadCallbacks() {
		$callbacks = $this->callbackRepository->findAll();
		foreach ($callbacks as $callback) {
			if ($callback->canExecute() === true) {
				$this->addToQueue($callback);
			}
		}
	}

}
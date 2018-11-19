<?php

declare (strict_types = 1);

namespace Towersystems\Webhook\Processor;

use Towersystems\Webhook\Model\CallbackInterface;
use Zend\Stdlib\PriorityQueue;

final class CompositeCallbackProcessor implements CallbackProcessorInterface {

	/**
	 * @var PriorityQueue|callbackProcessorInterface[]
	 */
	private $callbackProcessors;

	/**
	 * [__construct description]
	 */
	public function __construct() {
		$this->callbackProcessors = new PriorityQueue();
	}

	/**
	 * {@inheritdoc}
	 */
	public function addProcessor(CallbackProcessorInterface $callbackProcessor, $priority = 0) {
		$this->callbackProcessors->insert($callbackProcessor, $priority);
	}

	/**
	 * {@inheritdoc}
	 */
	public function process(CallbackInterface $callback) {
		foreach ($this->callbackProcessors as $callbackProcessor) {
			$callbackProcessor->process($callback);
		}
	}

}

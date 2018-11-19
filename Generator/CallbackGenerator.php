<?php

namespace Towersystems\Webhook\Generator;

use Towersystems\Resource\Factory\FactoryInterface;
use Towersystems\Webhook\Model\CallbackInterface;
use Towersystems\Webhook\Model\WebhookInterface;
use Towersystems\Webhook\Provider\WebhookProviderInterface;

class CallbackGenerator implements CallbackGeneratorInterface {

	/**
	 * [$callbackFactory description]
	 * @var [type]
	 */
	protected $callbackFactory;

	/**
	 * [$webhookProvider description]
	 * @var [type]
	 */
	protected $webhookProvider;

	/**
	 * [$entityManager description]
	 * @var [type]
	 */
	protected $entityManager;

	/**
	 * [__construct description]
	 */
	public function __construct(
		WebhookProviderInterface $webhookProvider,
		FactoryInterface $callbackFactory,
		$entityManager
	) {
		$this->webhookProvider = $webhookProvider;
		$this->entityManager = $entityManager;
		$this->callbackFactory = $callbackFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function generate($code, array $payload = []): array{

		$webhook = $this->webhookProvider->getWebhook($code); // throws exception if not found
		$callbacks = [];

		if ($this->canGenerate($webhook)) {
			foreach ($webhook->getUrls() as $url) {
				$tmpCallback = $this->callbackFactory->createNew();
				$tmpCallback->setPayload($payload);
				$tmpCallback->setUrl($url);
				$tmpCallback->setWebhook($webhook);
				$tmpCallback->setStatus(CallbackInterface::STATE_IN_QUEUE);
				$this->entityManager->persist($tmpCallback);
				$callbacks[] = $tmpCallback;
			}

			$this->entityManager->flush();
		}

		return $callbacks;

	}

	/**
	 * {@inheritdoc}
	 */
	private function canGenerate(WebhookInterface $webhook): bool {
		return $webhook->isEnabled();
	}

}
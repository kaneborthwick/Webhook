<?php

namespace Towersystems\Webhook\Provider;

use Towersystems\Resource\Factory\FactoryInterface;
use Towersystems\Resource\Repository\RepositoryInterface;
use Towersystems\Webhook\Configuration\Configuration;
use Towersystems\Webhook\Model\WebhookInterface;
use Webmozart\Assert\Assert;

class WebhookProvider implements WebhookProviderInterface {

	/**
	 * [$webhookRepository description]
	 * @var [type]
	 */
	protected $webhookRepository;

	/**
	 * [$webhookFactory description]
	 * @var [type]
	 */
	protected $webhookFactory;

	/**
	 * [$configuration description]
	 * @var [type]
	 */
	protected $configuration;

	/**
	 * [__construct description]
	 *
	 * @param RepositoryInterface $webhookRepository [description]
	 */
	public function __construct(
		RepositoryInterface $webhookRepository,
		FactoryInterface $webhookFactory,
		Configuration $configuration
	) {
		$this->webhookRepository = $webhookRepository;
		$this->webhookFactory = $webhookFactory;
		$this->configuration = $configuration;
	}

	/**
	 * {@inheritdoc}
	 *
	 * first try to load from config files
	 * if not found in config, try the database
	 *
	 * if found in neither, throw exception
	 */
	public function getWebhook($code): WebhookInterface {

		if ($webhook = $this->getWebhookFromConfiguration($code)) {
			return $webhook;
		}

		$webhook = $this->webhookRepository->findOneBy(["code" => $code, "enabled" => true]);
		Assert::notNull($webhook, sprintf('Webhook %s has not been found', $code));
		return $webhook;
	}

	/**
	 * [getWebhookFromConfiguration description]
	 *
	 * @param  [type] $code [description]
	 * @return [type]       [description]
	 */
	private function getWebhookFromConfiguration($code):? WebhookInterface {
		if ($hookConfig = $this->configuration->getWebhook($code)) {
		 	$webhook = $this->webhookFactory->createNew();
		 	$webhook->setCode($code);
		 	$webhook->setName($hookConfig["name"] ?? "");
		 	$webhook->setDescription($hookConfig["description"] ?? "");
		 	$webhook->setUrls($hookConfig["urls"] ?? []);
		 	$webhook->setEnabled($hookConfig["enabled"] ?? "");
		 	return $webhook->isEnabled() ? $webhook : null;
		 } ;
		 return null;
	}

}
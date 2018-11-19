<?php

namespace Towersystems\Webhook\Provider;
use Towersystems\Webhook\Model\WebhookInterface;

interface WebhookProviderInterface {

	/**
	 * [getWebhook description]
	 * @param  [type] $code [description]
	 * @return [type]       [description]
	 */
	public function getWebhook($code): WebhookInterface;

}
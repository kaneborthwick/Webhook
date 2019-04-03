<?php

namespace Towersystems\Webhook\Dispatcher;

use Towersystems\Webhook\Model\CallbackInterface;
use Zend\Http\Client;
use Zend\Http\Request;

class CallbackDispatcher implements CallbackDispatcherInterface {

	/**
	 * {@inheritdoc}
	 */
	public function dispatch(CallbackInterface $callback): bool {
		try {
			// create the request (POST)
			// this class does handle * any * validation
			$request = new Request();
			$request->setMethod(Request::METHOD_POST);
			$request->setUri($callback->getUrl());
			$request->getHeaders()->addHeaders($callback->getHeader());
			$request->setContent($callback->getPayload());

			// send the request
			$client = new Client();
			$client->setOptions(['timeout' => 0]);
			$response = $client->send($request);

			// return response - caller should handle
			return $response->isSuccess();
		} catch (\Exception $e) {
			$callback->setLastError($e->getMessage());
			return false;
		}
	}

}

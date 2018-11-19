<?php 

namespace Towersystems\Webhook\Generator;


interface CallbackGeneratorInterface {


    /**
     * [generate description]
     * 
     * @param  WebhookInterface $webhook [description]
     * @return [type]                    [description]
     */
    public function generate($code, array $payload = []):? array;


}
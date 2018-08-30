<?php

namespace App\GraphQL\Mutation\Notifikasi;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class SendNotification extends Mutation
{
    protected $attributes = [
        'name' => 'SendNotification',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('Notifikasi');
    }

    public function args()
    {
        return [
            'token' => ['name'=>'token', 'type' => Type::string()],
            'title' => ['name' => 'title', 'type' => Type::string()],
            'body' => ['name' => 'body', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $this->sendPush($args);
        dd(200);
    }

    private function sendPush($args){
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        $notificationBuilder = new PayloadNotificationBuilder($args['title']);
        $notificationBuilder->setBody($args['body'])->setSound('default');
        
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        $token = $args['token'];
        
        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);        
    }
}

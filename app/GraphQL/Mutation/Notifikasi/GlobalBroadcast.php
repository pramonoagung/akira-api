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
use LaravelFCM\Message\Topics;

class GlobalBroadcast extends Mutation
{
    protected $attributes = [
        'name' => 'GlobalBroadcast',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('Notifikasi');
    }
    
    public function args()
    {
        return [
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
        $notificationBuilder = new PayloadNotificationBuilder($args['title']);
        $notificationBuilder->setBody($args['body'])
        ->setSound('default');
        
        $notification = $notificationBuilder->build();
        
        $topic = new Topics();
        $topic->topic('news');
        
        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);
        
        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();
    }
}

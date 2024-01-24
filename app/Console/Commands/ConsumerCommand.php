<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('localhost',5672,'admin','M0n0-051021');
        $channel = $connection->channel();

        $channel->queue_declare(
            'task_queue',
            false,
            true,
            false,
            false,
        );
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        Log::info('Escuchando mensajes.');

        $callback = function ($msg) {
            echo ' [X] Recibido ', $msg->body, "\n";
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->basic_consume(
            'task_queue',
            '',
            false,
            false,
            false,
            false,
            $callback
        );

        while ($channel->is_consuming()){
            $channel->wait();
        }

        $channel->close();

        return Command::SUCCESS;
    }
}

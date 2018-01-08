<?php

namespace App\Mail;

use App\Models\NotificationTemplate;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $model;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->template = NotificationTemplate::where('slug', 'orderStatusChange')->first();
        $this->model = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $variables = $this->model->notificationVariables();

        $patterns = collect($variables)->map(function ($variable, $key) {
            return '/(\{{2}\s?'.$key.'\s?\}{2})/mi';
        });

        $body = preg_replace($patterns->toArray(), $variables, $this->template->body);

        return $this->view('email.notification_template.layout', compact('body'));
    }
}

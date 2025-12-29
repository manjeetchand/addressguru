<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;



class EMail extends Mailable

{

    use Queueable, SerializesModels;



    /**

     * Details to Send with email

     */

    public $details;



    /**

     * Email Subject

     */

    public $subject;



    /**

     * Email Design Layout

     */

    public $template;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($details, $subject, $template)

    {

        $this->details  = $details;

        $this->subject  = $subject;

        $this->template = $template;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->subject($this->subject)

                ->view($this->template);

    }

}


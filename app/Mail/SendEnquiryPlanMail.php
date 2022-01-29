<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEnquiryPlanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data, $filenamepath; 


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$filenamepath)
    {
        $this->data = $data;
        $this->filenamepath = $filenamepath;
    } 

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd(public_path() . '/storage/' . $this->filenamepath);
        return $this->subject("Plan generated successfully")->view('emails.enquiryplan')
        ->with(['patient_name' => $this->data['patient_name']])
        ->attach((public_path() . '/storage/' . $this->filenamepath), [
            'mime' => 'application/pdf',
        ]);
    //     return $this->view('emails.enquiryplan')
    //     ->attach(public_path(asset("storage/".''), [
    //         'mime' => 'application/pdf',
    //    ]);
    }
}

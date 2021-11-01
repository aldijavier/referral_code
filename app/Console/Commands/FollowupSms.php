<?php

namespace App\Console\Commands;

use App\Followup;
use Carbon\Carbon;
use App\SmsTrigger;
use Illuminate\Console\Command;

class FollowupSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'followup:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Triggers sms for followups scheduled for the day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $followups = Followup::where('due_date', '=', Carbon::today())->get();

        $sms_trigger = SmsTrigger::where('alias', '=', 'followup')->first();
        $message = $sms_trigger->message;
        $sms_status = $sms_trigger->status;
        $sender_id = \Utilities::getSetting('sms_sender_id');
        $company_name = \Utilities::getSetting('company_name');

        foreach ($followups as $followup) {
            $sms_text = sprintf($message, $followup->enquiry->name, $company_name);
            \Utilities::Sms($sender_id, $followup->enquiry->contact, $sms_text, $sms_status);
        }
    }
}

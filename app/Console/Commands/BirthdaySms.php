<?php

namespace App\Console\Commands;

use App\Member;
use Carbon\Carbon;
use App\SmsTrigger;
use Illuminate\Console\Command;

class BirthdaySms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday wishes to members';

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
        $birthdays = Member::whereMonth('DOB', '=', Carbon::today()->month)->whereDay('DOB', '=', Carbon::today()->day)->where('status', '=', \constStatus::Active)->get();
        $sender_id = \Utilities::getSetting('sms_sender_id');
        $company_name = \Utilities::getSetting('company_name');

        $sms_trigger = SmsTrigger::where('alias', '=', 'member_birthday')->first();
        $message = $sms_trigger->message;
        $sms_status = $sms_trigger->status;

        foreach ($birthdays as $birthday) {
            $sms_text = sprintf($message, $birthday->name, $company_name);
            \Utilities::Sms($sender_id, $birthday->contact, $sms_text, $sms_status);
        }
    }
}

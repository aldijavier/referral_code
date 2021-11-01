<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Referral_Agent;
use Carbon\Carbon;
   
class AgentCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cronagent';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
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
        $now = Carbon::now();
        $cek_active = Referral_Agent::where('status', '1')
        ->get();

        foreach ($cek_active as $data) {
            if($data->end_date <= $now){
                $update_status = Referral_Agent::where('id', $data->id)
                ->update([
                    'status' => '2'
                ]);
            } else if($data->end_date >= $now){
                $update_status = Referral_Agent::where('id', $data->id)
                ->update([
                    'status' => '1'
                ]);
            }
        }
    }
}
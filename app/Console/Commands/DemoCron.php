<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\Referral;
use Carbon\Carbon;
   
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
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
        $cek_active = Referral::where('status', '1')
        ->get();

        foreach ($cek_active as $data) {
            if($data->end_date <= $now){
                $update_status = Referral::where('id', $data->id)
                ->update([
                    'status' => '2'
                ]);
            } else if($data->end_date >= $now){
                $update_status = Referral::where('id', $data->id)
                ->update([
                    'status' => '1'
                ]);
            }
        }
    }
}
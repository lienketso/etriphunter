<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyCheckRemind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra các booking cần gửi nhắc nhở';

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
     * @return int
     */
    public function handle()
    {
        $reminds = DB::select("SELECT A.*,bravo_bookings.email,bravo_bookings.send_mail,bravo_bookings.id,
        bravo_bookings.first_name,bravo_bookings.last_name from (
            SELECT DATE_SUB(bravo_tour_dates.start_date,
            INTERVAL bravo_tours.remind_number_date DAY) remind_date,
            bravo_tour_dates.target_id,
            bravo_tour_dates.id date_id
            FROM bravo_tours
            JOIN bravo_tour_dates ON bravo_tours.id=bravo_tour_dates.target_id) A
            JOIN bravo_bookings ON bravo_bookings.object_id= A.target_id
            WHERE A.remind_date = CURDATE() AND bravo_bookings.object_model='tour' AND bravo_bookings.send_mail=0");

            foreach ($remind as $reminds) {
            //Send mail
            $details =['name'=>first_name . ' ' . $remind->last_name];
            Mail::to($remind->email)->send(new \App\Mail\RemindMail($details));

        DB::table('bravo_bookings')
            ->where('id', $remind->id)
            ->update(['send_mail' => $remind->send_mail+1]);
            }
        return Command::SUCCESS;
    }
}

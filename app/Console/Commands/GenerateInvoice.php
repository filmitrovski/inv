<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateInvoice extends Command
{
    protected $signature = 'inv {rate} {week} {hours*}';

    protected $description = 'Command description';

    public function handle()
    {
        $dateIterator = Carbon::createFromDate(date('Y'), 1, 1);
        $dateIterator->week((int)$this->argument('week'))->startOfWeek();

        $hours = $this->argument('hours');
        $billable = [];
        $totalHours = 0;
        $totalMinutes = 0;

        $rate = $this->argument('rate');

        for ($i = 0; $i < 7; $i++) {
            $hoursToday = $hours[$i];

            if($hoursToday > 0)
                $minutes = rand(0, 59);
            else
                $minutes = 0;

            $billable[$i] =
                [
                    'day' => $dateIterator->copy()->format('d F'),
                    'hours' => sprintf("%02d", $hoursToday) . ':' . sprintf("%02d", $minutes),
                ];

            $totalHours += $hoursToday;
            $totalMinutes += $minutes;

            $dateIterator->addDay();

            $this->info($billable[$i]['day'] . ' ' . $billable[$i]['hours']);
        }

        $totalHours += (int)($totalMinutes/60);
        $remainMins = $totalMinutes%60;

        $minsBillable = $remainMins - $remainMins%10;

        $this->info($totalHours . ':' . $remainMins);
        $this->info($totalHours . ':' . $minsBillable);

        $totalBillable = $totalHours * $rate + (int)($minsBillable/60 * $rate);

        $this->warn($totalBillable);

        $pdf = new PDF();

        $pdf->loadHTML($this->html($billable));
        return $pdf->save(public_path() . '/invoice.pdf');
    }

    private function html($billable)
    {
        $html = '
            <html>
                <body>
                    <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Date</th>
                                <th>Hours</th>
                            </tr>
                        </thead>
                        <tbody>';
                            foreach($billable as $item) {
                                $html .= '<tr><td>Software development</td>';
                                $html .= '<tr><td>' . $item['day'] . '</td></tr>';
                                $html .= '<tr><td>' . $item['hours'] . '</td></tr>';
                            }
                $html .= '</tbody></table></body></html>';

        return $html;
    }
}

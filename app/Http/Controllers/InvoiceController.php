<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $request->mergeIfMissing([
            'year'  => Carbon::now()->year,
            'week'  => Carbon::now()->weekOfYear(),
            'rate'  => 30,
            'hours' => [8,8,8,8,8,0,0],
            'minutes' => [0,0,0,0,0,0,0],
            'bank' => 'wise',
            'report' => 8888,
        ]);

        return view('index')->with(['request' => $request]);
    }

    public function invoice(Request $request)
    {
        $hours = collect($request->hours);
        $minutes = collect($request->minutes);

        $totalHours = $hours->sum() + (int)($minutes->sum() / 60);
        $totalMinutes = $minutes->sum() % 60;
        $billableMinutes = $totalMinutes - $totalMinutes % 10;

        $money = $totalHours * $request->rate + $billableMinutes * $request->rate / 60;

        $dateIterator = Carbon::createFromDate($request->year, 1, 1);
        $dateIterator->week((int)$request->week)->startOfWeek()->addDays(-1);

        $channels = [
            'wise' => 'wise.com/pay/me/filipm758',
            'skrill' => 'skrill.me/rq/Filip/' . $money . '/USD',
        ];

        $channel = $channels[$request->bank];

        return Pdf::view('invoice', [
            'rate' => $request->rate,
            'hours' => $hours,
            'minutes' => $minutes,
            'totalHours' => $totalHours,
            'totalMinutes' => $totalMinutes,
            'billableMinutes' => $billableMinutes,
            'money' => $money,
            'dateIterator' => $dateIterator,
            'year' => $request->year,
            'channel' => $channel,
            'report' => $request->report,
        ])
            ->headerView('invoiceheader')
            ->format('a4')
            ->name('invoice.pdf');
    }
}

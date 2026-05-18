<p class="big"><strong>Invoice</strong></p>
<table class="py">
    <tr>
        <td>
            <strong>Bill to</strong><br>
            Real Rank Inc.<br>
            18 King St. East, Suite 1400<br>
            Toronto, ON M5C 1C4<br>
            Canada
        </td>
        <td class="right">
            <strong>From</strong><br>
            Filip Mitrovski<br>
            Pekljane 41<br>
            1000 Skopje<br>
            North Macedonia<br>
        </td>
    </tr>
</table>
<div class="py"><strong>Date</strong><br>{{ $dateIterator->copy()->addDays(8)->format('d F Y') }}</div>
<div class="py"><strong>Billing period</strong><br>{{ $dateIterator->copy()->addDay()->format('d F Y') }} – {{ $dateIterator->copy()->addDays(7)->format('d F Y') }}</div>
<div class="py"><strong>Tahometer report</strong><br>
    <a href="https://rankmyagent.tahometer.com/app/reports/{{ $report }}">
        https://rankmyagent.tahometer.com/app/reports/{{ $report }}
    </a>
</div>
<table class="py">
    <thead>
        <tr class="py">
            <th>Item</th>
            <th>Date</th>
            <th class="right">Hours</th>
        </tr>
    </thead>
    <tbody>
        @for($i = 0; $i < 7; $i++)
            <tr class="py">
                <td>Software development</td>
                <td>{{ $dateIterator->addDay()->format('d F'), }}</td>
                <td class="right">{{ sprintf('%02d', $hours[$i]) }}:{{ sprintf('%02d', $minutes[$i]) }}</td>
            </tr>
        @endfor

        <tr class="py">
            <td></td>
            <td><strong>Total hours</strong></td>
            <td class="right"><strong>{{ sprintf('%02d', $totalHours) }}:{{ sprintf('%02d', $totalMinutes) }}</strong></td>
        </tr>

        <tr class="py">
            <td></td>
            <td><strong>Billable hours</strong></td>
            <td class="right"><strong>{{ sprintf('%02d', $totalHours) }}:{{ sprintf('%02d', $billableMinutes) }}</strong></td>
        </tr>

        <tr class="py">
            <td></td>
            <td><strong>Hourly rate</strong></td>
            <td class="right"><strong>{{ $rate }} USD</strong></td>
        </tr>
    </tbody>
</table>
<div class="right big py"><strong>Total: {{ $money }} USD</strong></div>
<table>
    <tr>
        <td class="third">
            NLB TUTUNSKA BANKA AD<br>
            MAJKA TEREZA 1, SKOPJE, 1000<br>
            SWIFT/BIC: TUTNMK22<br>
            IBAN: MK07210501680003383<br>
        </td>
        <td class="third center big"><strong>OR</strong></td>
        <td class="right third"><a href="{{ $channel }}">{{ $channel }}</a></td>
    </tr>
</table>

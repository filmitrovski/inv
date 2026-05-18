<html>
<head>
    <title>Invoice generator</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body style="height: 100vh">
<div class="row h-100">
    <div class="col-3 p-5">
        <form>
            <div class="row py-2">
                <div class="col">YEAR</div>
                <div class="col"><input value="{{ $request->year }}" type="number" name="year" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">WEEK</div>
                <div class="col"><input value="{{ $request->week }}" type="number" name="week" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">RATE</div>
                <div class="col"><input value="{{ $request->rate }}" type="number" name="rate" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Mon</div>
                <div class="col"><input value="{{ $request->hours[0] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[0] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Tue</div>
                <div class="col"><input value="{{ $request->hours[1] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[1] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Wed</div>
                <div class="col"><input value="{{ $request->hours[2] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[2] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Thu</div>
                <div class="col"><input value="{{ $request->hours[3] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[3] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Fri</div>
                <div class="col"><input value="{{ $request->hours[4] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[4] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Sat</div>
                <div class="col"><input value="{{ $request->hours[5] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[5] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Sun</div>
                <div class="col"><input value="{{ $request->hours[6] }}" type="number" name="hours[]" class="form-control"></div>
                <div class="col"><input value="{{ $request->minutes[6] }}" type="number" name="minutes[]" class="form-control"></div>
            </div>
            <div class="row py-2">
                <div class="col">Channel</div>
                <div class="col">
                    <select name="bank" id="bank">
                        <option value="wise" {{ $request->bank == 'wise' ? 'selected' : '' }}>Wise</option>
                        <option value="skrill" {{ $request->bank == 'skrill' ? 'selected' : '' }}>Skrill</option>
                    </select>
                </div>
            </div>
            <div class="row py-2">
                <div class="col">Tahometer report</div>
                <div class="col"><input value="{{ $request->report }}" type="number" name="report" class="form-control"></div>
            </div>
            <input type="submit" value="Generate" class="btn btn-primary">
        </form>
    </div>
    <div class="col-9 p-5">
        <iframe
            width="100%"
            height="100%"
            src="{{ route('invoice', [
                'year' => $request->year,
                'week' => $request->week,
                'rate' => $request->rate,
                'hours' => $request->hours,
                'minutes' => $request->minutes,
                'bank' => $request->bank,
                'report' => $request->report,
                ]) }}">
        </iframe>
    </div>
</div>
</body>
</html>

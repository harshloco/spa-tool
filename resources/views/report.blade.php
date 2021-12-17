@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chartisan example</title>
</head>
<body>
<!-- Chart's container -->
<div id="chart" style="height: 300px;"></div>
<div class="table-responsive">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Page name</th>
            <th scope="col">Visitors</th>
            <th scope="col">Unique users</th>
            <th scope="col">Bounce rate</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">
                /argon/
            </th>
            <td>
                4,569
            </td>
            <td>
                340
            </td>
            <td>
                <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
            </td>
        </tr>
        <tr>
            <th scope="row">
                /argon/index.html
            </th>
            <td>
                3,985
            </td>
            <td>
                319
            </td>
            <td>
                <i class="fas fa-arrow-down text-warning mr-3"></i> 46,53%
            </td>
        </tr>
        <tr>
            <th scope="row">
                /argon/charts.html
            </th>
            <td>
                3,513
            </td>
            <td>
                294
            </td>
            <td>
                <i class="fas fa-arrow-down text-warning mr-3"></i> 36,49%
            </td>
        </tr>
        <tr>
            <th scope="row">
                /argon/tables.html
            </th>
            <td>
                2,050
            </td>
            <td>
                147
            </td>
            <td>
                <i class="fas fa-arrow-up text-success mr-3"></i> 50,87%
            </td>
        </tr>
        <tr>
            <th scope="row">
                /argon/profile.html
            </th>
            <td>
                1,795
            </td>
            <td>
                190
            </td>
            <td>
                <i class="fas fa-arrow-down text-danger mr-3"></i> 46,53%
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div id="comment" style="height: 300px;"></div>

<!-- Charting library -->
<script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
<!-- Your application script -->
<script>

    const chart = new Chartisan({
        el: '#chart',
        url: "@chart('spa')" + "?id={{ $data }}",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Top 3 most liked post with #{{ $data }}')
    });

    const comment = new Chartisan({
        el: '#comment',
        url: "@chart('comment')" + "?id={{ $data }}",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Top 3 most commented post with #{{ $data }}')
    });
</script>
</body>
</html>
@include('layouts.footers.auth')
</div>
@endsection

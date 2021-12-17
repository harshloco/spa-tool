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
    <!-- like table -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">User Name</th>
            <th scope="col">Post Url</th>
            <th scope="col">Likes Count</th>
            <th scope="col">Comments Count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($mostLiked as $liked)
            <tr>
                <th scope="row">
                    {{$liked->name}}
                </th>
                <td>
                    <a target="blank" href ={{$liked->postUrl}}>Link</a>
                </td>
                <td>
                    {{$liked->likeCount}}
                </td>
                <td>
                    {{$liked->commentCount}}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div id="comment" style="height: 300px;"></div>

<!-- comment table -->
<table class="table align-items-center table-flush ml--2">
    <thead class="thead-light">
    <tr>
        <th scope="col">User Name</th>
        <th scope="col">Post Url</th>
        <th scope="col">Likes Count</th>
        <th scope="col">Comments Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mostComment as $comment)
        <tr>
            <th scope="row">
                {{$comment->name}}
            </th>
            <td>
                <a target="blank" href ={{$comment->postUrl}}>Link</a>
            </td>
            <td>
                {{$comment->likeCount}}
            </td>
            <td>
                {{$comment->commentCount}}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

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
            .title('Top 4 most liked post with #{{ $data }}')
    });

    const comment = new Chartisan({
        el: '#comment',
        url: "@chart('comment')" + "?id={{ $data }}",
        hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('Top 4 most commented post with #{{ $data }}')
    });
</script>
</body>
</html>
@include('layouts.footers.auth')
</div>
@endsection

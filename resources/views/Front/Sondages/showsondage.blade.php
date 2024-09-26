<h2>Selected Poll Details (ID: {{ $sondage->id }})</h2>
<hr>
<p><strong>Title:</strong> {{ $sondage->title }}</p>
<p><strong>Description:</strong> {{ $sondage->description }}</p>
<p><strong>Category:</strong> {{ $sondage->category }}</p>
<p><strong>Creation Date:</strong> {{ \Carbon\Carbon::parse($sondage->created_at)->format('d/m/Y H:i') }}</p>
<p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($sondage->start_date)->format('d/m/Y H:i') }}</p>
<p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($sondage->end_date)->format('d/m/Y H:i') }}</p>
<p><strong>Response Count:</strong> {{ $sondage->response_count }}</p>
<p><strong>Questions:</strong></p>
<ul>
    @foreach(explode('|', $sondage->questions) as $question)
        <li>{{ $question }}</li>
    @endforeach
</ul>
<p><strong>Location:</strong> {{ $sondage->location }}</p>

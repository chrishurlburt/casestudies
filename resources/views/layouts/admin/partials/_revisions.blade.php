@if(!$study->revisionHistory->isEmpty())
        <h4>Revision History</h4>
        <hr />

        <ul>
        @foreach($study->revisionHistory as $history )
            <li>{{ $history->userResponsible()['first_name'] }} changed the {{ $history->fieldName() }}.</li>
        @endforeach
        </ul>
@endif
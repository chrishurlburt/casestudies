@if(!$study->revisionHistory->isEmpty())
    <div class="col-lg-4">
        <h4>Revision History</h4>
        <hr />

        <ul>
        @foreach($study->revisionHistory as $history )
            <li>{{ $history->userResponsible()['first_name'] }} changed the {{ $history->fieldName() }}.</li>
        @endforeach
        </ul>
    </div>
@endif
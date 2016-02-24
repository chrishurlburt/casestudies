<table class="table table-striped">
  <thead>
    <tr>
      <th>Title</th>
      <th>Created</th>
    </tr>
  </thead>
    <tbody>
      @foreach($studies as $study)
        <td><a href="{{ route('admin.cases.edit', ['slug' => $study->slug]) }}">{!! $study->title !!}</a></td>
        <td>{{ date('F d, Y - h:i A', strtotime($study->created_at)) }}</td>
      @endforeach
    </tbody>
</table>
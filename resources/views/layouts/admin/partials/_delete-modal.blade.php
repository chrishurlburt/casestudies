<div id="delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you would like to delete this Case Study?</h4>
        <p>This operation cannot be undone.</p>
      </div>
      <div class="modal-footer">
        {!! Form::open(['method' => 'DELETE']) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button></a>
        {!! Form::close() !!}
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
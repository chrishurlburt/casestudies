<div id="delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="warning-message"></h4>
        <p class="warning-desc"></p>
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
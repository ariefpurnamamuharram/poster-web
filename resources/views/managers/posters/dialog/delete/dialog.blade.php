<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteTitle">
                    Delete Poster
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="delete-poster-form" action="{{ route('administrator.manager.poster.delete') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="posterID" name="posterID">

                    <p>Are you sure want to delete this poster?</p>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button class="btn btn-danger" onclick="document.getElementById('delete-poster-form').submit()">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

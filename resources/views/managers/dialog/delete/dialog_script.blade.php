<script type="text/javascript">
    $('#modalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var posterID = button.data('poster-id')

        var modal = $(this)
        modal.find('.modal-body #posterID').val(posterID)
    });
</script>

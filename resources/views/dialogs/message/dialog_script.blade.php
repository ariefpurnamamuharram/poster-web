<script type="text/javascript">
    @if(session()->has('message'))
    $(window).on('load', function () {
        $('#message-content').html('{{ session('message') }}');
        $('#modalMessage').modal('show');
    });
    @endif
</script>

$('#logout').on('click', function (event) {
    event.preventDefault();

    $('#logout-form').submit();
});

$('#follow, #like').on('click', function () {
    var status = parseInt($(this).data('status'), 10);
    var action = $(this).attr('id');
    var url = status ? $(this).data(action + '-url') : $(this).data('un' + action + '-url');
    var _method = status ? 'DELETE' : 'POST';
    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: url,
        method: 'POST',
        data: { _method: _method, _token: _token },
        dataType: 'json'
    }).done(function (response) {
        console.log(response);
        if (response.status === 'success') {
            var ucfirst_action = action.charAt(0).toUpperCase() + action.slice(1);

            $('#' + action).text((status ? ucfirst_action : 'Un' + action ));
            $('#' + action).data('status', (status ? '0' : '1'));
        }
    });
});

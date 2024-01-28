$(function() {

});

$(document).on('change', '.channelNumber', function() {
    let channelNumberEl = $(this);
    let channelNumber = parseInt(channelNumberEl.val());
    let channelId = channelNumberEl.closest('tr').data('channel-id');
    if (channelNumber > 0) {
        $.getJSON('change-channel-number.php?channelId='+channelId+'&channelNumber='+channelNumber, function(data) {
            $('#channels').html(data.channelsTable);
        });
    }
});

$(document).on('change', '.channelVisible', function() {
    let channelVisibleEl = $(this);
    let channelVisible = channelVisibleEl.is(':checked') ? 1 : 0;
    let channelId = channelVisibleEl.closest('tr').data('channel-id');

    $.getJSON('change-channel-visibility.php?channelId='+channelId+'&visible='+channelVisible, function(data) {
        $('#channels').html(data.channelsTable);
    });
});
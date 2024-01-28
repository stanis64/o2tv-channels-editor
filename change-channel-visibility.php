<?php

require __DIR__.DIRECTORY_SEPARATOR.'base.php';

$channelsTable = '';
$channels = getChannels();

if (!empty($channels)) {
    $channelIdToModify = (int) $_GET['channelId'];
    $newVisible = (int) $_GET['visible'] === 1;
    $channelToModifyKey = null;
    $oldVisible = null;

    foreach ($channels as $channelKey => $channel) {
        if ($channel['id'] === $channelIdToModify) {
            $oldVisible = $channel['visible'];
            $channelToModifyKey = $channelKey;
        }
    }

    $lastChannelNumber = null;
    if ($oldVisible && !$newVisible) {
        $channelNumbers = array_column($channels, 'channel_number');
        $lastChannelNumber = end($channelNumbers);
        if ($lastChannelNumber < 999) {
            $lastChannelNumber = 999;
        }
    } else {
        foreach ($channels as $channel) {
            if ($channel['channel_number'] < 999) {
                $lastChannelNumber = $channel['channel_number'];
            }
        }
    }

    if ($channels[$channelToModifyKey]['channel_number'] > 999) {
        if ($lastChannelNumber === null) {
            $lastChannelNumber = 0;
        }
        $channels[$channelToModifyKey]['channel_number'] = $lastChannelNumber + 1;
    }

    $channels[$channelToModifyKey]['visible'] = $newVisible;

    $channels = sortChannels($channels);
    saveChannels($channels);
    $channelsTable = generateChannelsTable($channels);
}

echo json_encode([
    'channelsTable' => $channelsTable
]);
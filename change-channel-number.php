<?php

require __DIR__.DIRECTORY_SEPARATOR.'base.php';

$channelsTable = '';
$channels = getChannels();

if (!empty($channels)) {
    $channelIdToModify = (int) $_GET['channelId'];
    $newChannelNumber = (int) $_GET['channelNumber'];
    $oldChannelNumber = null;
    $channelToModifyKey = null;

    foreach ($channels as $channelKey => $channel) {
        if ($channel['id'] === $channelIdToModify) {
            $oldChannelNumber = $channel['channel_number'];
            $channelToModifyKey = $channelKey;
        }
    }

    foreach ($channels as $channelKey => $channel) {
        if ($channel['channel_number'] === $newChannelNumber) {
            $channels[$channelKey]['channel_number'] = $oldChannelNumber;
        }
    }

    $channels[$channelToModifyKey]['channel_number'] = $newChannelNumber;

    $channels = sortChannels($channels);
    saveChannels($channels);
    $channelsTable = generateChannelsTable($channels);
}

echo json_encode([
    'channelsTable' => $channelsTable
]);
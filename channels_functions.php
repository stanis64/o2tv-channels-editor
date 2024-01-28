<?php

/**
 * @return array
 */
function getChannels(): array {
    $channelsFile = FILES_DIR.'channels.txt';
    $channelsSession = $_SESSION['channels'];
    if (file_exists($channelsFile)) {
        $channelsRaw = file_get_contents($channelsFile);
        $channelsDecoded = json_decode($channelsRaw, JSON_OBJECT_AS_ARRAY);
        $channels = sortChannels($channelsDecoded['channels']);
    } else if (!empty($channelsSession)) {
        // ToDo
        $channels = $channelsSession;
    }
    return $channels;
}

/**
 * @return int
 */
function getChannelsValidTo(): int {
    $channelsFile = FILES_DIR.'channels.txt';
    $validTo = null;
    if (file_exists($channelsFile)) {
        $channelsRaw = file_get_contents($channelsFile);
        $channelsDecoded = json_decode($channelsRaw, JSON_OBJECT_AS_ARRAY);
        $validTo = $channelsDecoded['valid_to'];
    }
    return $validTo;
}

/**
 * @param array $channels
 * @return array
 */
function sortChannels(array $channels): array {
    usort($channels, function($channelA, $channelB) {
        return $channelA['channel_number'] <=> $channelB['channel_number'];
    });
    return $channels;
}

/**
 * @param array $channels
 * @return string
 */
function generateChannelsTable(array $channels): string {
    $html = '
    <table class="table table-striped table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Channel number</th>
            <th scope="col">O2 number</th>
            <th scope="col">Logo</th>
            <th scope="col">Name</th>
            <th scope="col">ID</th>
            <th scope="col">Adult</th>
            <th scope="col">Visible</th>
        </tr>
        </thead>
        <tbody>';

    foreach ($channels as $channel) {
        $html .= '
            <tr data-channel-id="'.$channel['id'].'">
                <th scope="row"><input type="text" value="'.$channel['channel_number'].'" class="channel-number channelNumber"></th>
                <td>'.$channel['o2_number'].'</td>
                <td><img src="'.$channel['logo'].'" class="channel-logo"></td>
                <td>'.$channel['name'].'</td>
                <td>'.$channel['id'].'</td>
                <td>'.($channel['adult'] ? '18+' : '').'</td>
                <td><input type="checkbox" class="channelVisible"'.($channel['visible'] ? ' checked' : '').'></td>
            </tr>
        ';
    }

    $html .= '</tbody>
    </table>';

    return $html;
}

/**
 * @param array $channels
 * @return void
 */
function saveChannels(array $channels) {
    $channelsJson = '';
    foreach ($channels as $channel) {
        $delimiter = $channelsJson === '' ? '' : ', ';
        $channelsJson .= $delimiter.'"'.$channel['id'].'": {"channel_number": '.$channel['channel_number'].', "o2_number": '.$channel['o2_number'].', "name": '.json_encode($channel['name']).', "id": '.$channel['id'].', "logo": '.($channel['logo'] ? '"'.$channel['logo'].'"': 'null').', "adult": '.($channel['adult'] ? 'true' : 'false').', "visible": '.($channel['visible'] ? 'true' : 'false').'}';
    }

    $channelsTxt = '{"channels": {'.$channelsJson.'}, "valid_to": '.getChannelsValidTo().'}'.PHP_EOL;

    unlink(FILES_DIR.'channels.txt');
    file_put_contents(FILES_DIR.'channels.txt', $channelsTxt);
}

function setAllChannelsInvisible() {
    $channels = getChannels();
    $lastChannelNumber = 999;
    foreach ($channels as $channelKey => $channel) {
        $lastChannelNumber += 1;
        $channels[$channelKey]['visible'] = false;
        $channels[$channelKey]['channel_number'] = $lastChannelNumber;
    }
    saveChannels($channels);
}
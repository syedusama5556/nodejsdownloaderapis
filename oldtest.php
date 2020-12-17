<?php

session_start();
header('Access-Control-Allow-Origin: *');
ini_set("allow_url_fopen", 1);



include_once 'YouTubeDownloader.class.php'; 
$handler = new YouTubeDownloader(); 

const USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36";

$hide_dash_videos = false;
$instagram_post_page = '';
$api_key = "8af436d1e78348ab09f81a99bf43485b";
$m4a_mp3 = true;


if(!isset($_GET['url'])){
	die("invalid parameters");
}


if (strpos($_GET['url'], "soundcloud") == true)
{
    getSoundcloudDownloadLink($_GET['url']);
    
}
else if (strpos($_GET['url'], "bandcamp") == true)
{
    getBandcamDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "bitchute") == true)
{
    getBitchuteDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "break") == true)
{
    getBreakDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "dailymotion") == true || strpos($_GET['url'], "dai.ly") == true)
{
    getDailymotionDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "douyin") == true)
{
    getDouyinDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "izlesene") == true)
{
    getIzleseneDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "linkedin") == true)
{
    getLinkedinDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "kwai") == true || strpos($_GET['url'], "kw.ai") == true)
{
    getKwaiDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "mashable"))
{
    getMashableDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "gag"))
{
    getGagDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "imgur"))
{
    getImgurDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "imdb"))
{
    getImdbDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "twitch"))
{
    getTwitchDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "ted"))
{
    getTedDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "espn"))
{
    getEspnDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "flickr"))
{
    getFlickrDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "pinterest") || strpos($_GET['url'], "pin.it"))
{
    getPinterestDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "streamable"))
{
    getStreamableDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "blogspot.com"))
{
    getBloggerDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "facebook") || strpos($_GET['url'], "fb.watch"))
{
    getFacebookDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "instagram"))
{

    $test = rtrim(preg_replace('/https/', 'http', $_GET['url'], 1) , '/');
    getInstagramDownloadLink($test);

}
else if (strpos($_GET['url'], "tiktok"))
{
    getTiktokDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "twitter"))
{
    getTwitterDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "bilibili"))
{
    getBilibiliDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "vimeo"))
{
    getvimeoDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "youtube") || strpos($_GET['url'], "youtu.be"))
{
	if(strpos($_GET['url'], "youtu.be")){
		    $test = rtrim(preg_replace('/https:\/\/youtu.be\//', '', $_GET['url'], 1) , '/');

	$lin = "https://www.youtube.com/watch?v=".$test;
	

	getyoutubeDownloadLink($lin);
	}else{
    getyoutubeDownloadLink($_GET['url']);
	}
}else if (strpos($_GET['url'], "mxtakatak") )
{
    getmxtakatakDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "alphaporno") )
{
    getalphapronoDownloadLink($_GET['url']);

}
else if (strpos($_GET['url'], "likee") )
{
    getdownloadof_likee($_GET['url']);

}else if (strpos($_GET['url'], "20min.ch") )
{
    get20min_chDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "gaana") )
{
    get_gaanaDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "cocoscope") )
{
    get_cocoscopeDownloadLink($_GET['url']);

}else if (strpos($_GET['url'], "viki") )
{
    get_vikiDownloadLink($_GET['url']);

}


else
{

    echo json_encode("not working");
}

function get_file_size($url, $format = true)
{
    $result = - 1;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_REFERER, '');
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_USERAGENT, USER_AGENT);
    $headers = curl_exec($curl);
    if (curl_errno($curl) == 0)
    {
        $result = (int)curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
    }
    curl_close($curl);
    if ($result > 100)
    {
        switch ($format)
        {
            case true:
                return format_size($result);
            break;
            case false:
                return $result;
            break;
            default:
                return format_size($result);
            break;
        }
    }
    else
    {
        return "";
    }
}

function format_size($bytes)
{
    switch ($bytes)
    {
        case $bytes < 1024:
            $size = $bytes . " B";
        break;
        case $bytes < 1048576:
            $size = round($bytes / 1024, 2) . " KB";
        break;
        case $bytes < 1073741824:
            $size = round($bytes / 1048576, 2) . " MB";
        break;
        case $bytes < 1099511627776:
            $size = round($bytes / 1073741824, 2) . " GB";
        break;
    }
    if (!empty($size))
    {
        return $size;
    }
    else
    {
        return "";
    }
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function get_url_contents($url)
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function merge_parts($stream_url, $merged_file)
{
    $m3u8_url = json_decode(get_url_contents($stream_url . "?client_id=" . $GLOBALS['api_key']) , true) ["url"];
    $m3u8_data = get_url_contents($m3u8_url);
    preg_match_all('/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/\/=]*)/', $m3u8_data, $streams_raw);
    $merged = "";
    foreach ($streams_raw[0] as $stream_part)
    {
        $merged .= get_url_contents($stream_part);
    }
    file_put_contents($merged_file, $merged);
}

function format_seconds($seconds)
{
    return gmdate(($seconds > 3600 ? "H:i:s" : "i:s") , $seconds);
}

function getSoundcloudDownloadLink($url)
{

    $api_key = $GLOBALS['api_key'];
    $web_page = get_url_contents($url);
    $track_id = get_string_between($web_page, 'content="soundcloud://sounds:', '">');
    $track["title"] = get_string_between($web_page, 'property="og:title" content="', '"');
    $track["source"] = "soundcloud";
    $track["thumbnail"] = get_string_between($web_page, 'property="og:image" content="', '"');
    $track["duration"] = format_seconds(get_string_between($web_page, '"full_duration":', ',') / 1000);
    $track["links"] = array();
    $transcodings = get_string_between($web_page, '"media":{"transcodings":[', ']');
    $data["media"]["transcodings"] = json_decode("[" . $transcodings . "]", true);
    if (empty($data["media"]["transcodings"]))
    {
        return false;
    }

    foreach ($data["media"]["transcodings"] as $stream)
    {
        if ($stream["format"]["protocol"] == "progressive")
        {
            $mp3_url = json_decode(get_url_contents($stream["url"] . "?client_id=" . $api_key) , true) ["url"];
            $mp3_size = get_file_size($mp3_url);
            if (!empty($mp3_size))
            {
                array_push($track["links"], array(
                    "url" => $mp3_url,
                    "type" => "mp3",
                    "quality" => "128 kbps",
                    "size" => $mp3_size,
                    "mute" => false
                ));
                break;
            }
        }

    echo json_encode($track);

	}
	}

function getBandcamDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $embed_url = get_string_between($web_page, 'property="twitter:player" content="', '"');
    if (empty($embed_url))
    {
        return false;
    }
    $video["title"] = get_string_between($web_page, '<title>', '</title>');
    $video["source"] = "bandcamp";
    $video["thumbnail"] = get_string_between($web_page, 'property="og:image" content="', '"');
    $video["duration"] = format_seconds(get_string_between($web_page, 'itemprop="duration" content="', '"'));
    $embed_page = get_url_contents($embed_url);
    $player_data = get_string_between($embed_page, 'var playerdata =', ';');
    $player_data = json_decode($player_data, true);
    $audio_url = $player_data["tracks"][0]["file"]["mp3-128"];
    if (empty($audio_url))
    {
        return false;
    }
    $video["links"][0]["url"] = $audio_url;
    $video["links"][0]["type"] = "mp3";
    $video["links"][0]["size"] = get_file_size($audio_url);
    $video["links"][0]["quality"] = "128kbps";
    $video["links"][0]["mute"] = "no";
    echo json_encode($video);
}

function getBitchuteDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $video["title"] = get_string_between($web_page, '<title>', '</title>');
    $video["source"] = "bitchute";
    $video["thumbnail"] = get_string_between($web_page, 'poster="', '"');
    $video["duration"] = get_string_between($web_page, '<span class="video-duration">', '</span>');
    $video_url = get_string_between($web_page, '<source src="', '"');
    $video["links"][0]["url"] = $video_url;
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($video_url);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["mute"] = "no";
    echo json_encode($video);
}

function format_title($title)
{
    $title = str_replace(".mp4", "", $title);
    $title = str_replace("_", " ", $title);
    return $title;
}

function getBreakDownloadLink($url)
{
    $page_source = get_url_contents($url);
    preg_match('/<source src="(.*?)" type="video\/youtube"\/>/', $page_source, $youtube_url);
    preg_match_all('/<iframe src="(.*?)"/', $page_source, $embed_url);
    if (!empty($embed_url[1][0]))
    {
        $embed_url = $embed_url[1][0];
        $embed_source = get_url_contents($embed_url);
        $video_url = get_string_between($embed_source, '_mvp.file = "', '";');
        $thumbnail_url = get_string_between($embed_source, '_mvp.image = "', '";');
        $video_title = get_string_between($embed_source, '<title>', '</title>');
        if ($video_url != "" && $thumbnail_url != "" && $video_title != "")
        {
            $video["title"] = format_title($video_title);
            $video["source"] = "break";
            $video["thumbnail"] = $thumbnail_url;
            $video["links"][0]["url"] = $video_url;
            $video["links"][0]["type"] = "mp4";
            $video["links"][0]["size"] = get_file_size($video["links"][0]["url"]);
            $video["links"][0]["quality"] = "SD";
            $video["links"][0]["mute"] = "no";
            echo json_encode($video);
        }
        else
        {
            echo json_encode("not working");

            return false;
        }
    }
    else
    {
        echo json_encode("not working");

        return false;
    }
}

function unshorten($url, $max_redirs = 3)

{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, $max_redirs);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_exec($ch);
    $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return $url;
}

function find_video_id($url)
{
    $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
    switch (true)
    {
        case ($domain == "dai.ly"):
            $video_id = str_replace('https://dai.ly/', "", $url);
            $video_id = str_replace('/', "", $video_id);
            return $video_id;
        break;
        case ($domain == "dailymotion.com"):
            $url_parts = parse_url($url);
            $path_arr = explode("/", rtrim($url_parts['path'], "/"));
            $video_id = $path_arr[2];
            return $video_id;
        break;
        default:
            return "";
        break;
    }
}

function getDailymotionDownloadLink($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://dailymotion.aiovideodl.ml/system/action.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "url=" . urlencode($url) ,
        CURLOPT_HTTPHEADER => array(
            "x-requested-with: PHP-cURL",
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36",
            "content-type: application/x-www-form-urlencoded; charset=UTF-8"
        ) ,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    for ($i = 0;$i < count($response["links"]);$i++)
    {
        $data = array(
            "url" => $response["links"][$i]["url"],
            "title" => $response["title"],
            "type" => $response["links"][$i]["type"],
            "source" => "dailymotion"
        );
        $response["links"][$i]["url"] = "https://dailymotion.aiovideodl.ml/dl.php?" . http_build_query($data);
    }
    echo json_encode($response);

}

function find_video_idtik($url)
{
    $url = unshorten($url);
    $url = strtok($url, '?');
    $last_char = substr($url, -1);
    if ($last_char == "/")
    {
        $url = substr($url, 0, -1);
    }
    $arr = explode("/", $url);
    return end($arr);
}

function getDouyinDownloadLink($url)
{
    $video_id = find_video_idtik($url);

    if (empty($video_id))
    {
        return false;
    }
    $video_info = get_video_info($video_id);
    if (empty($video_info))
    {
        return false;
    }
    $video["title"] = $video_info["item_list"][0]["desc"];
    $video["source"] = "douyin";
    $video["thumbnail"] = $video_info["item_list"][0]["video"]["cover"]["url_list"][0];
    $video["duration"] = format_seconds($video_info["item_list"][0]["video"]["duration"] / 1000);
    $video_url = $video_info["item_list"][0]["video"]["play_addr"]["url_list"][0];

    if (!empty($video_url))
    {
        $video["links"][0]["url"] = $video_url;
        $video["links"][0]["type"] = "mp4";
        $video["links"][0]["size"] = get_file_size($video_url);
        $video["links"][0]["quality"] = $video_info["item_list"][0]["video"]["ratio"];
        $video["links"][0]["mute"] = false;
    }
    $music_url = $video_info["item_list"][0]["music"]["play_url"]["uri"];
    if (!empty($music_url) && !empty($video["links"][0]))
    {
        $video["links"][1]["url"] = $music_url;
        $video["links"][1]["type"] = "mp3";
        $video["links"][1]["size"] = get_file_size($music_url);
        $video["links"][1]["quality"] = "128kbps";
        $video["links"][1]["mute"] = false;
    }
    echo json_encode($video);
}

function get_video_info($video_id)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=" . $video_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function getIzleseneDownloadLink($url)
{
    $web_page = get_url_contents($url);
    if (preg_match_all('/videoObj\s*=\s*({.+?})\s*;\s*\n/', $web_page, $match))
    {
        $player_json = $match[1][0];
        $player_data = json_decode($player_json, true);
        $data["title"] = $player_data["videoTitle"];
        $data["source"] = "izlesene";
        $data["thumbnail"] = $player_data["posterURL"];
        $data["duration"] = gmdate(($player_data["duration"] / 1000 > 3600 ? "H:i:s" : "i:s") , $player_data["duration"] / 1000);
        if (!empty($player_data["media"]["level"]))
        {
            $i = 0;
            foreach ($player_data["media"]["level"] as $video)
            {
                $data["links"][$i]["url"] = $video["source"];
                $data["links"][$i]["type"] = "mp4";
                $data["links"][$i]["size"] = get_file_size($video["source"]);
                $data["links"][$i]["quality"] = $video["value"] . "p";
                $data["links"][$i]["mute"] = "no";
                $i++;
            }
            echo json_encode($data);
        }
    }
}

function getLinkedinDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $data_sources = get_string_between($web_page, 'data-sources="', '"');
    if (empty($data_sources))
    {
        return false;
    }
    $video["title"] = get_string_between($web_page, '<title>', '</title>');
    $video["source"] = "linkedin";
    $video["thumbnail"] = html_entity_decode(get_string_between($web_page, 'data-poster-url="', '"'));
    $video_url = json_decode(html_entity_decode($data_sources) , true) [0]["src"];
    $video["links"][0]["url"] = $video_url;
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($video_url);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["mute"] = "no";
    echo json_encode($video);
}

function getKwaiDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $video_url = get_string_between($web_page, '<video src="', '"');
    $video["title"] = get_string_between($web_page, '"userName":"', '","headUrl"');
    $video["source"] = "kwai";
    $video["thumbnail"] = get_string_between($web_page, 'poster="', '"');
    $video["links"][0]["url"] = $video_url;
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($video_url);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["mute"] = "no";
    echo json_encode($video);
}

function getMashableDownloadLink($url)
{
    $data["source"] = "mashable";
    $curl_content = get_url_contents($url);
    preg_match_all('@<script class="playerMetadata" type="application/json">(.*?)</script>@si', $curl_content, $match);
    preg_match_all('/<script type="application\/ld\+json">{"@context": "https:\/\/schema.org", "@type": "VideoObject",(.*?)<\/script>/', $curl_content, $output);
    if (!empty($match[1][0]))
    {
        $json = json_decode($match[1][0], true);
        $data["title"] = $json["player"]["title"];
        $data["thumbnail"] = $json["player"]["image"];
        $i = 0;
        foreach ($json["player"]["sources"] as $url)
        {
            if (preg_match_all("@/(.*?).mp4@si", $url["file"], $match))
            {
                $data["links"][$i]["url"] = $url["file"];
                $data["links"][$i]["type"] = "mp4";
                $data["links"][$i]["quality"] = $match[1][1] . "P";
                $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
                $i++;
            }
        }
        $data["links"] = array_reverse($data["links"]);
    }
    else if (!empty($output[0][0]))
    {
        $json = get_string_between($output[0][0], '<script type="application/ld+json">', '</script>');
        $json = json_decode($json, true);
        $data["title"] = $json["name"];
        $data["thumbnail"] = $json["thumbnailUrl"];
        $data["links"][0]["url"] = $json["contentUrl"];
        $data["links"][0]["type"] = "mp4";
        $data["links"][0]["quality"] = "HD";
        $data["links"][0]["size"] = get_file_size($data["links"][0]["url"]);
    }
    else
    {
        return false;
    }
    echo json_encode($data);
}

function get_id($url)
{
    preg_match('/gag\/(\w+)/', $url, $output);
    return isset($output[1]) != "" ? $output[1] : false;
}

function getGagDownloadLink($url)
{
    $videoId = get_id($url);
    if ($videoId != false && $videoId != "")
    {
        $video["title"] = "9GAG Video";
        $videoUrl = "https://img-9gag-fun.9cache.com/photo/" . $videoId . "_460sv.mp4";
        $videoSize = get_file_size($videoUrl, false);
        if ($videoSize > 1000)
        {
            $video["links"][0]["url"] = $videoUrl;
            $video["links"][0]["type"] = "mp4";
            $video["links"][0]["size"] = format_size($videoSize);
            $video["links"][0]["quality"] = "HD";
            $video["links"][0]["mute"] = "no";
        }
        $video["thumbnail"] = "http://images-cdn.9gag.com/photo/" . $videoId . "_460s.jpg";
        $video["source"] = "9gag";
        echo json_encode($video);
    }
    else
    {
        echo json_encode("not working");
    }
}

function getImgurDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $video["title"] = get_string_between($web_page, '<title>', '</title>');
    $video["source"] = "imgur";
    $video["thumbnail"] = get_string_between($web_page, '<meta name="twitter:image" data-react-helmet="true" content="', '">');
    $video["links"][0]["url"] = get_string_between($web_page, '<meta property="og:video:secure_url" data-react-helmet="true" content="', '">');
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($video["links"][0]["url"]);
    $video["links"][0]["quality"] = "hd";
    $video["links"][0]["mute"] = false;
    echo json_encode($video);
}

function orderArray($arrayToOrder, $keys)
{
    $ordered = array();
    foreach ($keys as $key)
    {
        if (isset($arrayToOrder[$key]))
        {
            $ordered[$key] = $arrayToOrder[$key];
        }
    }
    return $ordered;
}

function find_video_id_imdb($url)
{
    preg_match('/vi\d{4,20}/', $url, $match);
    return $match[0];
}

function getImdbDownloadLink($url)
{
    $video_id = find_video_id_imdb($url);
    $embed_url = "https://www.imdb.com/video/imdb/$video_id/imdb/embed";
    $embed_source = get_url_contents($embed_url);
    $video_data = get_string_between($embed_source, '<script class="imdb-player-data" type="text/imdb-video-player-json">', '</script>');
    $video_data = json_decode($video_data, true);
    $video["title"] = get_string_between($embed_source, '<meta property="og:title" content="', '"/>');
    $video["source"] = "imdb";
    $video["thumbnail"] = get_string_between($embed_source, '<meta property="og:image" content="', '">');
    if ($video["title"] != "")
    {
        $streams = $video_data["videoPlayerObject"]["video"]["videoInfoList"];
        $i = 0;
        foreach ($streams as $stream)
        {
            if ($stream["videoMimeType"] == "video/mp4")
            {
                $video["links"][$i]["url"] = $stream["videoUrl"];
                $video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
                $video["links"][$i]["quality"] = "hd";
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
        }
        echo json_encode($video);
    }
    else
    {
        echo json_encode("not working");
    }
}

function getTwitchDownloadLink($url)
{
    $clip_name = get_clip_name($url);
    if ($clip_name === false)
    {
        return false;
    }
    else
    {
        $video["title"] = "Twitch Video Clip from " . get_poster_name($url);
        $video["source"] = "twitch";
        $video["thumbnail"] = "https://blog.twitch.tv/assets/uploads/generic-email-header-1.jpg";
        $api_response = api_request($clip_name);
        $video["links"] = array();
        foreach ($api_response["data"]["clip"]["videoQualities"] as $videoQuality)
        {
            array_push($video["links"], array(
                "url" => $videoQuality["sourceURL"],
                "type" => "mp4",
                "size" => get_file_size($videoQuality["sourceURL"]) ,
                "quality" => $videoQuality["quality"] . "p",
                "mute" => false
            ));
        }
        echo json_encode($video);
    }
}

function get_clip_name($url)
{
    $parsed_url = parse_url($url);
    $path = explode("/", $parsed_url["path"]);
    if (count($path) == 2)
    {
        return $path[1];
    }
    else if ($path[2] == "clip" && isset($path[3]) != "")
    {
        return $path[3];
    }
    else
    {
        return false;
    }
}

function get_poster_name($url)
{
    $parsed_url = parse_url($url);
    $path = explode("/", $parsed_url["path"]);
    if (count($path) == 2)
    {
        return $path[1];
    }
    else if ($path[2] == "clip" && isset($path[3]) != "")
    {
        return $path[1];
    }
    else
    {
        return false;
    }
}

function generate_operation($clip_name)
{
    $operation = array(
        0 => array(
            'operationName' => 'VideoAccessToken_Clip',
            'variables' => array(
                'slug' => $clip_name,
            ) ,
            'extensions' => array(
                'persistedQuery' => array(
                    'version' => 1,
                    'sha256Hash' => '9bfcc0177bffc730bd5a5a89005869d2773480cf1738c592143b5173634b7d15',
                ) ,
            ) ,
        ) ,
    );
    return json_encode($operation);
}

function api_request($clip_name)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://gql.twitch.tv/gql",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => generate_operation($clip_name) ,
        CURLOPT_HTTPHEADER => array(
            "Client-Id: kimne78kx3ncx6brgo4mv6wki5h1ko",
            "Content-Type: application/json"
        ) ,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true) [0];
}

function getTedDownloadLink($url)
{
    $curl_content = get_url_contents($url);
    preg_match_all('/"__INITIAL_DATA__":(.*?)}\)/', $curl_content, $match);
    if (empty($match[1][0]))
    {
        return false;
    }
    $json = json_decode($match[1][0], true);
    $data["source"] = "ted";
    $data["title"] = $json["name"];
    $data["thumbnail"] = $json["talks"][0]["hero"];
    $data["duration"] = gmdate(($json["talks"][0]["duration"] > 3600 ? "H:i:s" : "i:s") , $json["talks"][0]["duration"]);
    $i = 0;
    if (!empty($json["talks"][0]["downloads"]["nativeDownloads"]))
    {
        foreach ($json["talks"][0]["downloads"]["nativeDownloads"] as $quality => $url)
        {
            $data["links"][$i]["url"] = $url;
            $data["links"][$i]["type"] = "mp4";
            $data["links"][$i]["quality"] = $quality;
            $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
            $i++;
        }
    }
    else if (!empty($json["talks"][0]["player_talks"][0]["resources"]["h264"]))
    {
        $data["links"][$i]["url"] = $json["talks"][0]["player_talks"][0]["resources"]["h264"][0]["file"];
        $data["links"][$i]["type"] = "mp4";
        $data["links"][$i]["quality"] = "sd";
        $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
        $i++;
    }
    if (!empty($json["talks"][0]["downloads"]["audioDownload"]))
    {
        $data["links"][$i]["url"] = unshorten($json["talks"][0]["downloads"]["audioDownload"]);
        $data["links"][$i]["type"] = "mp3";
        $data["links"][$i]["quality"] = "128 Kbps";
        $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
    }

    echo json_encode($data);

}

function find_media_id_espn($url)
{
    if (preg_match("/(id=\d{5,20}|id\/\d{5,20}|video\/\d{5,20})/", $url, $match))
    {
        $video_id = (int)filter_var($match[0], FILTER_SANITIZE_NUMBER_INT);
        return $video_id;
    }
}

function getEspnDownloadLink($url)
{
    $media_id = find_media_id_espn($url);
    $api_url = "http://cdn.espn.com/core/video/clip/_/id/" . $media_id . "?xhr=1&device=desktop&country=us&lang=en&region=us&site=espn&edition-host=espn.com&one-site=true&site-type=full";
    $rest_api = get_url_contents($api_url);
    $rest_api = json_decode($rest_api, true);
    $data["title"] = $rest_api["meta"]["title"];
    $data["source"] = "espn";
    $data["thumbnail"] = $rest_api["meta"]["image"];
    $data["duration"] = gmdate(($rest_api["content"]["duration"] > 3600 ? "H:i:s" : "i:s") , $rest_api["content"]["duration"]);
    if (!empty($rest_api["content"]["links"]["source"]))
    {
        $i = 0;
        foreach ($rest_api["content"]["links"]["source"] as $key => $link)
        {
            switch ($key)
            {
                case "href":
                    $data["links"][$i]["url"] = $link;
                    $data["links"][$i]["type"] = "mp4";
                    $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
                    $data["links"][$i]["quality"] = "360p";
                    $data["links"][$i]["mute"] = "no";
                    $i++;
                break;
                case "HD":
                    $data["links"][$i]["url"] = $link["href"];
                    $data["links"][$i]["type"] = "mp4";
                    $data["links"][$i]["size"] = get_file_size($data["links"][$i]["url"]);
                    $data["links"][$i]["quality"] = "720p";
                    $data["links"][$i]["mute"] = "no";
                    $i++;
                break;
            }
        }
        echo json_encode($data);

    }
}

function getFlickrDownloadLink($url)
{
    $page_source = get_url_contents($url);
    preg_match_all('/(.*?)_(.*?)_(.*?).jpg/', $page_source, $secret_key);
    $secret_key = $secret_key[2][0];
    $site_key = get_string_between($page_source, '"site_key":"', '"');
    $media_id = get_string_between($page_source, '"photoId":"', '"');
    $api_url = "https://api.flickr.com/services/rest?photo_id=$media_id&secret=$secret_key&method=flickr.video.getStreamInfo&api_key=$site_key&format=json&nojsoncallback=1";
    $video["title"] = get_string_between($page_source, '<title>', '</title>');
    $video["source"] = "flickr";
    $video["thumbnail"] = get_string_between($page_source, '<meta property="og:image" content="', '"  data-dynamic=');
    if ($media_id != "" && $site_key != "" && $secret_key != "")
    {
        $streams = get_url_contents($api_url);
        $streams = json_decode($streams, true) ["streams"]["stream"];
		for ($i = 0;$i < count($streams);$i++)
        {
            $file_size = get_file_size($streams[$i]["_content"]);
            if (!empty($file_size))
            {
                $video["links"][$i]["url"] = $streams[$i]["_content"];
                $video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["quality"] = $streams[$i]["type"];
                $video["links"][$i]["size"] = $file_size;
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
        }

        echo json_encode($video);
    }
    else
    {
        echo json_encode("not working");
    }
}

function getPinterestDownloadLink($url)
{
    $parsed_url = parse_url($url);
    if ($parsed_url['host'] == 'pin.it')
    {
        $original_url = unshorten($url);
        if (isset($original_url) != "")
        {
            $url = strtok($original_url, '?');
        }
    }
    $page_source = get_url_contents($url);
    $video["title"] = get_string_between($page_source, "<title>", "</title>");
    $video["source"] = "pinterest";
    $video["thumbnail"] = get_string_between($page_source, '"image_cover_url":"', '"');
    $video_data = get_string_between($page_source, '<script id="initial-state" type="application/json">', '</script>');
    $streams = json_decode($video_data, true) ["resourceResponses"][0]["response"]["data"]["videos"]["video_list"];
    if ($streams != "")
    {
        $i = 0;
        foreach ($streams as $stream)
        {
            $ext = pathinfo(parse_url($stream["url"]) ["path"], PATHINFO_EXTENSION);
            if ($ext != "m3u8")
            {
                $video["links"][$i]["url"] = $stream["url"];
                $video["links"][$i]["type"] = $ext;
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
                $video["links"][$i]["quality"] = min($stream["height"], $stream["width"]) . "p";
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
        }
        echo json_encode($video);
    }
    else
    {
        echo json_encode("not working");
    }
}

function getStreamableDownloadLink($url)
{
    $web_page = get_url_contents($url);
    $video_data = get_string_between($web_page, 'var videoObject =', ';');
    $video_data = json_decode($video_data, true);
    if (empty($video_data))
    {
        return false;
    }
    $video["title"] = $video_data["title"];
    $video["source"] = "streamable";
    $video["thumbnail"] = $video_data["thumbnail_url"];
    $video["duration"] = format_seconds((int)ceil($video_data["duration"]));
    $video["links"] = array();
    foreach ($video_data["files"] as $key => $data)
    {
        $url = "https:" . $data["url"];
        array_push($video["links"], array(
            "url" => $url,
            "type" => pathinfo(parse_url($url, PHP_URL_PATH) , PATHINFO_EXTENSION) ,
            "size" => get_file_size($url) ,
            "quality" => $data["height"] . "p",
            "mute" => false
        ));
    }
    echo json_encode($video);

}

function getTwitterDownloadLink($url)
{

    $url = find_id_twitter($url);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://twittervideodownloaderpro.com/twittervideodownloadv2/index.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => array(
            'id' => $url
        ) ,
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($response, true);

    $video["source"] = "twitter";
    $video["title"] = $data['videos'][0]['text'];
    $video["thumbnail"] = $data['videos'][0]['thumb'];

    $i = 0;
    foreach ($data['videos'] as $link)
    {

        $video["links"][$i]["url"] = $link["url"];
        $video["links"][$i]["type"] = "mp4";
        $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
        $video["links"][$i]["quality"] = "HD";
        $video["links"][$i]["mute"] = "no";
        $i++;
    }

    echo json_encode($video);

}

function find_id_twitter($url)
{
    $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
    $last_char = substr($url, -1);
    if ($last_char == "/")
    {
        $url = substr($url, 0, -1);
    }
    switch ($domain)
    {
        case "twitter.com":
            $arr = explode("/", $url);
            return end($arr);
        break;
        case "mobile.twitter.com":
            $arr = explode("/", $url);
            return end($arr);
        break;
        default:
            $arr = explode("/", $url);
            return end($arr);
        break;
    }
}

function getBloggerDownloadLink($url)
{
    $web_page = get_url_contents($url);
    preg_match_all('/src="https:\/\/www.blogger\.com\/video\.g\?token=(.*?)"/', $web_page, $tokens);
    $video["title"] = get_string_between($web_page, '<title>', '</title>');
    $video["source"] = "blogger";
    $video["links"] = array();
    $itags = array(
        5 => array(
            'extension' => 'flv',
            'video' => array(
                'width' => 400,
                'height' => 240,
            ) ,
        ) ,
        6 => array(
            'extension' => 'flv',
            'video' => array(
                'width' => 450,
                'height' => 270,
            ) ,
        ) ,
        13 => array(
            'extension' => '3gp',
        ) ,
        17 => array(
            'extension' => '3gp',
            'video' => array(
                'width' => 176,
                'height' => 144,
            ) ,
        ) ,
        18 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        22 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        34 => array(
            'extension' => 'flv',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        35 => array(
            'extension' => 'flv',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        36 => array(
            'extension' => '3gp',
            'video' => array(
                'width' => 320,
                'height' => 240,
            ) ,
        ) ,
        37 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        38 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 4096,
                'height' => 3072,
            ) ,
        ) ,
        43 => array(
            'extension' => 'webm',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        44 => array(
            'extension' => 'webm',
            'dash' => false,
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        45 => array(
            'extension' => 'webm',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        46 => array(
            'extension' => 'webm',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        59 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        78 => array(
            'extension' => 'mp4',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        82 => array(
            'extension' => 'mp4',
            'video' => array(
                '3d' => true,
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        83 => array(
            'extension' => 'mp4',
            'video' => array(
                '3d' => true,
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        84 => array(
            'extension' => 'mp4',
            'video' => array(
                '3d' => true,
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        85 => array(
            'extension' => 'mp4',
            'video' => array(
                '3d' => true,
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        100 => array(
            'extension' => 'webm',
            'video' => array(
                '3d' => true,
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        101 => array(
            'extension' => 'webm',
            'video' => array(
                '3d' => true,
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        102 => array(
            'extension' => 'webm',
            'video' => array(
                '3d' => true,
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        133 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 426,
                'height' => 240,
            ) ,
        ) ,
        134 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        135 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        136 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        137 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        138 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 4096,
                'height' => 2304,
            ) ,
        ) ,
        394 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 256,
                'height' => 144,
            ) ,
        ) ,
        395 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 426,
                'height' => 240,
            ) ,
        ) ,
        396 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        397 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        398 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        399 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        139 => array(
            'extension' => 'm4a',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 48000,
                'frequency' => 22050,
            ) ,
        ) ,
        140 => array(
            'extension' => 'm4a',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 128000,
                'frequency' => 44100,
            ) ,
        ) ,
        141 => array(
            'extension' => 'm4a',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 256000,
                'frequency' => 44100,
            ) ,
        ) ,
        160 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 256,
                'height' => 144,
            ) ,
        ) ,
        167 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        168 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        169 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        170 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        171 => array(
            'extension' => 'webm',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 128000,
                'frequency' => 44100,
            ) ,
        ) ,
        172 => array(
            'extension' => 'webm',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 192000,
                'frequency' => 44100,
            ) ,
        ) ,
        218 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        219 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        242 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 427,
                'height' => 240,
            ) ,
        ) ,
        243 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 640,
                'height' => 360,
            ) ,
        ) ,
        244 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        245 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        246 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 854,
                'height' => 480,
            ) ,
        ) ,
        247 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        248 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        249 => array(
            'extension' => 'webm',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 50000,
                'frequency' => 48000,
            ) ,
        ) ,
        250 => array(
            'extension' => 'webm',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 65000,
                'frequency' => 48000,
            ) ,
        ) ,
        251 => array(
            'extension' => 'webm',
            'dash' => 'audio',
            'audio' => array(
                'bitrate' => 158000,
                'frequency' => 48000,
            ) ,
        ) ,
        264 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 2560,
                'height' => 1440,
            ) ,
        ) ,
        266 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 3840,
                'height' => 2160,
            ) ,
        ) ,
        271 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                '3d' => false,
                'width' => 2560,
                'height' => 1440,
            ) ,
        ) ,
        272 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 3840,
                'height' => 2160,
            ) ,
        ) ,
        278 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 256,
                'height' => 144,
            ) ,
        ) ,
        298 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        299 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        302 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1280,
                'height' => 720,
            ) ,
        ) ,
        303 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 1920,
                'height' => 1080,
            ) ,
        ) ,
        308 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 2560,
                'height' => 1440,
            ) ,
        ) ,
        313 => array(
            'extension' => 'webm',
            'dash' => 'video',
            'video' => array(
                'width' => 3840,
                'height' => 2026,
            ) ,
        ) ,
        400 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 2560,
                'height' => 1440,
            ) ,
        ) ,
        401 => array(
            'extension' => 'mp4',
            'dash' => 'video',
            'video' => array(
                'width' => 3840,
                'height' => 2160,
            ) ,
        ) ,
    );
    if (empty($tokens[1]))
    {
        return false;
    }
    foreach ($tokens[1] as $iframe_token)
    {
        $iframe_url = "https://www.blogger.com/video.g?token=" . $iframe_token;
        $iframe_page = get_url_contents($iframe_url);
        preg_match_all('/var VIDEO_CONFIG = (.*)/', $iframe_page, $video_data);
        if (!empty(($video_data[1][0]) ??""))
        {
            $video_data = json_decode($video_data[1][0], true);
            if (empty($video["thumbnail"]))
            {
                $video["thumbnail"] = $video_data["thumbnail"];
            }
            foreach ($video_data["streams"] as $stream)
            {
                array_push($video["links"], array(
                    "url" => $stream["play_url"],
                    "type" => $itags[$stream["format_id"]]["extension"],
                    "size" => get_file_size($stream["play_url"]) ,
                    "quality" => $itags[$stream["format_id"]]["video"]["height"] . "p",
                    "mute" => false
                ));
            }
        }
    }
    echo json_encode($video);
}

function get_url_contents_fb($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "authority: www.facebook.com",
        "cache-control: max-age=0",
        "upgrade-insecure-requests: 1",
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        "sec-fetch-site: none",
        "sec-fetch-mode: navigate",
        "sec-fetch-user: ?1",
        "sec-fetch-dest: document"
    ));

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function get_domain($url)
{
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
    {
        return $regs['domain'];
    }
    else
    {
        return false;
    }
}

function getFacebookDownloadLink($url)
{
    $url = unshorten(remove_m($url));
    $curl_content = get_url_contents_fb($url);
    $video["title"] = convert_unicode(get_title($curl_content));
    $video["source"] = "facebook";
    $video["thumbnail"] = get_thumbnail($curl_content);
    $video["links"] = array();
    $sd_link = sd_link($curl_content);
    if (!filter_var($sd_link, FILTER_VALIDATE_URL))
    {
        $sd_link = get_string_between($curl_content, 'property="og:video" content="', '"');
        $sd_link = str_replace("&amp;", "&", $sd_link);
    }
    if (!empty($sd_link))
    {
        array_push($video["links"], array(
            "url" => $sd_link,
            "type" => "mp4",
            "size" => get_file_size($sd_link) ,
            "quality" => "SD",
            "mute" => "no"
        ));
    }
    $hd_link = hd_link($curl_content);
    if (!empty($hd_link))
    {
        array_push($video["links"], array(
            "url" => $hd_link,
            "type" => "mp4",
            "size" => get_file_size($hd_link) ,
            "quality" => "HD",
            "mute" => "no"
        ));
    }
    if (!$GLOBALS['hide_dash_videos'])
    {
        preg_match_all('/"dash_manifest":"(.*)","min_quality_preference"/', $curl_content, $output);
        $formatted = format_page($output[1][0]??"");
        preg_match_all('/FBQualityLabel="(\d{3})p"><BaseURL>(.*?)<\/BaseURL>/', $formatted, $output);
        if (!empty($output[1]) && !empty($output[2]))
        {
            for ($i = 0;$i < count($output[1]);$i++)
            {
                $decoded_url = str_replace("&amp;", "&", $output[2][$i]);
                $decoded_url = str_replace("\/", "/", $decoded_url);
                array_push($video["links"], array(
                    "url" => $decoded_url,
                    "type" => "mp4",
                    "size" => get_file_size($decoded_url) ,
                    "quality" => $output[1][$i] . "p",
                    "mute" => true
                ));
            }

        }
    }
    echo json_encode($video);
}

function change_domain($url)
{
    $domain = get_domain($url);
    $parse_url = parse_url($url);
    switch ($domain)
    {
        case "facebook.com":
            return "https://m.facebook.com" . $parse_url["path"] . "?" . $parse_url["query"];
        break;
        case "m.facebook.com":
            return "https://www.facebook.com" . $parse_url["path"] . "?" . $parse_url["query"];
        break;
        default:
            return "https://www.facebook.com" . $parse_url["path"] . "?" . $parse_url["query"];
        break;
    }
}

function clean_str($str)
{
    return html_entity_decode(strip_tags($str) , ENT_QUOTES, 'UTF-8');
}

function format_page($html)
{
    $html = str_replace("\u003C\/", "</", $html);
    $html = str_replace("\u003C", "<", $html);
    $html = str_replace('\/>', '/>', $html);
    $html = str_replace('\"', '"', $html);
    return $html;
}

function convert_unicode($str)
{
    $str = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match)
    {
        return mb_convert_encoding(pack('H*', $match[1]) , 'UTF-8', 'UCS-2BE');
    }
    , $str);
    return $str;
}

function remove_m($url)
{
    $url = str_replace("m.facebook.com", "www.facebook.com", $url);
    return $url;
}

function mobil_link($curl_content)
{
    $regex = '@&quot;https:(.*?)&quot;,&quot;@si';
    if (preg_match_all($regex, $curl_content, $match))
    {
        return $match[1][0];
    }
    return "";
}

function hd_link($curl_content)
{
    $regex = '/hd_src_no_ratelimit:"([^"]+)"/';
    $playable_url = get_string_between($curl_content, '"playable_url_quality_hd":"', '"');
    if (preg_match($regex, $curl_content, $match))
    {
        return $match[1];
    }
    else if (preg_match('/hd_src:"([^"]+)"/', $curl_content, $match))
    {
        return $match[1];
    }
    else if (!empty($playable_url))
    {
        return str_replace("\/", "/", $playable_url);
    }
    return "";
}

function sd_link($curl_content)
{
    $regex = '/sd_src_no_ratelimit:"([^"]+)"/';
    $playable_url = get_string_between($curl_content, '"playable_url":"', '"');
    if (preg_match($regex, $curl_content, $match))
    {
        return $match[1];
    }
    else
    {
        $mobil_link = mobil_link($curl_content);
        if (!empty($mobil_link))
        {
            return $mobil_link;
        }
        else if (!empty($playable_url))
        {
            return str_replace("\/", "/", $playable_url);
        }
    }
    return "";
}

function get_title($curl_content)
{
    $og_title = get_string_between($curl_content, 'property="og:title" content="', '"');
    $page_title = get_string_between($curl_content, '<title id="pageTitle">', '</title>');
    $json_title = get_string_between($curl_content, '"is_show_video":false,"name":"', '"');
    if (!empty($og_title))
    {
        return $og_title;
    }
    else if (!empty($page_title))
    {
        return $page_title;
    }
    else if (!empty($json_title))
    {
        return $json_title;
    }
    else
    {
        return "Facebook Video";
    }
}

function get_thumbnail($curl_content)
{
    $json_thumbnail = get_string_between($curl_content, '"thumbnailImage":{"uri":"', '"');
    if (preg_match('/og:image"\s*content="([^"]+)"/', $curl_content, $match))
    {
        return str_replace("amp;", "", urldecode($match[1]));
    }
    else if (preg_match('@<meta property="twitter:image" content="(.*?)" />@si', $curl_content, $match))
    {
        return str_replace("amp;", "", urldecode($match[1]));
    }
    else if (!empty($json_thumbnail))
    {
        return str_replace("amp;", "",str_replace("\/", "/", urldecode($json_thumbnail)));
    }
    else
    {
        return "https://www.facebook.com/images/fb_icon_325x325.png";
    }


}

function getInstagramDownloadLink($url)
{
    /*  if (strpos($url, "https://www.instagram.com/p") === 0 || strpos($url, "https://instagram.com/p") === 0) {
            $url = str_replace($url, "http", "https");
        }*/

    //$url = str_replace( 'http://', 'https://', $url );
    

    //$url= 'http://www.instagram.com/p/CGsJuGQhbS4/?igshid=ps66jzshfpln';
    //echo $url;
    $GLOBALS['post_page'] = get_url_contents_insta($url);
    $media_info = media_data_insta($GLOBALS['post_page']);
    $video["title"] = get_title_insta($GLOBALS['post_page']);
    $video["source"] = "instagram";
    $video["thumbnail"] = get_thumbnail_insta($GLOBALS['post_page']);
    $i = 0;
    foreach ($media_info["links"] as $link)
    {
        switch ($link["type"])
        {
            case "video":
                $video["links"][$i]["url"] = $link["url"];
                $video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
                $video["links"][$i]["quality"] = "HD";
                $video["links"][$i]["mute"] = "no";
                $i++;
            break;
            case "image":
                $video["links"][$i]["url"] = $link["url"];
                $video["links"][$i]["type"] = "jpg";
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
                $video["links"][$i]["quality"] = "HD";
                $video["links"][$i]["mute"] = "yes";
                $i++;
            break;
            default:
            break;
        }
    }
    echo json_encode($video);
}

function media_info_beta_insta($url)
{
    $GLOBALS['post_page'] = get_url_contents($url);
    $video["title"] = get_title_insta($GLOBALS['post_page']);
    $video["source"] = "instagram";
    $video["thumbnail"] = get_string_between($GLOBALS['post_page'], '"display_url":"', '"');
    $video["thumbnail"] = str_replace("\u0026", "&", $video["thumbnail"]);
    $video["links"][0]["url"] = getVideoUrl_insta();
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($video["links"]["0"]["url"]);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["mute"] = "no";
    echo json_encode($video);
}

function getPostShortcode_insta($url)
{
    if (substr($url, -1) != '/')
    {
        $url .= '/';
    }
    preg_match('/\/(p|tv)\/(.*?)\//', $url, $output);
    return ($output['2']??'');
}

function getVideoUrl_insta($postShortcode = "")
{
    //$pageContent = $get_url_contents('https://www.instagram.com/p/' . $postShortcode);
    preg_match_all('/"video_url":"(.*?)",/', $GLOBALS['post_page'], $out);
    if (!empty($out[1][0]))
    {
        return str_replace('\u0026', '&', $out[1][0]);
    }
    else
    {
        return null;
    }
}

function get_url_contents_insta($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function media_data_insta($instagram_post_page)
{

    $value1 = 'window._sharedData =';
    //  $json = $matches[1][0];
    //$json = get_string_between($instagram_post_page, $value1, '}');
    //	 echo json_encode($json);
    

    preg_match_all("/window._sharedData = (.*);/", $instagram_post_page, $matches);
    if (!$matches)
    {
        return false;
    }
    else
    {
        $json = $matches[1][0];
        $data = json_decode($json, true);

        //echo json_encode($json);
        if ($data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['__typename'] == "GraphImage")
        {
            $imagesdata = $data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['display_resources'];
            $length = count($imagesdata);
            $media_info['links'][0]['type'] = 'image';
            $media_info['links'][0]['url'] = $imagesdata[$length - 1]['src'];
            $media_info['links'][0]['status'] = 'success';
        }
        else
        {
            if ($data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['__typename'] == "GraphSidecar")
            {
                $counter = 0;
                $multipledata = $data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['edge_sidecar_to_children']['edges'];
                foreach ($multipledata as & $media)
                {
                    if ($media['node']['is_video'] == "true")
                    {
                        $media_info['links'][$counter]["url"] = $media['node']['video_url'];
                        $media_info['links'][$counter]["type"] = 'video';
                    }
                    else
                    {
                        $length = count($media['node']['display_resources']);
                        $media_info['links'][$counter]["url"] = $media['node']['display_resources'][$length - 1]['src'];
                        $media_info['links'][$counter]["type"] = 'image';
                    }
                    $counter++;
                    $media_info['type'] = 'media';
                }
                $media_info['status'] = 'success';
            }
            else
            {
                if ($data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['__typename'] == "GraphVideo")
                {
                    $videolink = $data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['video_url'];
                    $media_info['links'][0]['type'] = 'video';
                    $media_info['links'][0]['url'] = $videolink;
                    $media_info['links'][0]['status'] = 'success';
                }
                else
                {
                    $media_info['links']['status'] = 'fail';
                }
            }
        }
        $owner = $data['entry_data']['PostPage'][0]['graphql']['shortcode_media']['owner'];
        $media_info['username'] = $owner['username'];
        $media_info['full_name'] = $owner['full_name'];
        $media_info['profile_pic_url'] = $owner['profile_pic_url'];
        return $media_info;
    }
}

function get_thumbnail_insta($instagram_post_page)
{
    preg_match_all("/<meta property=\"og:image\" content=\"(.*)\"/", $instagram_post_page, $matches);
    if (!$matches)
    {
        return false;
    }
    $json = $matches[1][0];
    $data = json_decode($json, true);

    //echo json_encode($data.$json);
    return $json;
}

function get_title_insta($curl_content)
{
    if (preg_match_all('@<title>(.*?)</title>@si', $curl_content, $match))
    {
        return $match[1][0];
    }
}

function getTiktokDownloadLink($url)
{
	
	
	try{
	

    $json = get_url_contents('https://api.wppress.net/tiktok?url=' . $url);

    $mydata = json_decode($json, true);

    $video = [];
if(!isset($mydata["error"])){
    $video["title"] = $mydata['desc'];

    $video["source"] = "tiktok";
    $video["thumbnail"] = $mydata['video']['cover'];
    $video["duration"] = '00:' . $mydata['video']['duration'];

    $video["links"][0]["url"] = $mydata['video']["noWatermark"];
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($mydata['video']["noWatermark"]);
    $video["links"][0]["quality"] = $mydata['video']['ratio'];
    $video["links"][0]["musicurl"] = $mydata["music"]["playUrl"];
    $video["links"][0]["mute"] = "no";

    echo json_encode($video);
}else{
	
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://savetik.app/go.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('url' => $url),
));

$response = curl_exec($curl);

curl_close($curl);
   $response =  json_decode($response,true);
if($response['status'] == "success"){
   $video["title"] = "tiktok";

    $video["source"] = "tiktok";
    $video["thumbnail"] = "https://media-exp1.licdn.com/dms/image/C510BAQGCdThXIss7UQ/company-logo_200_200/0?e=2159024400&v=beta&t=h5QivKp9OClEU91o3_efRvFS_oFbMa0PtjK516qn51A";
    $video["duration"] = "00:00";

    $video["links"][0]["url"] = $response['vUrl'];
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($response['vUrl']);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["musicurl"] = "";
    $video["links"][0]["mute"] = "no";

echo json_encode($video);}else{
	
	
	
	
	
	
	
	
	
	 echo json_encode("not working");
			}
}

}catch(Exception  $e){
	
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://savetik.app/go.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('url' => $url),
));

$response = curl_exec($curl);

curl_close($curl);

if($response['status'] == "success"){
   $video["title"] = "tiktok";

    $video["source"] = "tiktok";
    $video["thumbnail"] = "https://media-exp1.licdn.com/dms/image/C510BAQGCdThXIss7UQ/company-logo_200_200/0?e=2159024400&v=beta&t=h5QivKp9OClEU91o3_efRvFS_oFbMa0PtjK516qn51A";
    $video["duration"] = "00:00";

    $video["links"][0]["url"] = $response['vUrl'];
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($response['vUrl']);
    $video["links"][0]["quality"] = "HD";
    $video["links"][0]["musicurl"] = "";
    $video["links"][0]["mute"] = "no";

echo json_encode($video);}else{
	
	
	
	
	
	
	
	
	
	 echo json_encode("not working");
			}
}

}

function getBilibiliDownloadLink($url)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.bilibili.com/video/BV1oK411V7XL",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cookie: buvid3=E84BC091-0DD7-E4CE-9FA1-5ABE1F38F2AC28854infoc; main_confirmation=JEsW2cN9+ErQTVjAmipUhllnSofJL2PtodNSxXNVQAI="
        ) ,
    ));

    $web_page = curl_exec($curl);

    curl_close($curl);

    $video_data = get_string_between($web_page, '__playinfo__=', '</script>');

    $mydata = json_decode($video_data, true);

    $video = [];

    $video["title"] = $mydata['data']['result'];

    $video["source"] = "bilibili";
    $video["thumbnail"] = $mydata['data']['support_formats'][0]['new_description'];
    $video["duration"] = $mydata['data']['timelength'];

    $video["links"][0]["url"] = $mydata['data']['dash']['video'][0]['base_url'];
    $video["links"][0]["type"] = "mp4";
    $video["links"][0]["size"] = get_file_size($mydata['data']['dash']['video'][0]['base_url']);
    $video["links"][0]["quality"] = $mydata['data']['dash']['video'][0]['height'];
    $video["links"][0]["mute"] = "yes";

    echo json_encode($video);

}

/*
		<video loop="loop" webkit-playsinline="true" src="https://video.like.video/eu_live/5uP/2MV0Q4_4.mp4?crc=3178442147&amp;type=5" poster="http://videosnap.like.video/eu_live/5uW/250nAz_4.jpg?wmk_sdk=1&amp;type=8" autoplay="autoplay" __idm_id__="60003330"></video>
		
		
		
		
		
		<a class="btn btn-primary download_link with_watermark" target="_blank" href="https://video.like.video/eu_live/5uM/2OUVHe_4.mp4?crc=2688258856&amp;type=5" download="">Download</a>
*/

function getdownloadof_likee($url)
{

    $newStr = "https://likeedownloader.com/results?id=" . str_replace("com", "video", $url);

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $newStr,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Cookie: __cfduid=d6cbe332f0d3baad238c664c893c1bf041603700855; lang=en; PHPSESSID=6fea3252f4af9f84c34f02576d88e65e"
        ) ,
    ));

    $page_source = curl_exec($curl);

    curl_close($curl);
    //echo $response;
   






//$html = file_get_contents($url);



   preg_match('@<span class=\'likee_text\'>(.*?)</span>@si', $page_source, $match);
  
		$video['title'] = urldecode($match[1]);
	

			
            $video["source"] = "likee";
            $video['duration'] = "00:00";
			 preg_match('@<img src=\'(.*?)\'></div>@si', $page_source, $match1);
            $video['thumbnail'] = urldecode($match1[1]);
			
			
			preg_match('@href=\'(.*?)download>@si', $page_source, $match2);
	


	
	// $item1 = substr($match2[0], strpos($match2[0],"href='"), strpos($match2[0],"'"));
	 $item1 = get_string_between($match2[0], 'href=\'', '\'');
	 
	 
	
 $item1 =str_replace("_4","",$item1);
	 
	 $item2 = substr($match2[1], 0, strpos($match2[1],"'"));
	
				$video["links"][0]["url"] = $item1;
				
				
				
                $video["links"][0]["type"] = "mp4";
                $video["links"][0]["size"] = get_file_size($item1);
                $video["links"][0]["quality"] = "with watermark";
                $video["links"][0]["mute"] = "no";
				
				
				$video["links"][1]["url"] = $item2;
				
				
				
                $video["links"][1]["type"] = "mp4";
                $video["links"][1]["size"] = get_file_size($item2);
                $video["links"][1]["quality"] = "without watermark";
                $video["links"][1]["mute"] = "no";

	 		echo json_encode($video);

         





/*




    //echo $page_source;
    

    //https://likeedownloader.com/results?id=https://l.likee.video/v/mGSGzB
    //https://videosnap.like.video/eu_live/5uT/2BRjid_1.jpg  cover url
    //https://video.like.video/eu_live/5uM/2OUVHe_4.mp4   video url
    

    preg_match_all('/"name":"(.*?)"/', $page_source, $videotitle);
    preg_match_all('/"thumbnailUrl":\["(.*?)"\]/', $page_source, $videothumb);
    preg_match_all('/"duration":"(.*?)"\,/', $page_source, $videoduration);

    //preg_match_all('/(https)(.*)/', $page_source, $secret_key);
    preg_match_all('/(Without watermark\")(.*)/s', $page_source, $secret_key);

    //echo json_encode($secret_key);
    //echo json_encode(get_string_between($page_source, 'src=\"https:', '\"'));
    // $secret_key = $secret_key[1][0];
    //preg_match_all('/(https:\/\/video)(.*)(like)(.*)(video\/eu_live\/)(.*)/s', $page_source,$matches);
    

    //preg_match_all("/<video(.*)<\/video>/U", $page_source,$matches);
    

    //  $web_page = get_url_contents($url);
    

    //  $video_data = get_string_between($string2, 'Without watermark<\/td> \r', 'mp4');
    echo json_encode($secret_key);

    $json = file_get_contents($url);

    $value = strstr($json, "<video"); //gets all text from needle on
    //$value = strstr($value, ">", true);
    

    if (empty($video_data))
    {
        return false;
    }
    $video["title"] = $video_data["title"];
    $video["source"] = "streamable";
    $video["thumbnail"] = $video_data["thumbnail_url"];
    $video["duration"] = format_seconds((int)ceil($video_data["duration"]));
    $video["links"] = array();
    foreach ($video_data["files"] as $key => $data)
    {
        $url = "https:" . $data["url"];
        array_push($video["links"], array(
            "url" => $url,
            "type" => pathinfo(parse_url($url, PHP_URL_PATH) , PATHINFO_EXTENSION) ,
            "size" => get_file_size($url) ,
            "quality" => $data["height"] . "p",
            "mute" => false
        ));
    }
    echo json_encode($video);
*/
}


  function find_video_id_vimeo($url)
    {
        if (preg_match_all('/https:\/\/vimeo.com\/(channels|([^"]+))(\/staffpicks\/([^"]+)|)/', $url, $match)) {
            if (is_numeric($match[1][0])) {
                return $match[1][0];
            } else if (is_numeric($match[4][0])) {
                return $match[4][0];
            }
        }
    }




	function get_url_contents_vimeo($url)
{

    // session_start();
    // $cookie_file_name = $_SESSION["token"] . ".txt";
    //  $cookie_file = join(DIRECTORY_SEPARATOR, [sys_get_temp_dir(), $cookie_file_name]);
	
	
	$username = '';
	$password= '';
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

   /*
        curl_setopt($ch, CURLOPT_PROXY, "103.81.214.254:83");
        curl_setopt($ch, CURLOPT_PROXYTYPE, "HTTPS");
        if (!empty($username) && !empty($password)) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $username . ":" . $password);
        }
        $chunkSize = 1000000;
        curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
    
*/
  
    $data = curl_exec($ch);
    curl_close($ch);
	//echo "fsdfsdffsdf".$data;
    return $data;
	
}

function getvimeoDownloadLink($url){
	
	
	 $web_page = get_url_contents_vimeo($url);
	
        if (preg_match_all('/window.vimeo.clip_page_config.player\s*=\s*({.+?})\s*;\s*\n/', $web_page, $match)) {
            $config_url = json_decode($match[1][0], true)["config_url"];
            $result = json_decode(get_url_contents($config_url), true);
            $video['title'] = $result["video"]["title"];
            $video["source"] = "vimeo";
            $video['duration'] = gmdate(($result["video"]["duration"] > 3600 ? "H:i:s" : "i:s"), $result["video"]["duration"]);
            $video['thumbnail'] = reset($result["video"]["thumbs"]);
            $i = 0;
            foreach ($result["request"]["files"]["progressive"] as $current) {
                $video["links"][$i]["url"] = $current["url"];
                $video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
                $video["links"][$i]["quality"] = $current["quality"];
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
    echo json_encode($video);
        } else {
    echo json_encode("not working");
        }
		

}


function getalphapronoDownloadLink($url){
	
	
	$html = file_get_contents($url);
$dom = new DOMDocument;
@$dom->loadHTML($html);

$links = $dom->getElementsByTagName('source');


   preg_match('@<meta name="twitter:title" content="(.*?)">@si', $html, $match);
  
		$video['title'] = urldecode($match[1]);
	

			
            $video["source"] = "alphaporno";
            $video['duration'] = "00:00";
			 preg_match('@<meta name="twitter:image" content="(.*?)">@si', $html, $match1);
            $video['thumbnail'] = urldecode($match1[1]);
$i=0;
foreach ($links as $link){
    $item =  $link->getAttribute('src');
	
	 $item = substr($item, 0, strpos($item,"/?br="));
	
				$video["links"][$i]["url"] = $item;
				
				
				
                $video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["size"] = get_file_size($item);
                $video["links"][$i]["quality"] = "HD";
                $video["links"][$i]["mute"] = "no";
	$i++;
}
	 		echo json_encode($video);

         

}



function get20min_chDownloadLink($url){
	
	
	//$html = get_url_contents($url);


	
	$html = file_get_contents($url);
$dom = new DOMDocument;
@$dom->loadHTML($html);

$links = $dom->getElementById("__NEXT_DATA__");



$onelink = $links->nodeValue;
//echo json_encode($onelink);

   //preg_match('@<script id="__NEXT_DATA__" type="application/json">(.*?)</script>@si', $html, $match);
   
   
   
   $match  =  get_string_between($html, '<script id="__NEXT_DATA__" type="application/json">', '</script>');
   
   echo $match;
   preg_match('@<meta property="og:title" content="(.*?)">@si', $html, $match1);
  
  
  $allmatch = json_decode($match[1]);
  
  
  //	echo json_encode($match);
  
		$video['title'] = $match1[1];
	

			
            $video["source"] = "20min.ch";
            $video['duration'] = "00:00";
			

			 preg_match('@<meta property="og:image" content="(.*?)">@si', $html, $match2);
            $video['thumbnail'] = urldecode($match2[1]);

$videoElement= $allmatch['props']['data']['content']['video']['content']['elements'][0]['content']['elements'][0];

				$video["links"][0]["url"] = $videoElement['url_high'];
                $video["links"][0]["type"] = "mp4";
                $video["links"][0]["size"] = get_file_size($videoElement['url_high']);
                $video["links"][0]["quality"] = "HD";
                $video["links"][0]["mute"] = "no";
				
				$video["links"][0]["url"] = $videoElement['url_low'];
                $video["links"][0]["type"] = "mp4";
                $video["links"][0]["size"] = get_file_size($videoElement['url_low']);
                $video["links"][0]["quality"] = "HD";
                $video["links"][0]["mute"] = "no";	
	

	 		//echo json_encode($video);

        

}












function check_file_exists_here($url){
   $result=get_headers($url);
   return stripos($result[0],"200 OK")?true:false; //check if $result[0] has 200 OK
}












function getyoutubeDownloadLink($youtubeURL){
	
	
	
	$pathtoclass = $_GET['weburl']."YouTubeDownloader.class.php";

	
if(!check_file_exists_here($pathtoclass)){
die("youtube class not found");
}

	


 
if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){ 
    $downloader =$GLOBALS['handler']->getDownloader($youtubeURL); 
     

    $downloader->setUrl($youtubeURL); 
     
	 
	 
	 
    if($downloader->hasVideo()){ 
        $videoDownloadLink = $downloader->getVideoDownloadLink(); 
        
	       
		  $video['title'] = $videoDownloadLink[0]['title'];
		  $video["source"] = "Youtube";
            $video['duration'] = gmdate("s:i", $videoDownloadLink[0]['approxDurationMs'] / 60000);
			$thumbid = extractVideoId($youtubeURL); 
            $video['thumbnail'] = "https://i.ytimg.com/vi/".$thumbid."/mqdefault.jpg";
		  
		  if(false){
			  
            
            $i = 0;
            foreach ($videoDownloadLink as $current) {
                $video["links"][$i]["url"] = $current["url"];
                
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
				
				if(!empty($videoDownloadLink[$i]["qualityLabel"])){
				$video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["quality"] = $videoDownloadLink[$i]["qualityLabel"];
				}else if(!empty($videoDownloadLink[$i]["quality"])){
					$video["links"][$i]["type"] = "mp4";
					 $video["links"][$i]["quality"] = $videoDownloadLink[$i]["quality"];
					
				}
				
				if(!empty($videoDownloadLink[$i]["audioQuality"])){
					$video["links"][$i]["type"] = "mp3";
					 $video["links"][$i]["quality"] = $videoDownloadLink[$i]["audioQuality"];
					
				}
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
	 /*
        if(!empty($downloadURL)){ 
            // Define header for force download 
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$fileName"); 
            header("Content-Type: application/zip"); 
            header("Content-Transfer-Encoding: binary"); 
             
            // Read the file 
            readfile($downloadURL); 
        } 
		*/
		
		echo json_encode($video);
	 
	 
		  }else{
			 // echo json_encode("not work");
			  //https://youtube-downloader3.herokuapp.com/video_info.php?url=https://www.youtube.com/watch?v=jHNNMj5bNQw
			  	//$response = file_get_contents("https://youtube-downloader3.herokuapp.com/video_info.php?url=".$youtubeURL);
			  	$response = file_get_contents($_GET['weburl']."/ytdtest.php?url=".$youtubeURL);


			    $response = json_decode($response, true);
				
			/*	
				  $video["source"] = "Youtube";
            $video['duration'] = "00:00";
			$thumbid = extractVideoId($youtubeURL); 
            $video['thumbnail'] = "https://i.ytimg.com/vi/".$thumbid."/mqdefault.jpg";
            
			*/
			
			  $links = $response["links"];
			$video["links"] = array();
        $itags = array(18 => array('type' => 'mp4', 'itag' => 18, 'quality' => '360p', 'mute' => false), 22 => array('type' => 'mp4', 'itag' => 22, 'quality' => '720p', 'mute' => false), 91 => array('type' => 'ts', 'itag' => 91, 'quality' => '144p', 'mute' => false), 92 => array('type' => 'ts', 'itag' => 92, 'quality' => '240p', 'mute' => false), 93 => array('type' => 'ts', 'itag' => 93, 'quality' => '360p', 'mute' => false), 94 => array('type' => 'ts', 'itag' => 94, 'quality' => '480p', 'mute' => false), 95 => array('type' => 'ts', 'itag' => 95, 'quality' => '720p', 'mute' => false), 96 => array('type' => 'ts', 'itag' => 96, 'quality' => '1080p', 'mute' => false), 133 => array('type' => 'mp4', 'itag' => 133, 'quality' => '240p', 'mute' => true), 134 => array('type' => 'mp4', 'itag' => 134, 'quality' => '360p', 'mute' => true), 135 => array('type' => 'mp4', 'itag' => 135, 'quality' => '480p', 'mute' => true), 136 => array('type' => 'mp4', 'itag' => 136, 'quality' => '720p', 'mute' => true), 137 => array('type' => 'mp4', 'itag' => 137, 'quality' => '1080p', 'mute' => true), 138 => array('type' => 'mp4', 'itag' => 138, 'quality' => '4320p', 'mute' => true), 139 => array('type' => 'm4a', 'itag' => 139, 'quality' => '48kbps', 'mute' => false), 140 => array('type' => 'm4a', 'itag' => 140, 'quality' => '128kbps', 'mute' => false), 160 => array('type' => 'mp4', 'itag' => 160, 'quality' => '144p', 'mute' => true), 242 => array('type' => 'webm', 'itag' => 242, 'quality' => '240p', 'mute' => true), 243 => array('type' => 'webm', 'itag' => 243, 'quality' => '360p', 'mute' => true), 244 => array('type' => 'webm', 'itag' => 244, 'quality' => '480p', 'mute' => true), 247 => array('type' => 'webm', 'itag' => 247, 'quality' => '720p', 'mute' => true), 248 => array('type' => 'webm', 'itag' => 248, 'quality' => '1080p', 'mute' => true), 249 => array('type' => 'webm', 'itag' => 249, 'quality' => '48kbps', 'mute' => false), 250 => array('type' => 'webm', 'itag' => 250, 'quality' => '64kbps', 'mute' => false), 251 => array('type' => 'webm', 'itag' => 251, 'quality' => '160kbps', 'mute' => false), 264 => array('type' => 'mp4', 'itag' => 264, 'quality' => '1440p', 'mute' => true), 266 => array('type' => 'mp4', 'itag' => 266, 'quality' => '2160p', 'mute' => true), 271 => array('type' => 'webm', 'itag' => 271, 'quality' => '1440p', 'mute' => true), 272 => array('type' => 'webm', 'itag' => 272, 'quality' => '4320p60', 'mute' => true), 278 => array('type' => 'webm', 'itag' => 278, 'quality' => '144p', 'mute' => true), 298 => array('type' => 'mp4', 'itag' => 298, 'quality' => '720p60', 'mute' => true), 299 => array('type' => 'mp4', 'itag' => 299, 'quality' => '1080p60', 'mute' => true), 300 => array('type' => 'mp4', 'itag' => 300, 'quality' => '720p60', 'mute' => false), 301 => array('type' => 'mp4', 'itag' => 301, 'quality' => '1080p60', 'mute' => false), 302 => array('type' => 'webm', 'itag' => 302, 'quality' => '720p60', 'mute' => true), 303 => array('type' => 'webm', 'itag' => 303, 'quality' => '1080p60', 'mute' => true), 304 => array('type' => 'mp4', 'itag' => 304, 'quality' => '1440p60', 'mute' => true), 305 => array('type' => 'mp4', 'itag' => 305, 'quality' => '2160p60', 'mute' => true), 308 => array('type' => 'webm', 'itag' => 308, 'quality' => '1440p60', 'mute' => true), 313 => array('type' => 'webm', 'itag' => 313, 'quality' => '2160p', 'mute' => true), 315 => array('type' => 'webm', 'itag' => 315, 'quality' => '2160p60', 'mute' => true), 327 => array('type' => 'm4a', 'itag' => 327, 'quality' => 'kbps', 'mute' => false), 330 => array('type' => 'webm', 'itag' => 330, 'quality' => '144p60 HDR', 'mute' => true), 331 => array('type' => 'webm', 'itag' => 331, 'quality' => '240p60 HDR', 'mute' => true), 332 => array('type' => 'webm', 'itag' => 332, 'quality' => '360p60 HDR', 'mute' => true), 333 => array('type' => 'webm', 'itag' => 333, 'quality' => '480p60 HDR', 'mute' => true), 334 => array('type' => 'webm', 'itag' => 334, 'quality' => '720p60 HDR', 'mute' => true), 335 => array('type' => 'webm', 'itag' => 335, 'quality' => '1080p60 HDR', 'mute' => true), 336 => array('type' => 'webm', 'itag' => 336, 'quality' => '1440p60 HDR', 'mute' => true), 337 => array('type' => 'webm', 'itag' => 337, 'quality' => '2160p60 HDR', 'mute' => true), 338 => array('type' => 'webm', 'itag' => 338, 'quality' => 'kbps', 'mute' => false), 386 => array('type' => 'm4a', 'itag' => 386, 'quality' => 'kbps', 'mute' => false), 387 => array('type' => 'm4a', 'itag' => 387, 'quality' => 'kbps', 'mute' => false), 394 => array('type' => 'mp4', 'itag' => 394, 'quality' => '144p', 'mute' => true), 395 => array('type' => 'mp4', 'itag' => 395, 'quality' => '240p', 'mute' => true), 396 => array('type' => 'mp4', 'itag' => 396, 'quality' => '360p', 'mute' => true), 397 => array('type' => 'mp4', 'itag' => 397, 'quality' => '480p', 'mute' => true), 398 => array('type' => 'mp4', 'itag' => 398, 'quality' => '720p60', 'mute' => true), 399 => array('type' => 'mp4', 'itag' => 399, 'quality' => '1080p60', 'mute' => true), 400 => array('type' => 'mp4', 'itag' => 400, 'quality' => '1440p60', 'mute' => true), 401 => array('type' => 'mp4', 'itag' => 401, 'quality' => '2160p60', 'mute' => true), 402 => array('type' => 'mp4', 'itag' => 402, 'quality' => '4320p60', 'mute' => true), 571 => array('type' => 'mp4', 'itag' => 571, 'quality' => '4320p60', 'mute' => true));
  
			
			
			  foreach ($links as $link) {
            if (!empty($itags[($link["itag"] ?? "")])) {
                //$is_audio = (isset($itags[$link["itag"]]["video"]) != "") ? false : true;
                //$is_dash = isset($itags[$link["itag"]]["dash"]) != "";
                //$type = ($is_audio && $this->m4a_mp3 && $itags[$link["itag"]]["extension"] == "m4a") ? "mp3" : $itags[$link["itag"]]["extension"];
                //$file_size = get_file_size($link["url"], false, false);
               
                $file_size = get_file_size($link["url"]);
               
                //$quality = (!$is_audio) ? $itags[$link["itag"]]["video"]["height"] . "p" : format_bitrate($itags[$link["itag"]]["audio"]["bitrate"]);
                if ($itags[$link["itag"]]["mute"] && $GLOBALS['hide_dash_videos']) {
                    $is_hidden = true;
                } else {
              		if($itags[$link["itag"]]["mute"]){
                    array_push($video["links"], array(
                        "url" => $link["url"],
                        "type" => $itags[$link["itag"]]["type"],
                    
                        "quality" => $itags[$link["itag"]]["quality"]."(no audio)",
                        "mute" => $itags[$link["itag"]]["mute"],
                        "size" => $file_size
                    ));
					}else{
						
						array_push($video["links"], array(
                        "url" => $link["url"],
                        "type" => $itags[$link["itag"]]["type"],
                    
                        "quality" => $itags[$link["itag"]]["quality"],
                        "mute" => $itags[$link["itag"]]["mute"],
                        "size" => $file_size
                    ));
					}
                    if ($GLOBALS['m4a_mp3'] && $itags[$link["itag"]]["type"] == "m4a") {
                        array_push($video["links"], array(
                            "url" => $link["url"],
                            "type" => "mp3",
                           
                            "quality" => $itags[$link["itag"]]["quality"],
                            "mute" => $itags[$link["itag"]]["mute"],
                            "size" => $file_size
                        ));
                    }
                }
            }
        }
       // usort($video["links"], 'sort_by_quality');
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			/*
			$i = 0;
            foreach ($response['links'] as $current) {
                $video["links"][$i]["url"] = $current["url"];
                
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
				
				if(!empty($current["format"])){
				$video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["quality"] = $current["format"];
				}
				
				
				if(!empty($videoDownloadLink[$i]["audioQuality"])){
					$video["links"][$i]["type"] = "mp3";
					 $video["links"][$i]["quality"] = $videoDownloadLink[$i]["audioQuality"];
					
				}
                $video["links"][$i]["mute"] = "no";
                $i++;
            }

		  }
	 */
	 
	  echo json_encode($video);
	}
    }else{ 
       echo json_encode("not working");
    } 
}else{ 
    echo json_encode("not working");
} 
}








 function calculate_video_size($itag, $duration)
    {
        $reference_duration = 3221;
        $reference_sizes = [
            "249" => 20401121,
            "250" => 27038123,
            "140" => 52127912,
            "394" => 25683927,
            "278" => 32759389,
            "160" => 18337619,
            "251" => 53123830,
            "395" => 48886254,
            "242" => 62683866,
            "133" => 41932753,
            "134" => 144272120,
            "396" => 99801940,
            "243" => 127107404,
            "18" => 252908754,
            "244" => 246450788,
            "135" => 324295771,
            "397" => 198229761,
            "22" => 774335049,
            "398" => 435093541,
            "247" => 528682502,
            "136" => 722450659,
            "399" => 792493924,
            "248" => 963643999,
            "137" => 1419248836,
            "400" => 2747571150,
            "271" => 3134539217,
            "313" => 6715225612,
            "401" => 5770829704,
            "299" => 792093924,
            "303" => 772493924,
            "298" => 435063541,
            "302" => 432083541
        ];
        if (isset($reference_sizes[$itag]) == "") {
            return "";
        }
        $size = ($reference_sizes[$itag] / $reference_duration) * $duration;
        return format_size($size);
    }







    function extractVideoId($video_url){ 
        //parse the url 
        $parsed_url = parse_url($video_url); 
        if($parsed_url["path"] == "youtube.com/watch"){ 
            $video_url = "https://www.".$video_url; 
        }elseif($parsed_url["path"] == "www.youtube.com/watch"){ 
            $video_url = "https://".$video_url; 
        } 
         
        if(isset($parsed_url["query"])){ 
            $query_string = $parsed_url["query"]; 
            //parse the string separated by '&' to array 
            parse_str($query_string, $query_arr); 
            if(isset($query_arr["v"])){ 
                return $query_arr["v"]; 
            } 
        }    
    }




 

function getyoutubePlaylistDownloadLink($youtubeURL){

 
 
if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){ 
    $downloader =$GLOBALS['handler']->getDownloader($youtubeURL); 
     

    $downloader->setUrl($youtubeURL); 
     
	 
	 
	 
    if($downloader->hasVideo()){ 
        $videoDownloadLink = $downloader->getVideoDownloadLink(); 

	
		  $video['title'] = $videoDownloadLink[0]['title'];
            $video["source"] = "Youtube";
            $video['duration'] = gmdate("s:i", $videoDownloadLink[0]['approxDurationMs'] / 60000);
            $video['thumbnail'] = "https://cdn.iconscout.com/icon/free/png-256/youtube-85-226402.png";
            $i = 0;
            foreach ($videoDownloadLink as $current) {
                $video["links"][$i]["url"] = $current["url"];
                
                $video["links"][$i]["size"] = get_file_size($video["links"][$i]["url"]);
				
				if(!empty($videoDownloadLink[$i]["qualityLabel"])){
				$video["links"][$i]["type"] = "mp4";
                $video["links"][$i]["quality"] = $videoDownloadLink[$i]["qualityLabel"];
				}else if(!empty($videoDownloadLink[$i]["quality"])){
					$video["links"][$i]["type"] = "mp4";
					 $video["links"][$i]["quality"] = $videoDownloadLink[$i]["quality"];
					
				}
				
				if(!empty($videoDownloadLink[$i]["audioQuality"])){
					$video["links"][$i]["type"] = "mp3";
					 $video["links"][$i]["quality"] = $videoDownloadLink[$i]["audioQuality"];
					
				}
                $video["links"][$i]["mute"] = "no";
                $i++;
            }
	 /*
        if(!empty($downloadURL)){ 
            // Define header for force download 
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$fileName"); 
            header("Content-Type: application/zip"); 
            header("Content-Transfer-Encoding: binary"); 
             
            // Read the file 
            readfile($downloadURL); 
        } 
		*/
		
		echo json_encode($video);
    }else{ 
       echo json_encode("not working");
    } 
}else{ 
    echo json_encode("not working");
} 

}




function getmxtakatakDownloadLink($url){
	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mxtakatakvideodownloader.com/tiktok-service.php",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('url' => $url),
));

$videoDownloadLink = curl_exec($curl);
$videoDownloadLink = json_decode($videoDownloadLink,true);
curl_close($curl);

 $video['title'] = $videoDownloadLink['name'];
            $video["source"] = "mxtakatak";
            $video['duration'] = '00:00';
            $video['thumbnail'] =  $videoDownloadLink['thumbnailUrl'];;
     
   
                $video["links"][0]["url"] = $videoDownloadLink['videourl'];
                $video["links"][0]["type"] = "mp4";
                $video["links"][0]["size"] = get_file_size($videoDownloadLink['videourl']);
                $video["links"][0]["quality"] = "HD";
                $video["links"][0]["mute"] = "no";
                
            

echo json_encode($video);

}






function get_gaanaDownloadLink($url){
	
	
	
	if(!isset($_GET['weburl'])){
	//actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		///oldtest.php?url=https://gaana.com/song/bewafa-tera-masoom-chehra-1
		
		$a = preg_replace('/\//','\/',$url);

		
		$strtoreplace = '/oldtest.php?url='.$url;
	
		$actual_link = str_replace($strtoreplace, '', $actual_link);
//echo $actual_link;
$_GET['weburl'] = $actual_link;
	}
	
	$song_name_from_url = "";
        $explode_url = explode("/", parse_url($url, PHP_URL_PATH));
        if (count($explode_url) >= 3) {
            if ($explode_url[1] == "song") {
                $song_name_from_url = $explode_url[2];
            }
        }
        if (empty($song_name_from_url)) {
            return false;
        }
		
		
		
		
		 $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gaana.com/apiv2?seokey=$song_name_from_url&type=songdetails&isChrome=1",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_USERAGENT => "Mozilla/5.0 (Linux; Android 10;TXY567) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/8399.0.9993.96 Mobile Safari/599.36"
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $ganaadata =  json_decode($response, true);
		
		 if (empty($ganaadata["tracks"][0] ?? "")) {
            return $ganaadata;
        }
		
		$playlist_url = decrypt_url($ganaadata["tracks"][0]["urls"]["high"]["message"]);
        if (!filter_var($playlist_url, FILTER_VALIDATE_URL)) {
            return false;
        }
        $playlist_url = get_url_contents($playlist_url);
        $playlist_url = explode("\n", $playlist_url ?? "");
        if (empty($playlist_url[2] ?? "")) {
            return false;
        }
        $playlist_url = $playlist_url[2];
        $stream_playlist = get_url_contents($playlist_url);
        preg_match_all('/https(.*)/', $stream_playlist, $stream_playlist);
        if (empty($stream_playlist[0])) {
            return false;
        } else {
            $stream_playlist = $stream_playlist[0];
        }
		
	//	echo json_encode($stream_playlist);
		
	
		 $merged_file = __DIR__ . "/temp/gaana-" . $ganaadata["tracks"][0]["track_id"] . ".ts";
        if (!file_exists($merged_file) || filesize($merged_file) < 1000) {

		delete_old_cache_files_ganna();

            merge_parts_ganaa($stream_playlist, $merged_file);
        }
		
		 $video["title"] = $ganaadata["tracks"][0]["track_title"];
        $video["source"] = "gaana";
        $video["thumbnail"] = $ganaadata["tracks"][0]["artwork_web"];
        $video["duration"] = gmdate(($ganaadata["tracks"][0]["duration"] > 3600 ? "H:i:s" : "i:s"), $ganaadata["tracks"][0]["duration"]);
        $video["links"] = array();
        array_push($video["links"], array(
            "url" => $_GET['weburl'] . "/temp/gaana-".$ganaadata["tracks"][0]["track_id"] . ".ts",
          //  "url" => $merged_file_list,
            "type" => "mp3",
            "quality" => "256 kbps",
            "size" => format_size(filesize($merged_file)),
            "mute" => false
        ));
       
echo json_encode($video);
	
	
}

function decrypt_url($url)
    {
        $ciphering = "AES-128-CBC";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $decryption_iv = utf8_encode('asd!@#!@#@!12312');
        $decryption_key = utf8_encode('g@1n!(f1#r.0$)&%');
        return openssl_decrypt($url, $ciphering,
            $decryption_key, $options, $decryption_iv);
    }


 function merge_parts_ganaa($stream_playlist, $merged_file)
    {
        $merged = "";
        foreach ($stream_playlist as $stream_url) {
            $merged .= get_url_contents($stream_url);
        }
        file_put_contents($merged_file, $merged);
    }

function delete_old_cache_files_ganna(){

$pathtofiles = __DIR__ . "/temp/*";

$files = glob($pathtofiles); // get all file names

//echo sizeof($files);

if (sizeof($files) > 4){
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}}
}





    function extractVideoIdcocoscope($video_url){ 
        //parse the url 
        $parsed_url = parse_url($video_url); 
        if($parsed_url["path"] == "cocoscope.com/watch"){ 
            $video_url = "https://www.".$video_url; 
        }elseif($parsed_url["path"] == "www.cocoscope.com/watch"){ 
            $video_url = "https://".$video_url; 
        } 
         
        if(isset($parsed_url["query"])){ 
            $query_string = $parsed_url["query"]; 
            //parse the string separated by '&' to array 
            parse_str($query_string, $query_arr); 
            if(isset($query_arr["v"])){ 
                return $query_arr["v"]; 
            } 
        }    
    }

function get_cocoscopeDownloadLink($url){
	
	//https://www.cocoscope.com/watch?v=70023
	
	$weppage = get_url_contents($url);
	
	
		
		
		
		$myis = extractVideoIdcocoscope($url);
				
		//https://ws0.cocoscope.com/thumbnails/70023.jpg

		$video["title"] = "cocoscope_video_$myis";
        $video['thumbnail'] = "https://ws0.cocoscope.com/thumbnails/".$myis.".jpg";
		
		//https://ws7.cocoscope.com/videos/70023.mp4
	
        $video["source"] = "cocoscope";
      
        $video["duration"] = "00:00";
        $video["links"] = array();
        array_push($video["links"], array(
            "url" => "https://ws7.cocoscope.com/videos/".$myis.".mp4",
            "type" => "mp4",
            "quality" => "HD",
            "size" => get_file_size("https://ws7.cocoscope.com/videos/".$myis.".mp4"),
            "mute" => false
        ));
       
    echo json_encode($video);
	
	
}


function get_mp4uploadDownloadLink($url){
	
	//https://s3.mp4upload.com:282/d/qkx43qryzz7ycveom2xbgn2okxbmaj5endplddcs7j2uuxhgblx357sa/video.mp4
	
	//$weppage = get_url_contents($url);
	
	/*
	<video id="player_html5_api" class="vjs-tech" preload="" playsinline="playsinline" webkit-playsinline="" tabindex="-1" role="application" src="https://s3.mp4upload.com:282/d/qkx43qryzz7ycveom2xbgn2okxbmaj5endplddcs7j2uuxhgblx357sa/video.mp4" __idm_id__="881482753"></video>
		
		qkx43qryz3b4quuom2xbgn2okvrkcrln2ve7rwb6v27vwxy5g2tfes6o
		*/
		
		
		    $id = 'ient4tggsbf4';
		//	$web_page = get_url_contents('https://www.mp4upload.com/embed-'.$id.'.html'); 
			
			
			
$html = file_get_contents('https://www.mp4upload.com/embed-'.$id.'.html'); 
		
			       // preg_match_all('/https(.*)/', $web_page, $stream_playlist);

			   // $video1 = get_string_between($web_page, 'src', '</video>');

	
			echo json_encode( $html);

			//$link = ('https://www'.$www[0].'.mp4upload.com:282/d/'.$www[40].'/video.mp4');
		
		
		
		$myis = extractVideoIdcocoscope($url);
				

		$video["title"] = "cocoscope_video_$myis";
        $video['thumbnail'] = "https://ws0.cocoscope.com/thumbnails/".$myis.".jpg";
		
	
        $video["source"] = "cocoscope";
      
        $video["duration"] = "00:00";
        $video["links"] = array();
        array_push($video["links"], array(
            "url" => "https://ws7.cocoscope.com/videos/".$myis.".mp4",
            "type" => "mp4",
            "quality" => "HD",
            "size" => get_file_size("https://ws7.cocoscope.com/videos/".$myis.".mp4"),
            "mute" => false
        ));
       
  //  echo json_encode($video);
	
	
}



function get_vikiDownloadLink($url){
	
	//https://www.cocoscope.com/watch?v=70023
	
	//$weppage = get_url_contents($url);
	
	
	
	
	
	
	
	
	$viki_lang = "en";
$viki_id = '1115053v';


	echo "Obtaining information ... ";
	$viki_info = get_url_contents("http://www.viki.com/player/medias/$viki_id/info.json");

	if( $viki_info === FALSE ) {
		die("Error.\r\n");
	}

	$viki_json = json_decode($viki_info,TRUE);
	if( $viki_json === FALSE ) {
		die("Error.\r\n");
	}
	echo "Ok.\r\n";
$viki_uris=[];
	$viki_title = $viki_json['title'];
	$viki_description = $viki_json['description'];
	$viki_next_title = $viki_json['next_video']['title'];
	$viki_next_id = $viki_json['next_video']['media_id'];
	foreach($viki_json['streams'] as $stream => $streamData) {
		$viki_uris[$streamData['quality']] = $streamData['uri'];
	}

	unset($viki_info);
	unset($viki_json);

	echo "\r\nThe title: ".$viki_title."\r\n";
	echo "The description: ".$viki_description."\r\n\r\n";

	
echo json_encode($viki_uris);
	echo "Descargando video ... \r\n";
//	system("wget ".$viki_uris[$qty]);

	

	$viki_array = json_decode($viki_ljson,TRUE);
	if( $viki_array === FALSE ) {
		die("Error.\r\n");
	}
	echo "Ok.\r\n";
	
	
		
		
		/*
		$myis = extractVideoIdcocoscope($url);
				
		//https://ws0.cocoscope.com/thumbnails/70023.jpg

		$video["title"] = "cocoscope_video_$myis";
        $video['thumbnail'] = "https://ws0.cocoscope.com/thumbnails/".$myis.".jpg";
		
		//https://ws7.cocoscope.com/videos/70023.mp4
	
        $video["source"] = "cocoscope";
      
        $video["duration"] = "00:00";
        $video["links"] = array();
        array_push($video["links"], array(
            "url" => "https://ws7.cocoscope.com/videos/".$myis.".mp4",
            "type" => "mp4",
            "quality" => "HD",
            "size" => get_file_size("https://ws7.cocoscope.com/videos/".$myis.".mp4"),
            "mute" => false
        ));
       
    echo json_encode($video);
	*/
	
}





?>

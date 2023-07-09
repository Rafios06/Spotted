<?php

function generateVideoEmbedCode($videoURL, $width = 560, $height = 315)
{
    $embedCode = '';

    // YouTube
    if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $videoURL, $matches)) {
        $videoID = $matches[1];
        $embedCode = '<iframe width="' . $width . '" height="' . $height . '" src="https://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
    }
    // Dailymotion
    elseif (preg_match('/dailymotion\.com\/video\/([^\_]+)/', $videoURL, $matches)) {
        $videoID = $matches[1];
        $embedCode = '<iframe width="' . $width . '" height="' . $height . '" src="https://www.dailymotion.com/embed/video/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
    }
    // Vimeo
    elseif (preg_match('/vimeo\.com\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $videoID = $matches[1];
        $embedCode = '<iframe width="' . $width . '" height="' . $height . '" src="https://player.vimeo.com/video/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
    }
    // SoundCloud
    elseif (preg_match('/soundcloud\.com\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $trackID = $matches[1];
        $embedCode = '<iframe width="' . $width . '" height="' . $height . '" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $trackID . '&amp;color=%23ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;show_teaser=true" frameborder="0" allowfullscreen></iframe>';
    }
    // Spotify
    elseif (preg_match('/spotify\.com\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $trackID = $matches[1];
        $embedCode = '<iframe src="https://open.spotify.com/embed/' . $trackID . '" width="' . $width . '" height="' . $height . '" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
    }
    // Twitch
    elseif (preg_match('/twitch\.tv\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $channel = $matches[1];
        $embedCode = '<iframe src="https://player.twitch.tv/?channel=' . $channel . '" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen="true" scrolling="no" allow="autoplay; fullscreen"></iframe>';
    }
    // Vidéo Facebook
    elseif (preg_match('/facebook\.com\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $videoID = $matches[1];
        $embedCode = '<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $videoID . '%2F&show_text=0&width=' . $width . '" width="' . $width . '" height="' . $height . '" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>';
    }
    // Vidéo Instagram
    elseif (preg_match('/instagram\.com\/p\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $videoID = $matches[1];
        $embedCode = '<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/' . $videoID . '/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="13"></blockquote><script async src="https://www.instagram.com/embed.js"></script>';
    }
    // Vidéo TikTok
    elseif (preg_match('/tiktok\.com\/@([^\&\?\/]+)\/video\/([^\&\?\/]+)/', $videoURL, $matches)) {
        $username = $matches[1];
        $videoID = $matches[2];
        $embedCode = '<blockquote class="tiktok-embed" cite="https://www.tiktok.com/' . $username . '/video/' . $videoID . '" data-video-id="' . $videoID . '" style="max-width: 605px;min-width: 325px;"><section><a href="https://www.tiktok.com/' . $username . '/video/' . $videoID . '?lang=en" target="_blank" title="@' . $username . '">' . $username . '</a> has created a short video on TikTok with music ♬ original sound - ' . $username . '</section></blockquote><script src="https://www.tiktok.com/embed.js"></script>';
    }
    // Lien audio (MP3)
    elseif (preg_match('/(?:https?|ftp):\/\/[\S]+/', $videoURL, $matches)) {
        $audioURL = $matches[0];
        $embedCode = '<audio controls src="' . $audioURL . '"></audio>';
    }
    // Lien vidéo (MP4)
    elseif (preg_match('/(?:https?|ftp):\/\/[\S]+/', $videoURL, $matches)) {
        $videoURL = $matches[0];
        $embedCode = '<video width="' . $width . '" height="' . $height . '" controls><source src="' . $videoURL . '" type="video/mp4"></video>';
    }

    return $embedCode;
}

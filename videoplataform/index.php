<?php
declare(strict_types=1);
require_once "../common.php";
?>

<?php
class Channel
{
    public function __construct(
        private string $channelName,
        private string $channelDescription,
        private int $channelSubs
    )
    {}

    public function setChannelName($channelName):void
    {
        $this->channelName = $channelName;
    }

    public function getChannelName():string
    {
        return $this->channelName;
    }

    public function setChannelDescription($channelDescription):void
    {
        $this->channelDescription = $channelDescription;
    }

    public function getChannelDescription():string
    {
        return $this->channelDescription;
    }

    public function setchannelSubs($channelSubs):void
    {
        $this->channelSubs = $channelSubs;
    }

    public function getChannelSubs():int
    {
        return $this->channelSubs;
    }

    public function showChannelInformation():void
    {
        echo "<strong>Canal</strong> <br/>";
        echo "Nome: {$this->channelName} | Descrição {$this->channelDescription} | Inscritos: {$this->channelSubs} <br/><br/>";
    }
}

class Video
{
    public function __construct(
        private string $videoName,
        private string $videoDescription,
        private string $videoPublicationDate
    ){}

    public function setVideoName($videoName):void
    {
        $this->videoName = $videoName;
    }

    public function getVideoName():string
    {
        return $this->videoName;
    }

    public function setVideoDescription($videoDescription):void
    {
        $this->videoDescription = $videoDescription;
    }

    public function getVideoDescription():string
    {
        return $this->videoDescription;
    }

    public function setVideoPublicationDate($videoPublicationDate):void
    {
        $this->videoPublicationDate = $videoPublicationDate;
    }

    public function getVideoPublicationDate():string
    {
        return $this->videoPublicationDate;
    }

    public function showVideoInformation():void
    {
        echo "<strong>Video</strong> <br/>";
        echo "Título: {$this->videoName} | Descrição: {$this->videoDescription} | Data de Publicação: {$this->videoPublicationDate} <br/><br/>";
    }
}

class Playlist
{
    public function __construct(
        private string $playlistName,
        private string $playlistDescription
    )
    {}

    public function setPlaylistName($playlistName):void
    {
        $this->playlistName = $playlistName;
    }

    public function getPlaylistName():string
    {
        return $this->playlistName;
    }

    public function setPlaylistDescription($playlistDescription):void
    {
        $this->playlistDescription = $playlistDescription;
    }

    public function get():string
    {
        return $this->playlistName;
    }

    public function showPlaylistInformation():void
    {   
        echo "<strong>Playlist</strong> <br/>";
        echo "Nome: {$this->playlistName} | Descrição: {$this->playlistDescription} <br/> <br/>";
    }


}

$firstChannel = new Channel(
    'nicaoboldao',
    'paixão por programar',
    5000
);

$firstVideo = new Video(
    'Aprendendo POO',
    'POO pra quem é idiota',
    '12/07/2026'
);

$secondVideo = new Video(
    'Namespaces em PHP',
    'Ensinando como utilizar NameSpaces em PHP 8.5',
    '05/08/2025'
);

$firstPlaylist = new Playlist(
    'Estudos de Programação',
    'é o que ta no título bocó'
);

$firstChannel->showChannelInformation();
$secondVideo->showVideoInformation();
$firstVideo->showVideoInformation();
$firstPlaylist->showPlaylistInformation();
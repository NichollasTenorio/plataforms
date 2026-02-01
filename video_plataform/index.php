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
        private int $channelSubs,
    )
    {}

    private array $playlists = [];

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
        echo "Nome: {$this->channelName} | Descrição {$this->channelDescription} | Inscritos: {$this->channelSubs} <br/>";
    }

    public function createPlaylist(
        string $playlistName,
        string $playlistDescription,
        array $videoList
    ):Playlist
    {
        $newPlaylist = new Playlist($playlistName, $playlistDescription, $videoList, $this);
        $this->playlists[] = $newPlaylist;

        return $newPlaylist;
    }

    public function getPlaylist()
    {
        return $this->playlists;
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
        private string $playlistDescription,
        private array $videoList,
        private Channel $channel
    ){}

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

    public function getPlaylistDescription():string
    {
        return $this->playlistDescription;
    }

    public function showPlaylistInformation():void
    {   
        echo "<strong><br>{$this->getPlaylistName()}</strong> <br/>";
        echo "Nome: {$this->playlistName} | Descrição: {$this->playlistDescription} <br/> <br/>";
        echo "<strong>Videos dentro da playlist: {$this->getPlaylistName()}</strong>";
        $this->convertList();

    }

    public function convertList():void
    {
        foreach($this->videoList as $videos){
            echo "<br> Título: {$videos->getVideoName()} <br> Descrição: {$videos->getVideoDescription()} <br> Data de publicação: {$videos->getVideoPublicationDate()} <br>";
        }
    }

    public function addVideo(Video $videoForPlaylist):void
    {
        $this->videoList[] = $videoForPlaylist;
    }

}

$firstChannel = new Channel(
    'nicaoboladao',
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

$thirdVideo = new Video(
    'Composição de Objetos JAVA',
    'Tutorial sobre como utilizar Agregação, Composição, Associação',
    '14/07/2022'
);

$fourthVideo = new Video(
    'Estrutura de dados em JAVA',
    'Tutorial sobre estrutura de dados',
    '18/10/2023'
);

$fifthVideo = new Video(
    'Hollow Knight - SpeedRun',
    'zerando hollow knight kkkkk',
    '07/02/2024'
);

$sixthVideo = new Video(
    'Reflexão para a vida',
    'reflexões, aproveita ae',
    '10/10/2025'
);

$firstVideoList = [
    $secondVideo,
    $firstVideo
];

$secondVideoList = [
    $thirdVideo,
    $fourthVideo
];

$thirdVideoList = [
    $fifthVideo,
    $sixthVideo
];

// $firstPlaylist = new Playlist(
//     'POO - PHP',
//     'é o que ta no título bocó',
//     $firstVideoList
// );

// $secondPlaylist = new Playlist(
//     'Estudando Java',
//     'Estudo básico da linguagem Java',
//     $secondVideoList
// );

// $firstChannel->showChannelInformation();
// $secondVideo->showVideoInformation();
// $firstVideo->showVideoInformation();
$firstChannel->createPlaylist('Favoritos', 'Vídeos Favoritos', $thirdVideoList);
$firstChannel->createPlaylist('POO - PHP','é o que ta no título bocó',$firstVideoList);
$firstChannel->createPlaylist('Estudando Java', 'Estudo básico da linguagem Java', $secondVideoList );

$firstChannel->showChannelInformation();
$firstChannel->getPlaylist()[0]->addVideo($secondVideo);
// $firstChannel->getPlaylist()[1]->showPlaylistInformation();
// $firstChannel->getPlaylist()[2]->showPlaylistInformation();

foreach($firstChannel->getPlaylist() as $playlists){
    $playlists->showPlaylistInformation();
}

// $firstPlaylist->showPlaylistInformation();
// $secondPlaylist->showPlaylistInformation();
//Como criar listas/arrays em classes
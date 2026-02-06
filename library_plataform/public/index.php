<?php
declare(strict_types=1);
require_once "../../common.php";
?>

<?php
class Book
{
    private string $bookStatus;

    public function __construct(
        private string $bookName,
        private string $bookDescription,
        private Author $bookAuthor
    )
    {
        $this->bookStatus = 'livre';
    }

    public function setBookName($bookName):void
    {
        $this->bookName = $bookName;
    }

    public function getBookName():string
    {
        return $this->bookName;
    }
    public function setBookDescription($bookDescription):void
    {
        $this->bookDescription = $bookDescription;
    }

    public function getBookDescription():string
    {
        return $this->bookDescription;
    }

    public function getBookAuthor():string
    {
        return $this->bookAuthor->getAuthorName();
    }

    public function getBookData():void
    {
        echo "<strong>Nome do Livro:</strong><br/> {$this->getBookName()} <br><br><strong>Descrição:</strong><br/> {$this->getBookDescription()} <br><br> <strong>Autor:</strong><br/> {$this->getBookAuthor()} <br><br>";
    }

    public function setBookSatus($bookStatus):void
    {
        $this->bookStatus = $bookStatus;
    }

    public function getBookStatus():string
    {
        return $this->bookStatus;
    }

    public function verifyBookStatus():bool
    {
        if($this->getBookStatus() == 'livre'){
            return true;
        }else{
            return false;
        }
    }
}

class Author
{
    public function __construct(
        private string $authorName,
    )
    {}

    private array $bookList = [];

    public function setAuthorName($authorName):void
    {
        $this->authorName = $authorName;
    }

    public function getAuthorName():string
    {
        return $this->authorName;
    }

    public function createBook(
        string $bookName,
        string $bookDescription,
    ):Book
    {
        $newBook = new Book($bookName, $bookDescription, $this);
        $this->bookList[] = $newBook;
        return $newBook;
    }

    public function getBookList():array
    {
        return $this->bookList;
    }

    public function getBookFullReport():void
    {
        echo "<strong><h5>Todos os livros de {$this->authorName} a Seguir:</h5></strong> <br>";

        foreach($this->bookList as $books){
            $fullBooksReport = $books->getBookData();
        }
    }
}

class User
{
    private array $caughtBooks = [];

    public function __construct(
        private string $userName,
        private string $userEmail
    )
    {}

    public function getCaughtBooks():array
    {
        return $this->caughtBooks;
    }

    public function setUserName($userName):void
    {
        $this->userName = $userName;
    }

    public function getUserName():string
    {
        return $this->userName;
    }

    public function setUserEmail($userEmail):void
    {
        $this->userEmail = $userEmail;
    }

    public function getUserEmail():string
    {
        return $this->userEmail;
    }

    public function requestBook(Book $requestedBook):void
    {
        $bookLoan = new BookLoan($this, $requestedBook);
        $bookLoan->requestBookLoan();
    }

    public function requestBookDevolution($requestedBook):void
    {
        $bookLoan = new BookLoan($this, $requestedBook);
        $bookLoan->bookDevolution($requestedBook);

    }

    public function getYourBookList():void
    {
        if(!empty($this->caughtBooks)){
            foreach($this->caughtBooks as $getYourBookList){
                echo "{$getYourBookList->getBookName()} <br>";
            }
        }else{
            echo "Sem livros em sua lista!";
        }

    }

    public function addBook(Book $book):void
    {
        $this->caughtBooks[] = $book;
    }

    public function removeBook(Book $book):bool
    {
        foreach($this->caughtBooks as $index => $targetBook){
            
            if($targetBook === $book){
                unset($this->caughtBooks[$index]);
                $this->caughtBooks = array_values($this->caughtBooks);
                $book->setBookSatus('livre');
                return true;
            }
        }

        throw new Exception ("Esse livro não está na sua lista");
    }
}

class BookLoan
{
    public function __construct(
        private User $user,
        private Book $book
    )
    {}

    public function getUser():User
    {
        return $this->user;
    }

    public function getBook():Book
    {
        return $this->book;
    }

    public function requestBookLoan():void
    {
        if(count($this->user->getCaughtBooks()) >= 2){
            throw new Exception ("Limite de livros atigido");
        }

        if($this->book->verifyBookStatus()){
            echo "Livro {$this->book->getBookName()} pego com sucesso!";
            $this->user->addBook($this->book);
            $this->book->setBookSatus('ocupado');
        }else{
            echo "Esse livro já foi selecionado, por favor selecione outro!";
        }
    }
    
    public function bookDevolution($requestedBook):void
    {
        if($this->user->removeBook($requestedBook)){
            echo "Livro {$requestedBook->getBookName()} devolvido com sucesso!";
        }
        return;
    }

}

$firstAuthor = new Author(
    'Jonathan de Souza'
);

$firstBook = $firstAuthor->createBook(
    'As Cores Sussuram',
    'Após atravessar uma porta giratória que nunca parava de rodar, Mikael vai parar em um reino onde as cores têm cheiro e o silêncio é proibido por lei.'
);

$secondBook = $firstAuthor->createBook(
    'A Biblioteca das Sombras Vivas',
    'Neste mundo, os livros não têm palavras; eles projetam hologramas das memórias de quem os lê. Um jovem bibliotecário acaba preso dentro da biografia de um dragão e precisa aprender a voar para voltar ao índice.'
);

$thirdBook = $firstAuthor->createBook(
    'O Guardião da Última Nuvem',
    'Em um futuro onde o céu foi privatizado, um jovem encontra uma pequena nuvem de chuva presa em uma garrafa de vidro. Ele inicia uma fuga desesperada pelo deserto para libertá-la no topo da montanha mais alta, onde o clima ainda é livre.'  
);

$firstUser = new User(
    'Nichollas',
    'nichollas.tenorio.sj@gmail.com'
);

// try {
//     $firstUser->requestBook($secondBook);
//     $firstUser->requestBook($firstBook);
//     $firstUser->requestBook($thirdBook);
// } catch (Exception $e) {
//     echo "<br/><strong>Erro:</strong> " . $e->getMessage() . "<br/>";
// }

$firstUser->requestBook($firstBook);
echo "<br/>";
$firstUser->requestBookDevolution($firstBook);
echo "<br/>";
$firstUser->getYourBookList();



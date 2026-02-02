<?php
require_once "../common.php";
?>

<?php
class Student
{
    public function __construct(
        private string $studentName,
        private string $studentEmail
    )
    {}

    public function setStudentName(string $studentName):void
    {
        $this->studentName = $studentName;
    }

    public function getStudentName():string
    {
        return $this->studentName;
    }

    public function setStudentEmail(string $studentEmail):void
    {
        $this->studentEmail = $studentEmail;
    }

    public function getStudentEmail():string
    {
        return $this->studentEmail;
    }

    public function showStudentInformations():void
    {
        echo "Nome: {$this->studentName} | Email: {$this->studentEmail}";
    }
}

class Course
{
    public function __construct(
        private string $courseTitle,
        private string $courseAuthor,
        private float $coursePrice
    )
    {}

    private array $studentList = [];

    public function setCourseTitle(string $courseTitle):void
    {
        $this->courseTitle = $courseTitle;
    }

    public function getCourseTitle():string
    {
        return $this->courseTitle;
    }

    public function setCoursePrice(float $coursePrice):void
    {
        $this->coursePrice = $coursePrice;
    }

    public function getCoursePrice():float
    {
        return $this->coursePrice;
    }

    public function setCourseAuthor(string $courseAuthor):void
    {
        $this->courseAuthor = $courseAuthor;
    }

    public function getCourseAuthor():string
    {
        return $this->courseAuthor;
    }

    public function showCourseInformations()
    {
        if(!empty($this->studentList)){
            echo "<br><br><strong>{$this->getCourseTitle()}</strong> <br>";
            echo "Título: {$this->getCourseTitle()} <br> Autor: {$this->getCourseAuthor()} <br> Preço {$this->getCoursePrice()} <br> Alunos: ";

            $this->convertList();
        }else{
            echo "<br><br><strong>{$this->getCourseTitle()}</strong> <br>";
            echo "Título: {$this->getCourseTitle()} <br> Autor: {$this->getCourseAuthor()} <br> Preço {$this->getCoursePrice()} <br> Alunos: Não há alunos matriculados!"; 
        }

    }

    public function addStudent(Student $studentForList):void
    {
        $this->studentList[] = $studentForList;
    }

    public function convertList()
    {
        foreach($this->studentList as $students){
            echo $students->getStudentName() . " ";
        }
    }

}

class Plataform
{
    public function __construct(
        private string $plataformName
    )
    {}

    private array $courseList = [];

    public function launchCourse(
        string $courseTitle,
        string $courseAuthor,
        float $coursePrice
    ):Course
    {
        $newCourse = new Course(
            (string) $courseTitle,
            (string) $courseAuthor,
            (float) $coursePrice
        );

        $this->courseList[] = $newCourse;
        return $newCourse;
    }    

    public function getCourseList():array
    {
        return $this->courseList;
    }

    public function convertCourseList()
    {
        foreach($this->courseList as $courses){
            $courses->showCourseInformations();
        }
    }

    public function generateFullReport()
    {
        echo "<strong>Plataforma {$this->plataformName}</strong> <br><br>";
        echo "<strong>Cursos em {$this->plataformName} </strong>";
        $this->convertCourseList();
    }
}

$firstStudent = new Student(
    'Nichollas',
    'nichollas.tenorio.sj@gmail.com'
);

$secondStudent = new Student(
    'Kauan',
    'kauan.tn@gmail.com'
);

$firstCourse = new Course(
    'Curso em Vídeo',
    'Gustavo Guanabara',
    28.90
);

$plataform = new Plataform(
    'NicaoAcademy'
);

$plataform->launchCourse('Curso em Vídeo','Gustavo Guanabara', 28.90);
$plataform->launchCourse('Clube Full Stack','Alexandre Cardoso', 120.90);

$plataform->getCourseList()[0]->addStudent($secondStudent);
$plataform->getCourseList()[0]->addStudent($firstStudent);

// $plataform->getCourseList()[1]->showCourseInformations();
// $plataform->getCourseList()[0]->showCourseInformations();

$plataform->generateFullReport();
?>
<?php

class Library {
    private $books = [];

    private $password;

    public function __construct($initialBooks, $password,) {
        $this->books = $initialBooks;
        $this->password = $password;
    }
    
    public function displayBooks() {
        echo "Available books in the library:\n";
        foreach ($this->books as $index => $book) {
            echo ($index + 1) . ". " . $book . "\n";
        }
    }
    function addBook(&$books) {
        echo "category:";
        $category = trim(fgets(STDIN));
        echo "Enter Author: ";
        $author = trim(fgets(STDIN));
        echo "book id: ";
        $bookid = trim(fgets(STDIN));
        echo "book name: ";
        $bookname = trim(fgets(STDIN));
        echo " price: ";
        $price = trim(fgets(STDIN));
         $books[] = ['category' => $category, 'author' => $author,'bookid'=>$bookid,'bookname'=>$bookname,'price'=>$price];
        echo "Book added successfully!\n";
    }
    
    
    function viewBooks($books) {
        if (empty($books)) {
            echo "No books available.\n";
        } else {
            echo "\nBooks in Library:\n";
            foreach ($books as $id => $book) {
                echo " category: " . $book['category'] . ", Author: " . $book['author'].", book id: " . $book['bookid'] .",
                book name: " . $book['bookname']. ",price: " . $book['price']." \n";
            }
        }
    }
    

    public function deleteBook($bookIndex) {
        if (isset($this->books[$bookIndex])) {
             unset($this->books[$bookIndex]);
            $this->books = array_values($this->books); // Re-index the array
            
        }
    }

    public function searchBook($bookName) {
        $availablebook = array_filter($this->books, function($book) use ($bookName) {
            return stripos($book, $bookName) !== false;
        });

        if (!empty($availablebook)) {
            echo "Books matching '{$bookName}':\n";
            foreach ($availablebook as $index => $book) {
                echo ($index + 1) . ". " . $book . "\n";
            }
        } else {
            echo "No books found matching '{$bookName}'.\n";
        }
    }

    public function changePassword($newPassword) {
        $this->password = $newPassword;
        echo "Password has been changed successfully.\n";
    }
    

    public function verifyPassword($enteredPassword) {
        return $enteredPassword === $this->password;
    }
}

class User {
    public function input($prompt) {
        return readline($prompt);
    }
}

$newPassword = "***"; // Change this to your desired initial password
$library = new Library(["computer ", "eletrical ", "civil"],$newPassword);

$user = new User();

$enteredPassword = $user->input("Enter the password: ");

if ($library->verifyPassword($enteredPassword)) {
    while (true) {
        echo "\nMenu:\n";
        echo "1.  all  books\n";
        echo "2. add  books\n";
        echo "3. Delete a book\n";
       
 echo "4. Search for a book\n";
        echo "5. Change password\n";
        echo "6. View Books\n";
        echo "7. Exit\n";

        $choice = $user->input("Enter your choice: ");

        switch ($choice) {
            case "1":
                $library->displayBooks();
                break;
        case "2":
                $library->addBook($books);
                    break;
               
            case "3":
                $library->displayBooks();
                $bookIndex = $user->input("Enter the book ID of delete : ") - 1;
                $library->deleteBook($bookIndex);
                break;
            case "4":
                $bookName = $user->input("Enter the name or part of the name of the book you want to search for: ");
                $library->searchBook($bookName);
                break;
            case "5":
                $newPassword = $user->input("Enter the new password: ");
                $library->changePassword($newPassword);
                break;
                case '6':
                    $library->viewBooks($books);
                    break;
           
            default:
                echo "Invalid choice.\n";
        }
    }
} 

?>
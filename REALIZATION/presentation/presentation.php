<?php
require('../Entities/book.php');
require('../Servase/BookService.php');
class Presentation
{
  public function view()
  {
    $classdata = new DataDAO();
    $data = $classdata->getData();
    foreach ($data as $dt) {
      echo 'Id : ' . $dt->getId() . "\n";
      echo 'Title : ' . $dt->getTitle() . "\n";
      echo 'ISBN : ' . $dt->getISBN() . "\n";
    }
  }


  public function add()
  {
    $ISBN = ask('enter ISBN : ');
    $title = ask('enter title : ');

    //id
    $classdata = new DataDAO();
    $data = $classdata->getData();
    foreach ($data as $dt) {
      $ID =  1;
    }
    //
    if ($ISBN == 'back' || $title == "back") {
      return;
    }
    $classData = new Entities($ID, $ISBN, $title);
    $classDAO = new Service();
    $classDAO->setData($classData);


    $animation = [
      "🔄 Connecting...",
      "✅ Connected Successfully!",
      "🎉 Operation Completed!",
      "⚙️ Processing..."
    ];

    $screenWidth = 80;
    $color = "\033[0;32m";

    foreach ($animation as $message) {
      echo $color . str_pad($message, $screenWidth, ' ', STR_PAD_BOTH) . "\033[0m\n";
      usleep(500000);
    }

    echo $color . str_pad("✨ Thank you for using our application! ✨", $screenWidth, ' ', STR_PAD_BOTH) . "\033[0m\n";
  }

  public function delete()
  {
    echo "\n Delete Book: \n";

    $id = ask("Enter the id of the Book to delete: ");

    $BookServices = new Service();
    $deleted = $BookServices->delete($id);

    if ($deleted) {
      echo "Book with id '$id' deleted successfully.\n\n";
    } else {
      echo "Book with id '$id' not found.\n\n";
    }
  }

  public function edit()
  {
    echo "\n EEEEdit BOOOOook: \n";

    $title = ask("Enter the title of the Book to edit: ");

    $BookServices = new Service();
    $book = $BookServices->getData();

    $found = false;

    foreach ($book as $book) {
      if ($book->getTitle() === $title) {
        $found = true;
        $newTitle = ask("Enter the new title :");
        $newISBN = ask("Enter the new ISBN :");

        $updatedTitle = ($newTitle !== 'skip') ? $newTitle : $book->getTitle();
        $updatedISBN = ($newISBN !== 'skip') ? $newISBN : $book->getISBN();
        $classdata = new DataDAO();
        $data = $classdata->getData();
        foreach ($data as $dt) {
          $ID = $dt->getId() + 1;
        }
        $newBook = new Entities($ID, $updatedTitle, $updatedISBN);
        $BookServices->edit($title, $newBook);

        echo "successfully.\n\n";
        break;
      }
    }

    if (!$found) {
      echo "Book with title '$title' not found.\n\n";
    }
  }



  public function search()
  {
    echo "\n search Book: \n";

    $id = ask("Enter the TITLE of the Book to search: ");

    $BookServices = new Service();
    $searchd = $BookServices->search($id);

    if ($searchd) {
      echo "Book with id '$id' searchd successfully.\n\n";
    } else {
      echo "Book with id '$id' not found.\n\n";
    }
  }
}

<?php
require('../DataAcssec/bookDAO.php');

class Service
{
    public function getData()
    {
        $databaseClass = new DataDAO();
        return $databaseClass->getData();
    }

    public function setData($data)
    {
        $databaseClass = new DataDAO();
        $databaseClass->setData($data);
    }

    public function delete($title)
    {
        $datadao = new DataDAO();
        $data = $datadao->getData();

        foreach ($data as $index => $book) {
            if ($book->getTitle() === $title) {
                unset($data[$index]);
                $data = array_values($data); // Reindex array
                $datadao->saveData($data);   // Save updated array
                return true;
            }
        }
        return false;
    }

    public function edit($title, $newBook)
    {
        $datadao = new DataDAO();
        $data = $datadao->getData();

        foreach ($data as $index => $book) {
            if ($book->getTitle() === $title) {
                $data[$index] = $newBook;
                $datadao->saveData($data);
                return true;
            }
        }
        return false;
    }

    public function search($title)
    {
        $datadao = new DataDAO();
        $data = $datadao->getData();

        foreach ($data as $book) {
            if ($book->getTitle() === $title) {
                echo "Book found: \n";
                echo "Title: " . $book->getTitle() . "\n";
                echo "ISBN: " . $book->getISBN() . "\n";
                return true;
            }
        }
        echo "Book with title '$title' not found.\n";
        return false;
    }
}

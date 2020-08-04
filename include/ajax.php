<?php
//@session_id($_GET['token']);
@session_start();
@include("functions.php");
class Ajax extends systemData{

	public function ajaxFunction(){

				if(@$_GET['get'] == 'search_book'){
					// Get value
					$search = $_POST['search'];
					$searchSystem = $_GET['search'];
					// Create & Print JSON Data
					$response = array();
					if($searchSystem == 'all_book'){
						$result = $this->preparedQuery("SELECT book.id,book.isbn,book.title,author.name AS authorName,publisher.name AS publisherName
																						FROM books book, authors author, publishers publisher
																						WHERE book.author_id=author.id AND book.publisher_id=publisher.id AND
																						(author.name LIKE ?) OR (publisher.name LIKE ?) OR (book.isbn LIKE ?)
																						OR (title LIKE ?) GROUP BY book.id LIMIT 5",array('%'.$search.'%','%'.$search.'%','%'.$search.'%','%'.$search.'%'));
						while ($row = $result->fetch_array()){
							$response[] = array("value"=>$row['id'],"label"=>'#'.$row['isbn'].' - '.$row['title'].' - Publisher: '.$row['publisherName'].' - Author: '.$row['authorName']);
						}
					}elseif($searchSystem == 'book_name'){
						$result = $this->preparedQuery("SELECT * FROM books WHERE title LIKE ?",array('%'.$search.'%'));
						while ($row = $result->fetch_array()){
							$response[] = array("value"=>$row['id'],"label"=>'#'.$row['isbn'].' - '.$row['title']);
						}
					}elseif($searchSystem == 'author'){
						$result = $this->preparedQuery("SELECT book.isbn,book.title,author.name AS authorName
																						FROM books book, authors author
																						WHERE book.author_id=author.id AND author.name LIKE ?",array('%'.$search.'%'));
						while ($row = $result->fetch_array()){
							$response[] = array("value"=>$row['id'],"label"=>$row['title'].' - '.$row['authorName']);
						}
					}elseif($searchSystem == 'publisher'){
						$result = $this->preparedQuery("SELECT book.id,book.title,publisher.name AS publisherName
																						FROM books book, publishers publisher
																						WHERE book.publisher_id=publisher.id AND publisher.name LIKE ?",array('%'.$search.'%'));
						while ($row = $result->fetch_array()){
							$response[] = array("value"=>$row['id'],"label"=>$row['title'].' - '.$row['publisherName']);
						}
					}elseif($searchSystem == 'isbn'){
						$result = $this->preparedQuery("SELECT * FROM books WHERE isbn LIKE ?",array('%'.$search.'%'));
						while ($row = $result->fetch_array()){
							$response[] = array("value"=>$row['id'],"label"=>'#'.$row['isbn'].' - '.$row['title']);
						}
					}
					echo json_encode($response);
				}

  }
}

$ajax = new Ajax;
$ajax->ajaxFunction(); ?>

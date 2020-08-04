<?php
@include("functions.php");

class Subsystem extends systemData{

	public function home(){
		// Run the protection function
		$this->security();
		// Include [Header ]
		@include("style/header.php");

		// Notifications
		if(@$_GET['success'] == 'registration'){
			//$this->alert($lang['error'],$lang['notLeaveBlankFields'],'success');
		}
		// Include [Index - Footer]
		@include("style/index.php");
		@include("style/footer.php");
	}

	/* /////////////////////////////////////////////////////////////////*/

	public function book(){
		// Get ID & Result
  	$url = $_GET['id'];
		$rowTobics = $this->preparedQuery("SELECT topic.id AS id,topic.url_topic AS url_topic,topic.type_topic AS type_topic,topic.fixed AS fixed,topic.pic AS pic,topic.type AS type,
																			 topic.view AS view, topic.user,topic.section AS section, topic.comments AS comments,topic.arrangement, topic.date AS date,
																			 category.id AS id_category, category.url AS url_category, category.picture AS picture_category,variableT.value AS topic_title, variableC.value AS section_title, variableB.value AS topic_body, variableK.value AS topic_keywords
																			 FROM topics topic, categories category, languages_variables variableT, languages_variables variableC, languages_variables variableB, languages_variables variableK
																			 WHERE topic.url_topic=? AND topic.section=category.id AND variableT.id_object=topic.id AND variableC.id_object=topic.section AND variableB.id_object=topic.id AND variableK.id_object=topic.id
																			 AND variableT.type='topic' AND variableC.type='category' AND variableB.type='topic' AND variableK.type='topic' AND variableT.name='title' AND variableC.name='title' AND variableB.name='body' AND variableK.name='keywords'
																			 AND variableT.language=? AND variableC.language=? AND variableB.language=? AND variableK.language=?",array($url,$this->languages,$this->languages,$this->languages,$this->languages),'select_row');
		$id = $rowTobics['id'];
		// Check if not found
		if($id == NULL){@header("Location:../"); exit();}
    // Get Languages
		$titleTob = $rowTobics['topic_title'];
		$categoriesTob = $rowTobics['section_title'];
		$bodyTob = $rowTobics['topic_body'];
		$keywordTob = $rowTobics['topic_keywords'];
		$urlCategory = $rowTobics['url_category'];
		$idSession = session_id();
		// Update View
    if($rowTobics['view'] == 0){
			$this->preparedQuery("INSERT INTO view (id,ip,session,date_created) VALUES (?,?,?,?)",array($id,$_SESSION['IP'],$idSession,time()));
			$this->preparedQuery("UPDATE topics SET view=view+1 WHERE id=?",array($id));
		}

		@include("style/header.php");
		@include("style/book.php");
		@include("style/footer.php");
	}


	/* /////////////////////////////////////////////////////////////////*/

	public function header($withoutSecurity=NULL){
		// Run the protection function
		if($withoutSecurity == NULL){
			$this->security();
		}
		// Include [Header]
		@include("style/header.php");
	}

	/* /////////////////////////////////////////////////////////////////*/

  public function page(){
		// Get Name Page
		$page = $_GET['id'];
		// Check if page is null
		if($page == NULL){
			@header("Location: ./");
			exit();
		}elseif($page != NULL){
			$file = 'style/'.$page.'.php';
			// Check if page exists or not exists redirect to home page
			if(!file_exists($file)){
				echo 'Error 404 not Found <br> Contact us E-book <br> <a href="../">Back to home</a>';
			}else{
				// Include Page from style
				@include($file);
			}
		}
	}
}

?>

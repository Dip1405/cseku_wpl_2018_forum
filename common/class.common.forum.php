<?php

/*All the common Model classes are listed here*/

class DiscussionCategory{
    private $_ID;
    private $_name;

    public function setID ( $ID ) {
        $this->_ID = $ID;
    }

    public function getID () {
        return $this->_ID;
    }
    public function setName ($Name){
        $this->_name = $Name;
    }
    public function getName(){
        return $this->_name;
    }
}


	class Discussion{
    private $_ID;
    private $_Name;
    private $_Category;
    private $_CategoryName;
    private $_Description;
    private $_Tag;
	private $_Views;
	private $_Votes;
    private $_CreationDate;
    private $_Creator;


    public function setID ( $ID ) {
      $this->_ID = $ID;
    }

    public function getID () {
      return $this->_ID;
    }


    public function setName ( $Name ) {
        $this->_Name = $Name;
    }
  
    public function getName () {
        return $this->_Name;
    }

    public function setCategory ( $Category ) {
      $this->_Category = $Category;
    }

    public function getCategory () {
      return $this->_Category;
    }

    public function setCategoryName ( $CategoryName ) {
        $this->_CategoryName = $CategoryName;
    }
  
    public function getCategoryName () {
        return $this->_CategoryName;
    }

    public function setDescription ( $Description ) {
      $this->_Description = $Description;
    }

    public function getDescription () {
      return $this->_Description;
    }

    public function setTag( $Tag ) {
      $this->_Tag = $Tag;
    }

    public function getTag() {
      return $this->_Tag;
    }

    public function setViews($Views) {
      $this->_Views = $Views;
    }

    public function getViews() {
      return $this->_Views;
		}
		
		public function setVotes($Votes) { return $this->_Votes = $Votes; }

		public function getVotes() { return $this->_Votes; }

    public function setCreationDate( $CreationDate ) {
      $this->_CreationDate = $CreationDate;
    }

    public function getCreationDate() {
      return $this->_CreationDate;
    }

    public function setCreator ($Creator ) {
      $this->_Creator= $Creator;
    }

    public function getCreator() {
      return $this->_Creator;
    }
}

class Comment{
    private $_CommentID;
    private $_DiscussionID;
    private $_Comment;
    private $_CommnetVotes;
    private $_Creator;
    private $_CommentTime;
    private $_CommentIDTop;

    public function setCommentID ($CommentID ) {
        $this->_CommentID= $CommentID;
    }

    public function getCommentID() {
        return $this->_CommentID;
    }

    public function setDiscussionID ($DiscussionID ) {
        $this->_DiscussionID= $DiscussionID;
    }

    public function getDiscussionID() {
        return $this->_DiscussionID;
    }

    public function setComment ($Comment ) {
        $this->_Comment= $Comment;
    }

    public function getComment() {
        return $this->_Comment;
    }

    public function setCommentVotes($CommentVotes) {
        $this->_CommentVotes = $CommentVotes;
    }

    public function getCommentVotes() {
        return $this->_CommentVotes;
    }

    public function setCreator ($Creator ) {
        $this->_Creator= $Creator;
    }

    public function getCreator() {
        return $this->_Creator;
    }

    public function setCommentTime ($CommentTime ) {
        $this->_CommentTime= $CommentTime;
    }

    public function getCommentTime() {
        return $this->_CommentTime;
    }


    public function setCommentIDTop ($CommentIDTop ) {
        $this->_CommentIDTop= $CommentIDTop;
    }

    public function getCommentIDTop() {
        return $this->_CommentIDTop;
    }
}

class DiscussionTags {
    private $_discussionTag;
    private $_discussionTagNumber;

    public function setDiscussionTag($discussionTag) {
        $this->_discussionTag = $discussionTag;
    }

    public function setDiscussionTagNumber($discussionTagNumber) {
        $this->_discussionTagNumber = $discussionTagNumber;
    }

    public function getDiscussionTag() {
        return $this->_discussionTag;
    }
    
    public function getDiscussionTagNumber() {
        return $this->_discussionTagNumber;
    }
}



?>
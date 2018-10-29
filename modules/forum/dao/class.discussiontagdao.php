<?php

include_once COMMON . 'class.common.php';
include_once COMMON . 'class.common.forum.php';
include_once UTILITY . 'class.util.php';

class DiscussionTagsDAO {

  private $_db;

  public function __construct() {
    $this->_db = DBUtil::getInstance();
  }

  public function getAllTags() {
    $sql = "SELECT Tag, COUNT(Tag) AS TagNumbers FROM tbl_discussion GROUP BY Tag ORDER BY Tag ASC";
    //echo '<br>' . $sql . '<br>';
    $this->_db->doQuery($sql);
    $rows = $this->_db->getAllRows();
    
    $disscussionTagsList = [];

    foreach ($rows as $row) {
      $discussionTags = new DiscussionTags();
      $discussionTags->setDiscussionTag($row['Tag']);
      $discussionTags->setDiscussionTagNumber($row['TagNumbers']);

      $disscussionTagsList[] = $discussionTags;
    }

    $result = new Result();
    $result->setIsSuccess(1);
    $result->setResultObject($disscussionTagsList);

    return $result;
  }

  public function getDiscussionsByTags($discussionTags) {
    $discussionList = array();
    $sql = "SELECT D.*, C.Name FROM tbl_discussion AS D INNER JOIN tbl_discussion_category AS C ON D.CategoryID = C.ID AND D.Tag = '$discussionTags'";
    $this->_db->doQuery($sql);
    $rows = $this->_db->getAllRows();
  
    foreach ($rows as $row) {
      $discussion = new Discussion();
      $discussion->setID ( $row['ID']);
      $discussion->setName( $row['Title'] );
      $discussion->setCategory( $row['CategoryID'] );
      $discussion->setCategoryName( $row['Name'] );
      $discussion->setDescription( $row['Description'] );
      $discussion->setTag( $row['Tag'] );
      $discussion->setViews( $row['Views'] );
      $discussion->setVotes( $row['Votes'] );
      $discussion->setCreationDate( $row['CreationDate'] );
      $discussion->setCreator( $row['CreatorID'] );
  
      $discussionList[] = $discussion;     
    }
    
    $result = new Result();
    $result->setIsSuccess(1);
    $result->setResultObject($discussionList);
  
    return $result;
  }

}
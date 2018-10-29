<?php

include_once MODULES_FORUM . 'dao/class.discussiontagdao.php';

class DiscussionTagsBAO {

  private $_disscussionTagsDAO;

  public function __construct() {
    $this->_discussionTagsDAO = new DiscussionTagsDAO();
  }

  public function getAllTags() {
    $result = $this->_discussionTagsDAO->getAllTags();
    if ($result->getIsSuccess()) {
      return $result;
    }
    return null;
  }

  public function getDiscussionsByTags($discussionTags) {
    $result = $this->_discussionTagsDAO->getDiscussionsByTags($discussionTags);
    if ($result->getIsSuccess()) {
      return $result;
    }
    return null;
  }
  
}
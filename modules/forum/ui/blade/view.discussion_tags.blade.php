<?php 

include_once MODULES_FORUM . 'bao/class.discussiontagbao.php';

$discussionTagsBAO = new DiscussionTagsBAO();
$getAllTags = $discussionTagsBAO->getAllTags();
$tagsList = is_null($getAllTags) ? null : $getAllTags->getResultObject();

if (isset($_GET['tags']) && !empty($_GET['tags'])) {
  $discussionTags = $_GET['tags'];
  $discussionList = $discussionTagsBAO->getDiscussionsByTags($discussionTags);
  $discussionList = $discussionList->getResultObject();
}
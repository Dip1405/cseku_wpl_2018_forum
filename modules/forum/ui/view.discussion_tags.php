<?php include_once MODULES_FORUM . 'ui/blade/view.discussion_tags.blade.php'; ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Discussion Tags</h3>
  </div>
  <div class="panel-body">
  <?php
    if (!is_null($tagsList)) {
      foreach ($tagsList as $row) {
        echo '<a href="?tags=' . $row->getDiscussionTag() . '" >' . $row->getDiscussionTag() . 
            '</a>&nbsp;&nbsp;&nbsp;&#10006;&nbsp;';
        echo $row->getDiscussionTagNumber() . '<br>';
      }
    }
  ?>  
  </div>
</div>
<?php
if (isset($_GET['tags']) && !empty($_GET['tags'])) {
  $discussionTags = $_GET['tags'];
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Discussion Tag: <?php echo $discussionTags; ?></h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered">
					<tr>
						<th>Questions</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Views</th>
            <th>Votes</th>
					</tr>
					<?php
						foreach ($discussionList as $discussion) {
          ?>
            <tr>
              <td>
                <a href="discussion_comment.php?view=<?php echo $discussion->getID(); ?>">
										<?php echo $discussion->getName(); ?>
								</a>
              </td>
              <td><?php echo $discussion->getCategoryName(); ?></td>
              <td><?php echo $discussion->getTag(); ?></td>
              <td><?php echo $discussion->getViews(); ?></td>
              <td><?php echo $discussion->getVotes(); ?></td>
            </tr>
          <?php
            }
					?> 
    </div>
  </div>
<?php
}
?>
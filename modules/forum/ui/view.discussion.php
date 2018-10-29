<?php
	include_once 'blade/view.discussion.blade.php';
  include_once COMMON . 'class.common.php';
?>

<div class="panel panel-default">
	<div class="panel-heading">Discussion</div>
	<div class="panel-body">
		<div id="form">
      <form method="post" class="form-horizontal" id="mForm">
	      <div class="form-group">
          <label class="control-label col-sm-4" for="txtQuestion">Question Title : </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txtQuestion" placeholder="Question Title" value="<?php if (isset($_GET['edit'])) echo $getROW->getName(); ?>"/>
          </div>
        </div>
				<div class="form-group">
          <label class="control-label col-sm-4" for="txtCat">Category Name : </label>
          <div class="col-sm-6">
            <?php
              // this block of code prints the list box of roles with current assigned  roles
              $var = '<select name="txtCat" class="form-control"  id="select-from-cat">';
              $Result = $_DiscussionCategoryBAO->getAllDiscussionCategorys();
              //if DAO access is successful to load all the Roles then show them one by one
              if ($Result->getIsSuccess()) {
                $DiscussionCategorys = $Result->getResultObject();
                for ($i = 0; $i < sizeof($DiscussionCategorys); $i++) {
                  $DiscussionCategory = $DiscussionCategorys[$i];
                  $var = $var . '<option value="' . $DiscussionCategory->getID() . '"';
                  $var = $var . '>' . $DiscussionCategory->getName() . '</option>';
								}
                $var = $var . '</select>';
              }
              echo $var;
            ?>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="txtTag">Tag : </label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="txtTag" placeholder="Tag" value="<?php if (isset($_GET['edit'])) echo $getROW->getTag(); ?>"/>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-4" for="txtDes">Description : </label>
          <div class="col-sm-6">
            <textarea rows="10" cols="40" class="form-control" name="txtDes" id="txtDes" placeholder="Description"  value=""><?php if (isset($_GET['edit'])) echo $getROW->getDescription(); ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <?php
              if (isset($_GET['edit'])) {
            ?>
              	<!-- <button type="button" name="update" id="update">update</button> -->
                <input type="submit" name="update" id="update" value="Update">
            <?php
              } else {
            ?>
                <!-- <button type="submit" name="save" id="save">save</button> -->
                <input type="submit" name="save" id="save" value="Save">
            <?php
              }
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="panel-body">
		<table class="table table-bordered">
			<?php
				$Result = $_DiscussionBAO->getAllDiscussions();
        //if DAO access is successful to load all the Terms then show them one by one
        if ($Result->getIsSuccess()) {
					$DiscussionList = $Result->getResultObject();
      ?>
					<tr>
						<th>Questions</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Views</th>
						<th>Answers</th>
            <th>Votes</th>
					</tr>
					<?php
						for ($i = 0; $i < sizeof($DiscussionList); $i++) {
							$Discussion = $DiscussionList[$i];
							$Comments = $_DiscussionBAO->getCommentNumbers($Discussion->getID());
					?>
							<tr>
								<td>
									<a href="discussion_comment.php?view=<?php echo $Discussion->getID(); ?>" onclick="return ; ">
										<?php echo $Discussion->getName(); ?>
									</a>
								</td>
								<td>
									<?php 
										$id = $Discussion->getCategory();
										$Result2 = $_DiscussionBAO->getNameFromCatagoryID($id);
										if ($Result2->getIsSuccess()) {
											$DiscussionCategory = $Result2->getResultObject();
											echo $DiscussionCategory->getName();
                    }
                  ?>
								</td>
								<td><?php echo $Discussion->getTag(); ?></td>
								<td><?php echo $Discussion->getViews(); ?></td>
								<td>
									<?php 
										if ($Comments->getIsSuccess()) {
											echo $Comments->getResultObject();
										}
									?>
                </td>
                <td><?php echo $Discussion->getVotes(); ?></td>
								<td><a href="?edit=<?php echo $Discussion->getID(); ?>" onclick="return confirm('sure to edit !'); ">edit</a></td>
            		<td><a href="?del=<?php echo $Discussion->getID(); ?>" onclick="return confirm('sure to delete !'); ">delete</a></td>
          		</tr>
      <?php
          }
        } else {
					echo $Result->getResultObject(); //giving failure message
        }
      ?>
    </table>
  </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Search Discussion</div>
	<div class="panel-body">
		<table class="table table-bordered">
      <tr>
    	  <th>Category</th>
      </tr>
      <?php
        $Result = $_DiscussionCategoryBAO->getAllDiscussionCategorys();
        //if DAO access is successful to load all the Roles then show them one by one
        if ($Result->getIsSuccess()) {
          $DiscussionCategorys = $Result->getResultObject();
          for ($i = 0; $i < sizeof($DiscussionCategorys); $i++) {
						$DiscussionCategory = $DiscussionCategorys[$i];
			?>
            <tr>
							<td>
								<a href="discussion_search.php?Category=<?php echo $DiscussionCategory->getID(); ?>" onclick="return; ">
									<?php echo $DiscussionCategory->getName() ?> 
								</a>
							</td>
            </tr>
      <?php
      	  }
        }

      ?>
    </table>
  </div>
</div>


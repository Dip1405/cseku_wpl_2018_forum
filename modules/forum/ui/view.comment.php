<?php
	include_once 'blade/view.comment.blade.php';
	include_once COMMON.'class.common.php';
	include_once COMMON.'class.common.forum.php';
?>

<div class="panel panel-default">  
  <div class="panel-heading">Discussion Thread</div>
    <div class="panel-body">
	<div id="form">
		<form method="post" class="form-horizontal">
			<table class="table table-bordered">			
				<?php
					$id = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
					$Discussion2 = substr($id, -38);
					$Result1 = $_CommentBAO->readDiscussion($Discussion2);
					//if DAO access is successful to load all the comments then show them one by one
					if($Result1->getIsSuccess()){
						$Question = $Result1->getResultObject();
				?> 
					<div >
						<tr >
							<td rowspan="4">
								<div style="margin-top: 45px;">
									<button type="button" class="glyphicon glyphicon-triangle-top" id="incQuestionVoteBtn"></button>
									<br>
									<span id="discussionQuestionVote" style="font-size: 35px;">
										<?php echo $Question->getVotes(); ?>
									</span>
									<br>
									<button type="button" class="glyphicon glyphicon-triangle-bottom" id="decQuestionVoteBtn"></button>
								</div>
							</td>
							<td>Question:</td>
						    <td ><h2><?php echo $Question->getName(); ?></h2>
						    	<?php $id = $Question->getCreator();
						    		$Result3 = $_CommentBAO->readDiscussionCreator($id);
						    		if ($Result3->getIsSuccess()) {
						    		$creator = $Result3->getResultObject();
						    		?>
					    			<i><?php echo 'By: '.$creator->getFullName();?></i>
					    			<br>
					    			<i><?php echo $Question->getCreationDate();?></i>
					    			<?php
					    		}
						    	 ?>	
						    		
						    </td>
						</tr>
					</div>
					
						<tr><td>Category : </td>
						    <td>
						    <?php 
							    $id= $Question->getCategory();
							    $Result2 = $_DiscussionBAO->getNameFromCatagoryID($id);
						    	if ($Result2->getIsSuccess()) {
						    		$DiscussionCategory = $Result2->getResultObject();

					    		echo $DiscussionCategory->getName();
					    		} 

				    		?>
			    		
			    			</td>
					    </tr>
					    <tr><td>Tag : </td>
						    <td><?php echo $Question->getTag(); ?></td>
						</tr>
						
						<tr><td>Description : </td>
						    <td><?php echo $Question->getDescription(); ?></td>
						</tr>
						
				    <?php

					

				}
				else{

					echo $Result->getResultObject(); //giving failure message
				}

				?>
				</table>
				<br>

				<?php
				$id = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				//$Discussion2 =  $Discussion1->getID();
				//echo $Discussion2;
				$Discussion2 = substr($id, -38);
				//session_start();

				//$globalUser=$_SESSION["globalUser"]->getID ();
				//print_r($globalUser);
			
				//$Discussion2 =  $Discussion1->getID();
				//echo $Discussion1;
				$Result1 = $_CommentBAO->readComment($Discussion2);

				//if DAO access is successful to load all the comments then show them one by one
				if($Result1->getIsSuccess()){

					$CommentList = $Result1->getResultObject();
						?> 
						<table class="table table-bordered">
							<tr><th>Comments By</th></tr>
							<?php
							for($i = 0; $i < sizeof($CommentList); $i++) {
								$Comment = $CommentList[$i];
								?>
							   
							    <tr>
										<td>
											<div style="margin-top: 45px;">
												<button type="button" class="glyphicon glyphicon-triangle-top" 
												onclick="incCommentVotes(this, '<?php echo $Comment->getCommentID(); ?>')"></button>
												<br>
												<span style="font-size: 35px;">
													<?php echo $Comment->getCommentVotes(); ?>
												</span>
												<br>
												<button type="button" class="glyphicon glyphicon-triangle-bottom" 
												onclick="decCommentVotes(this, '<?php echo $Comment->getCommentID(); ?>')"></button>
											</div>
										</td>
							    	<td>
								    <?php 
									    $id= $Comment->getCreator();
									    $Result5 = $_CommentBAO->readCreator($id);
								    	if ($Result2->getIsSuccess()) {
								    		$user = $Result5->getResultObject();
								    		?>
							    			<i> <?php echo $user->getFullName(); ?></i>
							    			<br>
							    			<i> <?php echo $Comment->getCommentTime(); ?></i>
							    			<?php
							    		} 

						    		?>
					    		
					    			</td>
							    
								    <td><?php echo $Comment->getComment(); ?></td>

							    </tr>
						    <?php

							}

				}
				else{

					echo $Result->getResultObject(); //giving failure message
				}

				?>
				</table>
				<br/>

			<table class="table table-bordered">
				
				<tr>
					<td><label>Comment : </label></td>
					<td><textarea rows="10" cols="40" name="txtAns" placeholder="Make Comment" value="<?php 
					if(isset($_GET['edit'])) echo $getROW->getComment();  ?>" ></textarea></td>
				</tr>
			</table>
				<input type='text' name ="txtComment" value="<?php echo $Discussion2 ; ?>" placeholder="<?php echo $Discussion2 ; ?>" style="display: none"/>
				<table width="100%" border="1" cellpadding="15" bgcolor=" #8AA6AA">
				<tr>
					<td>
						<?php
						if(isset($_GET['edit']))
						{
							?>
							<button type="submit" name="update">Update</button>
							<?php
						}
						else
						{
							?>
							<button type="submit" name="save">Submit</button>
							<?php
						}
						
						?>
					</td>
				</tr>
			</table>

		</form>
	</div>	
</div>	

<script>

	$(document).ready(function() {
		$('#incQuestionVoteBtn').click(function() {
			var questionId = "<?php echo isset($_GET['view']) ? $_GET['view'] : null; ?>";
		
			$.ajax({
				url: 'ajax/incvote.php',
				type: 'GET',
				data: {id : questionId},
				success: function(response) {
					var jsonObj = JSON.parse(response);
					if (jsonObj.data.length > 0) {
						$('#discussionQuestionVote').text(jsonObj.data[0]);
					} else {
						console.log(jsonObj.error);
					}
				},
				error: function(error) {
					console.log('What is going on.' + error);
				}
			});
		});

		$('#decQuestionVoteBtn').click(function() {
			var questionId = "<?php echo isset($_GET['view']) ? $_GET['view'] : null; ?>";
			
			$.ajax({
				url: 'ajax/decvote.php',
				type: 'GET',
				data: {id : questionId},
				success: function(response) {
					var jsonObj = JSON.parse(response);
					if (jsonObj.data.length > 0) {
						$('#discussionQuestionVote').text(jsonObj.data[0]);
					} else {
						console.log(jsonObj.error);
					}
				},
				error: function(error) {
					console.log('What is going on.' + error);
				}
			});
		});
	});

	function incCommentVotes(el, commentId) {
		$.ajax({
			url: 'ajax/inccommentvote.php',
			method: 'GET',
			data: {id: commentId},
			success: function (response) {
				var jsonObj = JSON.parse(response);
				if (jsonObj.data.length > 0) {
					$(el).next().next().text(jsonObj.data[0]);
				} else {
					console.log(jsonObj.error);
				}
			},
			error: function (error) {
				console.log('What is going on.' + error);
			}
		});
	}
	
	function decCommentVotes(el, commentId) {
		$.ajax({
			url: 'ajax/deccommentvote.php',
			method: 'GET',
			data: {id: commentId},
			success: function (response) {
				var jsonObj = JSON.parse(response);
				if (jsonObj.data.length > 0) {
					$(el).prev().prev().text(jsonObj.data[0]);
				} else {
					console.log(jsonObj.error);
				}
			},
			error: function (error) {
				console.log('What is going on.' + error);
			}
		});
	}

</script>
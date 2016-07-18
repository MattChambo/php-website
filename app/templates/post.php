<?php $this->layout('master', [
		'title'=>'Post page',
		'desc'=>'View an individual post'
	]);
?> 
<body>

<h1><?= $this->e($post['title']) ?></h1>

<p><?= $this->e($post['description']) ?></p>

<img src="img/uploads/original/<?= $post['image'] ?>" alt="">

<ul>
	<li>Post Created: <?= $post['created_at'] ?></li>
	<li>Post last updated: <?= $post['updated_at'] ?></li>
	<li>Posted by: <?= $this->e($post['first_name'].' '.$post['last_name']) ?></li>
</ul>

<section>
	
	<h1>Comments: (<?= count($allComments) ?>)</h1>

	<form action="index.php?page=post&postid=<?= $_GET['postid'] ?>" method="post">

	<label>Write a comment: </label>
	<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
	<input type="submit" name="new-comment" value="Submit">

	</form>

	<?php foreach($allComments as $comment): ?>

	<article>

		<p><?= htmlentities($comment['comment']) ?></p>
		<small>Writen by: <? htmlentities($comment['author']) ?></small>

		<?php

			// Is the visitor logged in?
			if( isset($_SESSION['id']) ) {

				// Does this user own the comment?
				if( $_SESSION['id'] == $comment['user_id'] ) {

					// Yes This user owns the comment!
					echo 'Delete';
					echo '<a href="index.php?page=edit-comment&id='.$comment['id'].'">Edit</a>';

				}
			}

		?>

	</article>

	<?php endforeach ?>

</section>
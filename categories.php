<?php require_once('includes/header.php');?>
<?php require_once('lib/dbOperations.php');?>
<?php require_once('includes/navigation.php');?>
<div class="row">
  <div class="column side">
  <?php require_once('includes/sidebar.php');?>
  </div>
  <div class="column middle">
    <div class="actions">
      <?php if(isset($_SESSION['username']) and $_SESSION['username'] == 'task') echo '<a class="linkaction" href="categoryAction.php">Add Category</a>' ?>
    <div style="clear:both;"></div>  
    </div>
    <?php $data = fetchRecordAll('category'); ?>
    <?php foreach($data as $category){?>
    <div class="box">
      <h2><?php echo $category['name'];?></h2>
      <p><?php echo $category['desc'];?></p>
      <hr />
      <div class="actions">
      <?php if(isset($_SESSION['username']) and $_SESSION['username'] == 'task') echo '<a class="linkaction" href="categoryAction.php?action=delete&id='.$category['id'].'">Delete Category</a>' ?>
      <?php if(isset($_SESSION['username']) and $_SESSION['username'] == 'task') echo '<a class="linkaction" href="categoryAction.php?action=update&id='.$category['id'].'">Update Category</a>' ?>
        <div style="clear:both;"></div>  
      </div>

      </a>
    </div>
    <?php } ?>


  </div>
  <div class="column side">Column</div>
</div>
<?php require_once('includes/footer.php');?>


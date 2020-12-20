<?php require_once('includes/header.php');?>
<?php require_once('lib/cleanOperations.php');?>
<?php require_once('lib/dbOperations.php');?>
<?php require_once('includes/navigation.php');?>
<div class="row">
  <div class="column side">
  <?php require_once('includes/sidebar.php');?>
  </div>
  <div class="column middle">
   <?php
    $category = array();   
    if(isset($_POST) and $_POST){
        // action for deletion or update
      // echo "Entered POST";
        $cleanData = clean($_POST);
        // echo $cleanData['id'];
        // print_r($cleanData);
        // echo array_key_exists('id', $cleanData);
        // echo isset($cleanData['id']); 
        // $idData = isset($cleanData['id']) ? $cleanData['id'] : 'NULL';
        // echo $idData;
        // echo $cleanData['id'];
      //   if ($value = $cleanData[ 'id' ] ?? null) {
      // //Your code here
      //     echo $value;
      //   }
        // updateRecord('category',$cleanData['id'],$cleanData);
        if (array_key_exists('update', $cleanData) and isset($cleanData['update'])) {
          // echo "Entered Updation";
          updateRecord('category',$cleanData['id'],$cleanData);
        } else if (array_key_exists('add', $cleanData) and isset($cleanData['add'])) {
          // echo "Entered Insertion";
          $response = insertRecord('category',$cleanData);
          if($response===true){
            header('location:categories.php');
          } else {
            $err_msg = 'Something went wrong';
          }
        }
    } else if(isset($_GET['action'])){
        // echo "Entered GET";
        // clean data
        // display form with existing data
        $cleanData = clean($_GET);
        // $cleanData = $_GET;
        if($cleanData['action']=='update'){
            $category = fetchRecordSpecific('category',$cleanData['id']);
            //var_dump($category);
            if(empty($category)){
                $err_msg = 'No Records Found';
            }
        }
        if($cleanData['action']=='delete'){
            $response = deleteRecord('category',$cleanData['id']);
        }
      }
    ?>
    <div class="login">
  <fieldset>
  <legend>Update Category details</legend>
  <?php 
  if(isset($err_msg) and $err_msg) {
    echo '<div class="error">'.$err_msg.'</div>';
    echo '<div class="column side">Column</div> ';
          require_once('includes/footer.php');

    exit();
  }
  ?>
  <form action="categoryAction.php" method="post" class="login">
  <input type="hidden" name="id" value="<?php if(isset($category['id']) and $category['id']) echo $category['id'];?>" />
  <table width="100%">
    <tr>
      <td> Name : </td>
      <td><input type="text" name="name" value="<?php if(isset($category['name']) and $category['name']) echo $category['name'];?>" required /></td>
    </tr>
    <tr>
      <td> Desc : </td>
      <td><textarea name="desc" rows="4" cols="50" required><?php if(isset($category['desc']) and $category['desc']) echo $category['desc'];?></textarea></td>
    </tr>
    <tr>
      <td> Status </td>
      <td>
          <input 
                type="radio"
                name="status"
                value="A"
                required
               <?php if(isset($category['status']) and $category['status']) echo $category['status'] == 'A'? 'checked':''; ?> />Show
        <input 
                type="radio"
                name="status"
                value="I"
                <?php if(isset($category['status']) and $category['status']) echo $category['status'] == 'I'?'checked':''; ?> />Hide        
       </td>
    </tr>
    <tr>
      <td> &nbsp;</td>
      <?php
      if(isset($category['id']) and $category['id']) {
        echo '<td><input type="submit" name="update" value=" Update "/></td>';
      } else {
        echo '<td><input type="submit" name="add" value=" Add Category "/></td>';
      }
      ?>
      <!-- <td><input type="submit" name="sub" value=" Update "/></td> -->
    </tr>
  </table>   
  </form>
  </fieldset>
</div>
    <?php
        // }
   ?>
  </div>
  <div class="column side">Column</div>
</div>
<?php require_once('includes/footer.php');?>


<div class="row tab-top">
    <div class="col-md-4 col-xs-4">Nom</div>
    <div class="col-md-4 col-xs-4">Catégorie</div>
    <div class="col-md-4 col-xs-4">Date d'ajout</div>
</div>
<div class="row">
<?php foreach($results as $search_result){?>
  <div class="item-result">
    <div class="col-md-4 col-xs-4"><?php echo $search_result['name'];?></div>
    <div class="col-md-4 col-xs-4"><?php echo $search_result['category_name'];?></div>
    <div class="col-md-4 col-xs-4"><?php echo $search_result['date'];?></div>
  </div>
<?php } ?>
</div>
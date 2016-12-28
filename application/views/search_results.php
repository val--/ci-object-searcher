<div>
<strong><?php 
$nb_results = count($results);
echo $nb_results;?> résultat(s)</strong> correspond(ent) à votre recherche.

<?php if($nb_results > 0){?>
<div class="paginator"></div>
<div class="search-results">
  <table class="table">
      <thead>
      <tr>
        <th>Nom <span class="sort-icon asc glyphicon glyphicon-sort-by-alphabet" id="name" aria-hidden="true"></span><span class="sort-icon name-sort desc glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true" id="name"></span></th>
        <th>Catégorie <span class="sort-icon asc glyphicon glyphicon-sort-by-alphabet" id="category" aria-hidden="true"></span><span class="sort-icon category-sort desc glyphicon glyphicon-sort-by-alphabet-alt" aria-hidden="true" id="category"></span></th>
        <th>Date d'ajout <span class="sort-icon asc glyphicon glyphicon-sort-by-order" id="date" aria-hidden="true"></span><span class="sort-icon date-sort desc glyphicon glyphicon-sort-by-order-alt" aria-hidden="true" id="date"></span></th>
      </tr>    
      </thead>
  <tbody>
  <?php foreach($results as $search_result){?>
    <tr class="result-row">
      <td class="cell-name"><?php echo $search_result['name'];?></td>
      <td class="cell-category"><?php echo $search_result['category_name'];?></td>
      <td class="cell-date" data-timestamp="<?php echo(strtotime($search_result['date']));?>"><?php
      $timestamp = strtotime($search_result['date']);
      echo date("d/m/Y à h:i", strtotime($search_result['date']));?></td>
    </tr>
  <?php } ?>
  </tbody>
  </table>
</div>
<?php } ?>
</div>
<div class="paginator"></div>

<script>
$(document).ready(function() {
  // Pagination (30 items). Le fichier se trouve dans assets/js/pagination.js
  pagination(30,'.result-row','.paginator');
});

/* Fonction renvoyant les résultats triés selon l'ordre souhaité (critères "date", "nom de l'objet" ou "nom de la catégorie").
Elle se répète par rapport à la fonction "renderSearchResults"... A optimiser !*/
function sortSearchResults(e, field, order) {

  var keyword = $("#keyword").val();
  var date = $("#datepicker").val();
  var category = $("#category").val();
  var field = $(this).attr('id');
  var order = $(this).hasClass( "asc" ) ? "asc" : "desc";

  // Quelques vérifications basiques
  if(keyword.length < 2 && category == 0 && date == ''){
    $(".search-results-container").empty();
    $(".search-results-container").append('<p>Vous devez indiquer un mot-clé contenant au moins <strong>2 caractères</strong>. Vous pouvez également chercher par nom de catégorie et par date.</p>');
    return false;
  }
  if(keyword.length > 30){
    $(".search-results-container").empty();
    $(".search-results-container").append('<p>Le mot-clé ne doit pas faire plus de 30 caractères.</p>');
    return false;
  }

  // Requête AJAX renvoyant les résultats de la recherche dans un div
  $.post("/search/do_search/", {keyword: keyword, date:date, category:category, field:field, order:order}, function(data) {
    $(".search-results-container").empty();
    $(".search-results-container").append(data);
  });

  return false
}
$(".sort-icon").click(sortSearchResults);
</script>
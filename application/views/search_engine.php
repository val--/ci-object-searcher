<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery-ui.css"); ?>" />
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.1.1.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-ui.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/pagination.js"); ?>"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script>
	  $( function() {
	    $( "#datepicker" ).datepicker({
	    	dateFormat: 'dd/mm/yy'
	    });
	  } );
	</script>
</head>
<body>
<div class="container">
	<div class="row">

		<div class="col-md-12 title-container">
			<h1>🛠 Objects Search Engine 🛠</h1>
		</div>

		<div class="col-md-12">

		<?php echo form_open('search/do_search');?>

            <div class="input-group" id="adv-search">
                <input type="text" name="search" id="keyword" class="form-control search-input" placeholder='Rechercher un objet (ex. "Agrafeuse")' />
                <div class="input-group-btn">
                	<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </div>
            </div>

			<div class="filters">
				<div class="form-group filter-category">
						<select id="category" class="form-control">
						<option value="0" selected>Toutes les catégories</option>
						<?php foreach($categories as $category){?>
						<option value="<?php echo($category['category_id']);?>"><?php echo($category['name']);?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group filter-date">
					<input class="form-control" type="text" name="date" id="datepicker" placeholder="Date d'ajout" />
				</div>
			</div>
            <?php echo form_close();?>
        </div>

		<div class="col-md-12 search-results-container">
		</div>

        </div>
	</div>
</div>

<script>
$(document).ready(function() {
      $("form").submit(renderSearchResults);

      function renderSearchResults(e) {

           e.preventDefault();
           var keyword = $("#keyword").val();
           var date = $("#datepicker").val();
           var category = $("#category").val();

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
           $.post("/search/do_search/", {keyword: keyword, date:date, category:category}, function(data) {
           		$(".search-results-container").empty();
				$(".search-results-container").append(data);
          });

/*       //this.reset();
         $("#keyword").val('') // on ne remet à zéro que le champ du mot clé 
         $("#datepicker").val(''); // ... et la date*/

      }
});
</script>
</body>
</html>
$(document).ready(function(){


		$('#champRechercheMessagerie').keyup(function(){

			var contextName = $(this).context.name;

			$('#result-search').html('');

			var utilisateur = $(this).val();
			var url;

			switch (contextName){
				case 'input_search_messenger':
					url = 'recherche_utilisateur.php';
					break;
				case 'mail':
					url = 'recherche_utilisateur_enterResults.php';
					break;
				
				default:
					console.log('Erreur, veuillez verifier le nom du champ de recherche');

			}

			if (utilisateur != ""){

				$.ajax({
					type: 'GET',
					url: url,
					data: 'userSearch=' + encodeURIComponent(utilisateur),
					success: function(data){
						if(data != ""){
							$('#result-search').append(data);
						}
						else{
							document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px>Aucun utilisateur trouvé</div>"
						}
					}


				});

			}


		});
	});
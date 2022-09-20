<?php
    ######################
    # Postulante: Anders RM
    # Fecha: 20/09/2022
    # Telefono: +51970502429
    # Corre: PHP
    ######################

	header('Content-type: application/json;');
	$url = './movies.json'; // path to your JSON file
	$data = file_get_contents($url); // put the contents of the file into a variable
	$movies = json_decode($data, true);


	$newArray = [];

    foreach ($movies as $movie){
        foreach ($movie['genre'] as $key=>$value){
            $newArray[$value]['name']=$value;
            $newArray[$value]['total_movies']=$newArray[$value]['total_movies']+1;

            $movieArray = [];
            foreach ($movie as $key2=>$value2){
                $movieArray[$key2] = $value2;
            }
            $newArray[$value]['total_minutes'] += $movieArray['runtime'];
            $newArray[$value]['average_minutes'] = $newArray[$value]['total_minutes']/$newArray[$value]['total_movies'];

            unset($movieArray['id']);
            unset($movieArray['rated']);
            unset($movieArray['released']);
            unset($movieArray['genre']);

            $newArray[$value]['movies'][] = $movieArray;
        }
    }

	/*Ïmprime contenido del Json*/
	print_r('Original Json'.json_encode($movies, JSON_PRETTY_PRINT));

	/*Ïmprime contenido del nuevo Array*/
	print_r('Grouped Json'.$execution_time.json_encode($newArray, JSON_PRETTY_PRINT));

?>

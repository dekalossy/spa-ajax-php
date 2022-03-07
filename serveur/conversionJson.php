 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Convert Data from Mysql to JSON Format using PHP</title>  
      </head>  
      <body>  
           <?php 
           require("bdd.php");

           $listeFilms = $bdd->query('SELECT * FROM films');
            
           $json_array = array();  

            while($films = $listeFilms->fetch(PDO::FETCH_ASSOC)) 
           {  

                $json_array[]= $films; 

           }  
           /*echo '<pre>';  
           print_r(json_encode($json_array));  
           echo '</pre>';*/  
           echo json_encode($json_array);  
           ?>  
      </body>  
 </html>  
# suplosBackEnd  
## Presentado por: *Mauricio Cantor*  
  
Para una correcta valoración de la herramienta puede seguir los siguientes paso:  
  
1. en la consola de Windows diríjase al proyecto y en la carpeta *Back* corra el comando:  
  
``` composer install ```  
  
2. en la carpeta **Back** encontrara una archivo nombrado **backup_test.sql** , allí tendrá una copia de la Base de Datos    
elaborada en MySQL para la elaboracion de los puntos 4 y 5 del ejercicio  
   
3. Para un funcionamiento optimo del sitio se recomienda correr con el servidor de PHP para hacer la prueba, en la raíz del proyecto se puede correr el siguiente comando:  
  
``` php -S localhost:8888 ```   
------  
  
La elaboración del Back se realizo empleando la técnica de frontController con el fin de tener las URL amigables,  
para la conexión a la BD se empleo el ORM de Doctrine con el fin de realizar mas rápida la conexión y emplear   
esta herramienta como método de evitar errores con código puro
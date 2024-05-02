// --- Instrucciones para levantar el proyecto ---

desde la consola ejecutar:

    $ docker compose up -d --build

    Eso levantará los servicios correspondientes para poder usar el proyecto.


Home del Proyecto:
http://localhost:8000/

PhpMyAdmin para ver la DB: (a veces tarda unos segundos en levantar todo)
http://localhost:8080



Debería ejecutarse automaticamente y por unica vez el script SQL que crea la tabla "users".

    En caso de que no, se haya creado la tabla correctamente ejecutar /sql/users.sql dentro del PhpMyAdmin para crear dicha tabla.



// --- Instrucciones para levantar el proyecto ---

desde la consola ejecutar:

    $ docker compose up -d --build

    Eso levantará los servicios correspondientes para poder usar el proyecto.


Home del Proyecto:
http://localhost:8000/

PhpMyAdmin para ver la DB: (a veces tarda unos segundos en levantar todo)
http://localhost:8080

user: user
password: password



Debería ejecutarse automaticamente y por unica vez el script SQL que crea la tabla "users".

    En caso de que no, se haya creado la tabla correctamente ejecutar /sql/users.sql dentro del PhpMyAdmin para crear dicha tabla.
    Este Script tambien va a crear el usuario para ingresar por primera vez al sistema

    user: admin@admin.com
    pass: admin

Tambien subí todo a un servidor de prueba para poder mostrar el desarrollo:

Un pequeño front trayendo los datos con JQuery
https://artemisa-code.alwaysdata.net/urbano/front.php

El Back-End
https://artemisa-code.alwaysdata.net/urbano/views/loginForm.php


El link a GitHub del repo:
https://github.com/hernansm1983/challenge_urbano_mvc

Los archivos terminados en "...Artemisa.php" tienen configuraciones diferentes por el hosting de prueba que estoy usando (desestimarlos en el analisis del desarollo)

Nota: Quiza encuentren que en el userController, el metodo "save" está un poco sobrecargado de responsabilidades, me hubiese gustado dejarlo mas prolijo y separar la parte de validaciones en otro método.

Tuve en cuenta traer los datos al front por medio de Jquery, está todo el proyecto Dockerizado, usando PHP puro (sin frameworks) y como MySQL como base de datos.


Espero que se entienda, y desde ya muchas gracias.

Atte. Hernan Diego San Martin.
her_san_martin@hotmail.com
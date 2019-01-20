# Desarrollo de una API REST | SYMFONY.
#### Asignatura: *Backend con Tecnologías de Libre Distribución - PHP*
#### [Máster en Ingeniería Web por la U.P.M.](http://miw.etsisi.upm.es)

### Descripción
Se proporciona una especificación y un esqueleto de desarrollo basado en Symfony y se desarrollará una API completa
empleando como base el modelo de datos utilizado en la práctica anterior. Las operaciones que deberá proporcionar la
interfaz de programación para gestionar usuarios son:
####  Users
* `GET` /users : Returns all users
* `POST` /users : Creates a new user
* `OPTIONS` /users : Provides the list of HTTP supported methods
* `GET` /users/{userId} : Returns a user based on a single ID
* `PUT` /users/{userId} : Updates a user
* `DELETE` /users/{userId} : Deletes a user
* `OPTIONS` /users/{userId} : Provides the list of HTTP supported methods

De manera análoga, para la gestión de resultados se dispone de operaciones similares:
#### Results
* `GET` /results : Returns all results
* `POST` /results : Creates a new result
* `OPTIONS` /results : Provides the list of HTTP supported methods
* `GET` /results/{resultId} : Returns a result based on a single ID
* `PUT` /results/{resultId} : Updates a result
* `DELETE` /results/{resultId} : Deletes a result
* `OPTIONS` /results/{resultId} : Provides the list of HTTP supported methods

La especificación de la API se ha realizado de acuerdo a la especificación de la OAI (Open API Initiative) [4](https://www.openapis.org/).
Dicha especificación puede modificarse empleando un editor online (como el proporcionado en [3](http://editor.swagger.io/)), o bien a través de
anotaciones en la propia implementación de la API empleando herramientas específicas (p.ej. `zircote/swagger` [5](http://zircote.com/swagger-php/)).
Si se realiza alguna modificación, se recomienda realizar la verificación de la especificación con alguna herramientas
online (p.ej. [6](https://github.com/APIDevTools)).

Se incluye el cliente de Swagger, que estará accesible a través de la ruta /api-docs/ del servidor y puede ser utilizado
para verificar el correcto funcionamiento de la API. Este cliente lee la especificación (fichero openapi.json) del subdirectorio models.

Adicionalmente se incluye el directorio /tests para desarrollar las pruebas unitarias y funcionales empleando el framework
PHPUnit [7](https://phpunit.de/). Se propone como ejercicio adicional la implementación de pruebas funcionales que permitan verificar de manera
automática el correcto funcionamiento completo de la API.

## Observaciones
* Todas las operaciones consumirán y generarán siempre documentos en formato JSON. Análogamente, las operaciones de tipo POST y PUT recibirán también los datos en notación JSON.
* La implementación de esta tarea se realizará empleando el framework Symfony4 [2](https://symfony.com/).
* Se podrán además utilizar cuantos bundles públicos se consideren oportunos.
* Adicionalmente se deberá emplear un ORM (p.ej. Doctrine, Propel, Eloquent, etc). Doctrine 2 es un Object-Relational Mapper para PHP 5.4+ que proporciona persistencia transparente para objetos PHP. Utiliza el patrón Data Mapper con el objetivo de obtener un desacoplamiento completo entre la lógica de negocio y la persistencia de los datos en un SGBD.

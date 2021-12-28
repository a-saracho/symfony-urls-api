# Prueba Técnica API

Api Rest implementada en [Symfony](https://symfony.com) con base de datos SQLite para prueba técnica de desarrollador Backend PHP. 


## Instalación

Requisitos previos: Requiere PHP ^8.0, Composer y Symfony 6

* Clonar el repository desde github.
* Instalar las dependencias mediante `composer install`
* Ejecutar las migraciones mediante `php bin/console doctrine:migrations:migrate`
* Iniciar symfony mediante `symfony server:start`


## REST-API Endpoints

Listado de endpoints de la api (v1):

### Crear url corta

**Endpoint:** `[POST] v1/urls`

**Params:**
* _originalUrl_ - Url para acortar.

**Response:**
* _shortUrl_ - Código de la url acortada.

**Ejemplo**

	# request ==> /v1/urls?originalUrl=https://www.google.es/

	# <== response
	{ "shortUrl": "1234567890" }


### Listar urls

**Endpoint:** `[GET] v1/urls`

**Params:**

* Sin parámetros por el momento.

**Response:**

* Array de urls en formato Json.


### Obtener url original

**Endpoint:** `[GET] /v1/short-url/{shortUrl}`

**Params:**
* _shortUrl_ - Código de la url acortada.

**Response:**
* _originalUrl_ - Url para acortar.

**Ejemplo**

	# request ==> /v1/short-url/pgesswgw

	# <== response
	{ "originalUrl": "https://wordpress.org/" }


### Eliminar url

**Endpoint:** `[DELETE] /v1/urls/{id}`

Importante: Requiere token de autenticación JWT suministrado en el Header

**Params:**
* _id_ - Id de la url a eliminar.

**Response:**
* _message_ - Mensaje de éxito o error.

**Ejemplo**

	# request ==> /v1/urls/2

	# <== response
	{ "message": "Deleted url with id 2" }


### Registrar Usuario

**Endpoint:** `[POST] /v1/register`

**Params:**
* _email_ - Email para el nuevo usuario.
* _password_ - Password para el nuevo usuario.

**Response:**
* _message_ - Mensaje de éxito o error.

**Ejemplo**

	# request ==> /v1/register?email=test@test.com&password=password

	# <== response
	{ "message": "User successfully created" }


### Login Usuario

**Endpoint:** `[ANY] /v1/login`

**Request:**
* _email_ - Email del usuario.
* _password_ - Password del usuario.

**Response:**
* _token_ - Token de autenticación del usuario.

**Ejemplo**

	# request ==> /v1/login
	{ "email": "test@test.com" , "password" : "password" }

	# <== response
	{    "token" : "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzQ3Mjc1MzYsInVzZXJuYW1lIjoia29ybGVvbiIsImlhdCI6IjE0MzQ2NDExMzYifQ.nh0L_wuJy6ZKIQWh6OrW5hdLkviTs1_bau2GqYdDCB0Yqy_RplkFghsuqMpsFls8zKEErdX5TYCOR7muX0aQvQxGQ4mpBkvMDhJ4-pE4ct2obeMTr_s4X8nC00rBYPofrOONUOR4utbzvbd4d2xT_tj4TdR_0tsr91Y7VskCRFnoXAnNT-qQb7ci7HIBTbutb9zVStOFejrb4aLbr7Fl4byeIEYgp2Gd7gY" }


## Bundles

Contiene los siguientes bundles:
* [symfony/orm-pack](https://symfony.com/doc/current/doctrine.html)
* [symfony/security-bundle](https://symfony.com/doc/current/security.html)
* [symfony/validator](https://symfony.com/doc/current/validation.html)
* [symfony/form](https://symfony.com/doc/current/forms.html)
* [symfony/var-dump](https://symfony.com/doc/current/components/var_dumper.html)
* [FOS/RestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle)
* [jms/serializer-bundle](https://github.com/schmittjoh/JMSSerializerBundle)
* [lexik/jwt-authentication-bundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

## Autores

* **Ainara Saracho** - *Desarrollo* - [a-saracho](https://github.com/a-saracho)

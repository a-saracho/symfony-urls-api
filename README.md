# Prueba Técnica API

Api Rest implementada en [Symfony](https://symfony.com) para prueba técnica de desarrollador Backend PHP. 

## REST-API Endpoints

Listado de endpoints de la api (v1):

### Crear url corta

**Endpoint:** `[POST] v1/urls`

**Request:**
* _originalUrl_ - Url para acortar.

**Response:**
* _shortUrl_ - Código de la url acortada.

**Ejemplo**

	# request ==>
	{ "originalUrl": "https://wordpress.org/" }

	# <== response
	{ "shortUrl": "1234567890" }


### Listar urls

**Endpoint:** `[GET] v1/urls`

**Request:**

* Sin parámetros por el momento.

**Response:**

* Array de urls en formato Json.


### Obtener url original

**Endpoint:** `[GET] /v1/short-url/{shortUrl}`

**Request:**
* _shortUrl_ - Código de la url acortada.

**Response:**
* _originalUrl_ - Url para acortar.

**Ejemplo**

	# request ==>
	{ "shortUrl": "1234567890" }

	# <== response
	{ "originalUrl": "https://wordpress.org/" }


### Eliminar url

**Endpoint:** `[DELETE] /v1/urls/{id}`

Importante: Requiere token de autenticación JWT suministrado en el Header

**Request:**
* _id_ - Id de la url a eliminar.

**Response:**
* _message_ - Mensaje de éxito o error.

**Ejemplo**

	# request ==>
	{ "id": "2" }

	# <== response
	{ "message": "Deleted url with id 2" }


### Registrar Usuario

**Endpoint:** `[POST] /v1/register`

**Request:**
* _email_ - Email para el nuevo usuario.
* _password_ - Password para el nuevo usuario.

**Response:**
* _message_ - Mensaje de éxito o error.

**Ejemplo**

	# request ==>
	{ "email": "test@test.com" , "password" : "password" }

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

	# request ==>
	{ "email": "test@test.com" , "password" : "password" }

	# <== response
	{    "token" : "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXUyJ9.eyJleHAiOjE0MzQ3Mjc1MzYsInVzZXJuYW1lIjoia29ybGVvbiIsImlhdCI6IjE0MzQ2NDExMzYifQ.nh0L_wuJy6ZKIQWh6OrW5hdLkviTs1_bau2GqYdDCB0Yqy_RplkFghsuqMpsFls8zKEErdX5TYCOR7muX0aQvQxGQ4mpBkvMDhJ4-pE4ct2obeMTr_s4X8nC00rBYPofrOONUOR4utbzvbd4d2xT_tj4TdR_0tsr91Y7VskCRFnoXAnNT-qQb7ci7HIBTbutb9zVStOFejrb4aLbr7Fl4byeIEYgp2Gd7gY" }


## Bundles

Contiene los siguientes bundles:
* [symfony/orm-pack](https://symfony.com/doc/current/doctrine.html)
* [symfony/security-bundle](https://symfony.com/doc/current/security.html)
* [symfony/validator](https://symfony.com/doc/current/validation.html)
* [symfony/form](https://symfony.com/doc/current/forms.html)
* [symfony/form](https://symfony.com/doc/current/forms.html)
* [symfony/var-dump](https://symfony.com/doc/current/components/var_dumper.html)
* [FOS/RestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle)
* [jms/serializer-bundle](https://github.com/schmittjoh/JMSSerializerBundle)
* [lexik/jwt-authentication-bundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

## Autores

* **Ainara Saracho** - *Desarrollo* - [a-saracho](https://github.com/a-saracho)
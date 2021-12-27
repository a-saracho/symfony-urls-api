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

**Request:**
* _id_ - Id de la url a eliminar.

**Response:**
* _message_ - Mensaje de éxito o error.

**Ejemplo**

	# request ==>
	{ "id": "2" }

	# <== response
	{ "message": "Deleted url with id 2" }




## Autores

* **Ainara Saracho** - *Desarrollo* - [a-saracho](https://github.com/a-saracho)
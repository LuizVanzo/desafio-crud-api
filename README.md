# desafio-crud-api

# Como rodar o projeto com Docker (Laravel Sail)

## Passos

1. **Clone o repositório**
	```bash
	git clone https://github.com/LuizVanzo/desafio-crud-api.git
	cd desafio-crud-api
	```

2. **Copie o arquivo de ambiente**
	```bash
	cp .env.example .env
	```

3. **Instalação das dependencias Composer**
	```bash
	composer install
	```

4. **Suba os containers**
	```bash
	./vendor/bin/sail up
	```

5. **Rode as migrations**
	```bash
	./vendor/bin/sail artisan migrate
	````
6. **Crie as Chave**
```bash
./vendor/bin/sail artisan passport:keys
````

6. **Acesse o projeto**
	- API: http://localhost:8000/api
    - DOC ROTAS: http://localhost:8000/api/documentation

## Estrutura do Projeto

```
app/
├── Http/Controllers/API/
│   └── AuthController.php      # Controlador de autenticação
│   └── LocalController.php     # Controlador do crud
├── Models/                     # Models
│   └── Local.php
│   └── User.php  
└── Providers/
    └── AppServiceProvider.php  # Configurações do Passport para expiração do token

routes/
├──api.php # rotas

bootstrap/
├──app.php # rotina para tratar rotas inexistentes

config/
├── l5-swagger.php             # Configuração do Swagger
```

## Segurança

- Autenticação via OAuth2 (Laravel Passport)
- Middleware de autenticação com tempo para expirar o token

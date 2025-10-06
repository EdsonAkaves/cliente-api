# Cliente para Consumo de API CRUD PHP

Cliente PHP para consumo de API REST com autenticação JWT, desenvolvido para testar operações CRUD em uma API de gerenciamento de clientes.

## 📋 Funcionalidades

- ✅ Autenticação via JWT (login)
- ✅ Atualização de registros de clientes (PUT)
- ✅ Tratamento de erros de requisição
- ✅ Uso de variáveis de ambiente para credenciais

## 🚀 Tecnologias Utilizadas

- PHP 8.2+
- cURL para requisições HTTP
- vlucas/phpdotenv para gerenciamento de variáveis de ambiente
- Composer para gerenciamento de dependências

## 📦 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/seu-usuario/api-crud-client.git
cd api-crud-client
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure as variáveis de ambiente

Crie um arquivo `.env` na raiz do projeto:

```env
# URL base da sua API (ajuste conforme seu ambiente)
API_BASE_URL=http://localhost/sua-api/api

# Credenciais de teste
API_BASE_URL=http://localhost:8000/api
TEST_USER_EMAIL=usuario@exemplo.com
TEST_USER_PASSWORD=sua_senha_segura
```

**Exemplos de API_BASE_URL**:
- Desenvolvimento local: `http://localhost/php-vanilla-crud-api/api`
- Servidor embutido PHP: `http://localhost:8000/api`
- Produção: `https://api.seudominio.com`

### 4. Configure o .gitignore

Certifique-se de que seu arquivo `.gitignore` contém:

```
/vendor/
.env
.env.local
```

## 🔧 Uso

Execute o script principal:

```bash
php consumir_api.php
```

### Exemplo de Saída

```
Iniciando processo...
1. Realizando Login na API...
Login realizado com sucesso (Status: 200)
Token obtido com sucesso.
2. Realizando a atualização do cliente...
Resposta da API de atualização (Status: 200):
{"mensagem":"Cliente atualizado com sucesso"}
Cliente atualizado com sucesso!

Processo finalizado.
```

## 📂 Estrutura do Projeto

```
.
├── consumir_api.php      # Script principal do cliente
├── composer.json         # Dependências do projeto
├── composer.lock         # Versões exatas das dependências
├── .env                  # Variáveis de ambiente (não versionado)
├── .env.example          # Exemplo de configuração
├── vendor/               # Dependências instaladas (não versionado)
└── README.md             # Este arquivo
```

## 🔐 Segurança

- **Nunca** commite o arquivo `.env` no repositório
- Use variáveis de ambiente para dados sensíveis
- Em produção, considere usar secrets managers
- Implemente rate limiting nas requisições
- Valide sempre os certificados SSL (em produção, remova `CURLOPT_SSL_VERIFYPEER => false`)

## 🛠️ Personalização

### Alterando o ID do cliente a ser atualizado

No arquivo `.env`, altere o valor de TEST_USER_ID:

TEST_USER_ID=10  # Altere para o ID desejado

### Modificando os dados de atualização

Linhas 72-76:

```php
$dataUpdate = [
    'nome' => 'Seu Nome',
    'email' => 'seu.email@exemplo.com',
];
```

## 📝 Dependências

Adicione ao seu `composer.json`:

```json
{
    "require": {
        "vlucas/phpdotenv": "^5.6"
    }
}
```

## 🐛 Tratamento de Erros

O cliente trata os seguintes erros:

- Erros de conexão cURL
- Falhas de autenticação
- Token não encontrado na resposta
- Erros HTTP (códigos diferentes de 200)

## 📖 Endpoints da API

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| POST | `/login.php` | Autenticação do usuário |
| PUT | `/atualizar_cliente.php?id={id}` | Atualização de cliente |

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 👨‍💻 Autor

Desenvolvido como projeto de estudo de APIs REST em PHP.

## 📞 Contato

- LinkedIn: [Edson Alves](https://www.linkedin.com/in/edsonakaves)
- GitHub: [@EdsonAkaves](https://github.com/seu-usuario)
- Email: edson.akaves@gmail.com

Para dúvidas ou sugestões sobre o projeto, abra uma issue no repositório.

---

**Nota**: Este é um projeto de estudo. Para uso em produção, considere implementar melhorias de segurança, logging, e tratamento de erros mais robusto.
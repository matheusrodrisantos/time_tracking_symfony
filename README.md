
# Time_Tracking_Symfony

## Descrição do Projeto
O **Time_Tracking_Symfony** é um sistema de registro de ponto desenvolvido com o framework PHP Symfony. Este projeto foi criado para gerenciar e monitorar de forma eficiente as horas trabalhadas por colaboradores de uma empresa, oferecendo funcionalidades de registro de ponto, relatórios, e integrações futuras via API REST. Inicialmente, o sistema será implementado como uma aplicação monolítica, mas já contará com endpoints RESTful para futuras expansões e integrações com outras plataformas.

## Tecnologias Utilizadas
- **PHP** (>= 8.1)
- **Symfony** (>= 6.x)
- **MySQL** ou outro banco de dados compatível
- **Doctrine ORM**
- **Twig** para renderização de templates
- **Composer** para gerenciamento de dependências
- **Postman** (opcional, para teste da API)
- **Docker** (opcional, para ambiente de desenvolvimento)

## Funcionalidades Principais
- **Registro de ponto**: Check-in e check-out dos colaboradores.
- **Gestão de usuários**: Cadastro, edição e exclusão de usuários.
- **Relatórios**: Visualização de horas trabalhadas em intervalos definidos.
- **API REST**: Endpoints para permitir a integração com outras aplicações.
- **Autenticação e Autorização**: Sistema seguro com login de usuários e níveis de acesso.

## Estrutura do Projeto
```
/time_tracking_symfony
│
├── config/                # Configurações do Symfony
├── src/                   # Código-fonte da aplicação
│   ├── Controller/        # Controladores do sistema e da API
│   ├── Entity/            # Entidades para o ORM Doctrine
│   ├── Repository/        # Repositórios de acesso aos dados
│   └── Service/           # Serviços de lógica de negócio
├── templates/             # Templates Twig para renderização
├── public/                # Diretório público para assets e index.php
├── migrations/            # Arquivos de migração de banco de dados
└── tests/                 # Testes unitários e de integração
```

## Endpoints da API
A aplicação possui uma API REST para integração com sistemas externos. Abaixo estão alguns dos endpoints básicos:

- **POST /api/check-in**: Realiza o registro de entrada de um colaborador.
- **POST /api/check-out**: Realiza o registro de saída de um colaborador.
- **GET /api/reports**: Retorna relatórios de horas trabalhadas.
- **GET /api/users/{id}**: Retorna detalhes de um usuário específico.

### Autenticação da API
A API utiliza tokens JWT para autenticação. Antes de acessar os endpoints, o usuário deve se autenticar e receber um token válido.

## Como Configurar o Projeto
### Pré-requisitos
- PHP 8.1 ou superior
- Composer
- Servidor web (Apache/Nginx)
- MySQL ou outro banco de dados compatível

### Instalação
1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/time_tracking_symfony.git
   cd time_tracking_symfony
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Configure o arquivo `.env` com as credenciais do banco de dados:
   ```dotenv
   DATABASE_URL="mysql://user:password@127.0.0.1:3306/time_tracking_db"
   ```

4. Execute as migrações para criar as tabelas no banco de dados:
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

5. Inicie o servidor de desenvolvimento:
   ```bash
   symfony serve
   ```

### Testes
Para executar os testes unitários e de integração, utilize:
```bash
php bin/phpunit
```

## Próximos Passos e Melhorias
- **Integração com outros sistemas** via API REST.
- **Implementação de relatórios gráficos** para melhor visualização de dados.
- **Deploy em ambientes de produção** com configurações de segurança otimizadas.
- **Desenvolvimento de um cliente frontend** (ex: Vue.js ou React) para maior interatividade.

## Contribuição
Contribuições são bem-vindas! Para contribuir, siga as diretrizes de contribuição e abra um pull request com suas mudanças.

## Licença
Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

**Time_Tracking_Symfony** é projetado para fornecer uma solução robusta e extensível para o gerenciamento de horas trabalhadas, pronto para evoluir conforme as necessidades de empresas em crescimento.

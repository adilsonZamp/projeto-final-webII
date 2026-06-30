Sistema com características de um ERP para padarias.

A ideia desse sistema é o Dono poder

  [ ] Gerenciar várias lojas (CRUD);
  
  [ ] Manter vários empregados (gerentes e funcionários);
  
  [ ] Registrar dados de vendas de cada unidade;
  
  [ ] Registrar folha salarial e contas a pagar;
  
  [ ] ...

O sistema compila esses dados e mostra com relatórios e dashboards, com o passar do tempo da para implementar mais módulos, como em ERPs consolidados no mercado.

Para fins da avaliação o projeto tem os seguintes requisitos técnicos:
1. Ser desenvolvido com o framework Laravel na versão 13;
2. Aplicar o conceito de Rotas
3. Usar Controllers, Views (Blade ou Svelte);
4. Criar Models com ORM (Relacionamentos), Migrations e Seeders;
5. Ter autenticação e cadastro de usuários com Breeze;
6. Acesso aos dados/funcionalidades através de Autorização e Policies;
7. Implementar padrão CSR (Controller - Service - Repository);
8. Suportar auditoria, com Laravel Auditing.

Após clonar execute os seguintes passos para rodar a aplicação
- composer install na pasta do projeto Laravel (projeto-final-webII/panis-erp)
- php artisan generate:key
- php artisans migrate:fresh --seed
- em outro terminal rode: npm run dev OU npm run build (passo opcional caso queira usar o HMR do Vite)
- php artisan serve -- port 8000

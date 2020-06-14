import express, { request } from 'express';

const app = express();

app.use(express.json());


// Rota:    Endereço completo da requisição
// Recurso: Qual entidade estamos acessando do sistema

// GET:     Buscar uma ou mais informações do back-end
// POST:    Criar uma nova informação no back-end
// PUT:     Atualizar uma informação já existente no back-end
// DELETE:  Remover uma informação no back-end

// Request Param: Parâmetros que vem na propria rota que identificam um recurso
// Query Param:   Parâmtros que vem na roda, geralmente opcionais, para filtros, paginação, etc.
// Request Body:  Parâmetros para criação e atualização de informações


const users = [
  'Diego',
  'Diogo',
  'Luiz',
  'Cleiton',
  'Elton'
];


app.get('/users', (request, response) => {
  
  const search = String(request.query.search);

  const filteredUsers = search ? users.filter(user => user.includes(search)) : users;

  return response.json(filteredUsers);
});

app.get('/users/:id', (request, response) => {

  const id = Number(request.params.id);

  const user = users[id];

  return response.json(user);
});

app.post('/users', (request, response) => {

  const data = request.body;

  const user = {
    name: data.name,
    mail: data.mail
};

  return response.json(user);
});


app.listen(3333);

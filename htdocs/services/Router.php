<?php
    class Router {
        private array $routes;

        public function __construct() {
            $this->routes = [
                'GET' => [
                    '/usuarios' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuarios'
                    ],

                    '/buscar-status' => [
                        'controller' => 'StatusController',
                        'function' => 'getStatus'
                    ],

                    '/buscar-produtos' => [
                        'controller' => 'ProdutosController',
                        'function' => 'getProdutos'
                    ],

                    '/buscar-todos-pedidos' => [
                        'controller' => 'PedidosController',
                        'function' => 'getPedidos'
                    ]
                ],

                'POST' => [
                    '/usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'getUsuario'
                    ],

                    '/criar-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'createUsuario'
                    ],

                    '/buscar-id-status' => [
                        'controller' => 'StatusController',
                        'function' => 'buscarStatusPorId'
                    ],

                    '/buscar-id-produtos' => [
                        'controller' => 'ProdutosController',
                        'function' => 'buscarProdutosPorId'
                    ],
                    '/cadastrar-produto' => [
                        'controller' => 'ProdutosController',
                        'function' => 'cadastrarProduto'
                    ],

                    '/buscar-itens-pedido' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'buscarItensPedidos'
                    ],
                    '/cadastrar-item-pedido' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'cadastrarItemPedido'
                    ],
                    '/buscar-pedido-por-id' => [
                        'controller' => 'PedidosController',
                        'function' => 'BuscarPedidoPorId'
                    ],
                    '/buscar-todos-os-pedidos-de-uma-pessoa' => [
                        'controller' => 'PedidosController',
                        'function' => 'BuscarTodosPedidosDeUmaPessoa'
                    ],
                    '/cadastrar-pedido' => [
                        'controller' => 'PedidosController',
                        'function' => 'CadastrarPedidos'
                    ],

                    '/valor-total-pedido' => [
                    'controller' => 'PedidosController',
                    'function' => 'getValorTotalFromPedidoById'
                ]
            ],    

                'PUT' => [
                    '/atualizar-usuario' => [
                    'controller' => 'UsuarioController',
                    'function' => 'updateUsuario'
                    ],

                    '/atualizar-produto' => [
                        'controller' => 'ProdutosController',
                        'function' => 'updateProduto'
                    ],

                    '/atualizar-item-pedido' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'UpdateItemPedido'
                        
                    ],

                    '/atualizar-pedido' => [
                        'controller' => 'PedidosController',
                        'function' => 'atualizarPedido'

                    ],


                    '/editar-status-pedido' => [
                        'controller' => 'PedidosController',
                        'function' => 'updateStatusPedido'
                    ],
                    


                ],

                'DELETE' => [
                    '/excluir-usuario' => [
                        'controller' => 'UsuarioController',
                        'function' => 'deleteUsuario'
                    ],

                    '/excluir-produto' => [
                        'controller' => 'ProdutosController',
                        'function' => 'deleteProduto'
                    ],
                    '/excluir-item-pedido' => [
                        'controller' => 'ItemPedidosController',
                        'function' => 'DeleteItemPedido'
                    ],

                    '/excluir-pedido' => [
                        'controller' => 'PedidosController',
                        'function' => 'deletePedido'
                    ],

                ],
                
            ];

                
        }

        public function handleRequest(string $method, string $route): string {
            $routeExists = !empty($this->routes[$method][$route]);

            if (!$routeExists) {
                return json_encode([
                    'error' => 'Essa rota não existe!',
                    'result' => null
                ]);
            }

            $routeInfo = $this->routes[$method][$route];

            $controller = $routeInfo['controller'];
            $function = $routeInfo['function'];

            require_once __DIR__ . '/../controllers/' . $controller . '.php';

            return (new $controller)->$function();
        }
    }
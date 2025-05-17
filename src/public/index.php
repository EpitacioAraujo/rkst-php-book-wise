<?php

// echo __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php';

// Configuração básica de rotas
$routes = [
    '/' => 'pages/main/main',
    '/about' => 'pages/about/about',
    '/contact' => 'pages/contact/contact',
    '/services' => 'pages/services/services',
    '/portfolio' => 'pages/portfolio/portfolio',
];

// Função para obter o caminho atual
function getCurrentPath()
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = rtrim($path, '/'); // Remove a barra final
    return $path === '' ? '/' : $path;
}

// Captura o caminho solicitado
$currentPath = getCurrentPath();

// Verifica se a rota existe
if (!isset($routes[$currentPath])) {
    http_response_code(404);
    echo 'Página não encontrada';
    exit;
}

// Renderiza a página correspondente
$content = render($routes[$currentPath]);

echo render('partials/layout/layout', [
    'content' => $content,
]);

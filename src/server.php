<?php

use Epitas\App\Utils\Router;

// Função para verificar se o caminho é um arquivo estático
function isStaticFile($path)
{
    $fileExtensions = ['png', 'jpg', 'jpeg', 'gif', 'css', 'js', 'pdf', 'ico', 'svg'];
    $parts = explode('.', $path);
    $extension = end($parts);
    return in_array(strtolower($extension), $fileExtensions);
}

// Função para obter o tipo de conteúdo com base na extensão do arquivo
function getContentType($filePath)
{
    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
    $contentTypes = [
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'pdf' => 'application/pdf',
        'ico' => 'image/x-icon',
        'svg' => 'image/svg+xml',
    ];

    return isset($contentTypes[strtolower($extension)])
        ? $contentTypes[strtolower($extension)]
        : 'application/octet-stream';
}

// Função para obter o caminho atual
function getCurrentPath()
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = rtrim($path, '/'); // Remove a barra final
    return $path === '' ? '/' : $path;
}

// Carregar as rotas
require_once __DIR__ . '/routes/web.php';

// Captura o caminho solicitado
$currentPath = getCurrentPath();

// Verifica se é um arquivo estático
if (isStaticFile($currentPath)) {
    $filePath = __DIR__ . $currentPath;

    if (file_exists($filePath)) {
        // Definir o tipo de conteúdo correto
        header('Content-Type: ' . getContentType($filePath));
        // Lê e exibe o arquivo
        readfile($filePath);
        exit;
    } else {
        // Arquivo não existe
        http_response_code(404);
        echo 'Arquivo não encontrado';
        exit;
    }
}

// Resolve a rota atual
$content = Router::resolve($_SERVER['REQUEST_METHOD'], $currentPath);

if ($content === false) {
    // Rota não encontrada
    http_response_code(404);
    $content = render('pages/404/404');

    echo render('partials/layout/layout', [
        'content' => $content,
    ]);
    exit;
}

// Renderiza o conteúdo dentro do layout
echo render('partials/layout/layout', [
    'content' => $content,
]);

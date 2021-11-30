<?
function AutoLoaderModels($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Model\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/model/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderTypes($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Types\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/types/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderControllers($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Controller\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/controller/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderResources($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Resource\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/resource/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderClasses($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Classes\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/classes/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderServices($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Services\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/services/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderRoutes($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Routes\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/routes/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderNFE($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\NFe\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/nfe/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}
function AutoLoaderRemessa($class)
{
    // Prefixo no namespace do projeto especifico
    $prefix = 'App\\Brasiltec\\Remessa\\';

    // Diretorio aonde ficam as bibliotecas
    $base_dir = __DIR__ . '/classes/remessa/';

    // Verifica se a classe chamada usa o prefixo
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Se não usar o prefixo Foo\bar então retorna false
        return;
    }

    // Pega o caminho relativo da classe, ou seja remove o Foo\bar\
    $relative_class = substr($class, $len);

    // Troca os separadores de namespace por separadores de diretorio
    // e adiciona o .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele
    if (is_file($file)) {
        include_once $file;
    }
}

spl_autoload_register('AutoLoaderModels');
spl_autoload_register('AutoLoaderTypes');
spl_autoload_register('AutoLoaderControllers');
spl_autoload_register('AutoLoaderResources');
spl_autoload_register('AutoLoaderClasses');
spl_autoload_register('AutoLoaderServices');
spl_autoload_register('AutoLoaderRoutes');
spl_autoload_register('AutoLoaderNFE');
spl_autoload_register('AutoLoaderRemessa');
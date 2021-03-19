<?php

namespace Classes\Utils;

abstract class GenericConstantsUtil
{
    /* REQUESTS */
    public const REQUEST_TYPE = ['GET', 'POST', 'PUT', 'DELETE'];
    public const AVAILABLE_ENDPOINTS_TYPE = [
        'GET' => ['usuarios'],
        'POST' => ['usuarios'],
        'PUT' => ['usuarios'],
        'DELETE' => ['usuarios']
    ];

    /* public const TIPO_GET = ['USUARIOS'];
    public const TIPO_POST = ['USUARIOS'];
    public const TIPO_DELETE = ['USUARIOS'];
    public const TIPO_PUT = ['USUARIOS']; */

    /* ERROS */
    public const INVALID_ROUTE_TYPE  = 'Rota não permitida!';
    public const INVALID_RESOURCE    = 'Recurso inexistente!';
    public const METHOD_NOT_ALLOWED  = 'Método não permitido!';
    public const GENERIC_ERROR       = 'Algum erro ocorreu na requisição!';
    public const NO_DATA_RETURNED    = 'Nenhum registro encontrado!';
    public const NO_DATA_AFFECTED    = 'Nenhum registro afetado!';
    public const EMPTY_TOKEN         = 'É necessário informar um Token!';
    public const UNAUTHORIZED_TOKEN  = 'Token não autorizado!';
    public const EMPTY_BODY          = 'O Corpo da requisição não pode ser vazio!';

    /* SUCESSO */
    public const DELETED_SUCCESSFULLY   = 'Registro deletado com Sucesso!';
    public const UPDATED_SUCCESSFULLY   = 'Registro atualizado com Sucesso!';

    /* RECURSO USUARIOS */
    public const ID_REQUIRED  = 'ID é obrigatório!';
    public const LOGIN_EXISTS = 'Login já existente!';
    public const REQUIRED_LOGIN_AND_PASSWORD = 'Login e Senha são obrigatórios!';

    /* RETORNO JSON */
    const SUCCESS_TYPE = 'sucesso';
    const ERROR_TYPE   = 'erro';

    /* OUTRAS */
    public const ACTIVE   = 'A';
    public const TYPE     = 'tipo';
    public const RESPONSE = 'resposta';
}
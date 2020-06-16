<?php
namespace Hb180\Voice\Error;

use Neos\Flow\Annotations as Flow;

use Neos\Flow\Error\WithHttpStatusInterface;
use Neos\Flow\Http\Helper\ResponseInformationHelper;

/**
 * A basic but solid exception handler which catches everything which
 * falls through the other exception handlers and provides useful debugging
 * information.
 *
 * @Flow\Scope("singleton")
 */
class DebugExceptionHandler extends \Neos\Flow\Error\DebugExceptionHandler
{

    /**
     * @var array
     */
    protected $formatMapper = [
        'json' => 'application/json'
    ];

    /**
     * Formats and echoes the exception as XHTML.
     *
     * @param \Throwable $exception
     * @return void
     */
    protected function echoExceptionWeb($exception)
    {
        $statusCode = ($exception instanceof WithHttpStatusInterface) ? $exception->getStatusCode() : 500;
        $statusMessage = ResponseInformationHelper::getStatusMessageByCode($statusCode);

        if (!headers_sent()) {
            header(sprintf('HTTP/1.1 %s %s', $statusCode, $statusMessage));
        }

        $format = $statusCode = ($exception instanceof Exception) ? $exception->getFormat() : 'json';

        $contentType = $_SERVER['CONTENT_TYPE']??$this->formatMapper[$format]??null;

        if( $contentType ) {
            header("Content-Type: $contentType");
        }

        if( strpos($contentType, 'application/json') !== false ){
            $content = json_encode([
                'errorCode' => $exception->getCode(),
                'errorMessage' => $exception->getMessage()
            ]);
            $this->throwableStorage->logThrowable($exception);
            echo $content;
        }else{
            parent::echoExceptionWeb($exception);
        }
    }

}

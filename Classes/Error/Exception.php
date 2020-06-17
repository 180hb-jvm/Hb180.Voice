<?php
namespace Hb180\Voice\Error;

use Neos\Flow\Error\WithHttpStatusInterface;
use Neos\Flow\Error\WithReferenceCodeInterface;

/**
 * A generic Flow Exception
 *
 * @api
 */
class Exception extends \Exception implements WithReferenceCodeInterface, WithHttpStatusInterface
{
    /**
     * @var string
     */
    protected $referenceCode;

    /**
     * @var integer
     */
    protected $statusCode = 500;

    /**
     * @var string
     */
    protected $format = null;

    /**
     * Returns a code which can be communicated publicly so that whoever experiences the exception can refer
     * to it and a developer can find more information about it in the system log.
     *
     * @return string
     * @api
     */
    public function getReferenceCode()
    {
        if (!isset($this->referenceCode)) {
            $this->referenceCode = date('YmdHis', $_SERVER['REQUEST_TIME']) . substr(md5(rand()), 0, 6);
        }
        return $this->referenceCode;
    }

    /**
     * Returns the HTTP status code this exception corresponds to (defaults to 500).
     *
     * @return integer
     * @api
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     * @api
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setStatusCode(int $code){
        $this->statusCode = $code;
        return $this;
    }

    /**
     * @param string $format
     * @return $this
     */
    public function setFormat($format){
        $this->format = $format;
        return $this;
    }
}

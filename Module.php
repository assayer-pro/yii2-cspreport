<?php
/**
 * Yii2 Module for Content Security Policy Report
 *
 * @copyright 2015 Assayer Pro Company http://assayer.pro
 * @author Serge Larin <serge.larin@gmail.com>
 * @license GNU Public License http://opensource.org/licenses/gpl-license.php
 */

namespace assayerpro\cspreport;

use Yii;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\mail\MailerInterface;

/**
 * Module Class
 *
 * @package assayerpro\cspreport
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'assayerpro\cspreport\controllers';
    /**
     * @var array the configuration array for creating a [[\yii\mail\MessageInterface|message]] object.
     * Note that the "to" option must be set, which specifies the destination email address(es).
     */
    public $message = [];
    /**
     * @var MailerInterface|array|string the mailer object or the application component ID of the mailer object.
     * After the EmailTarget object is created, if you want to change this property, you should only assign it
     * with a mailer object.
     */
    public $mailer = 'mailer';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        if (empty($this->message['to'])) {
            throw new InvalidConfigException('The "to" option must be set for message.');
        }
        $this->mailer = Instance::ensure($this->mailer, 'yii\mail\MailerInterface');
    }

    /**
     * Composes a mail message with the given body content.
     * @param string $body the body content
     * @return \yii\mail\MessageInterface $message
     */
    public function composeMessage($body)
    {
        $message = $this->mailer->compose();
        Yii::configure($message, $this->message);
        $message->setTextBody($body);

        return $message;
    }
}

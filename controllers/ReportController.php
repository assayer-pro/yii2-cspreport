<?php
/**
 * ReportController
 *
 * @copyright 2015 Assayer Pro Company http://assayer.pro
 * @author Serge Larin <serge.larin@gmail.com>
 * @license GNU Public License http://opensource.org/licenses/gpl-license.php
 */
namespace assayerpro\cspreport\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\helpers\VarDumper;

/**
 * ReportController
 *
 * @package assayerpro\cspreport\controllers
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * actionIndex
     *
     * @access public
     * @return void
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (empty(Yii::$app->request->bodyParams['csp-report'])) {
            return ['status' => 'error'];
        }
        $this->module->composeMessage("csp-report = \n".
             VarDumper::dumpAsString(Yii::$app->request->bodyParams['csp-report'])."\n\$_SERVER = \n".
             VarDumper::dumpAsString($_SERVER))->send($this->module->mailer);
        return ['status' => 'ok'];
    }
}

<?php
use Behat\WebApiExtension\Context\WebApiContext;
use Illuminate\Database\Capsule\Manager as DB;
use League\FactoryMuffin\Facade as FactoryMuffin;

class ApiFeatureContext extends WebApiContext
{

    private $_restObject        = null;
    private $_restObjectType    = null;
    private $_restObjectMethod  = 'get';
    private $_client            = null;
    private $_response          = null;
    private $_requestUrl        = null;

    private $_parameters			= array();

    public function __construct(array $parameters)
    {
        // Initialize your context here

        $this->_restObject  = new stdClass();
        $this->_client      = new Guzzle\Service\Client();
        $this->_parameters = $parameters;
    }

    public function getParameter($name)
    {
        if (count($this->_parameters) === 0) {


            throw new \Exception('Parameters not loaded!');
        } else {

            $parameters = $this->_parameters;
            return (isset($parameters[$name])) ? $parameters[$name] : null;
        }
    }


    /**
     * @BeforeSuite
     */
    public static function bootstrapSuite()
    {
        echo "- - - - - - Boot App, Database, and Muffin Factory. Yum! - - - - - - ";
        $unitTesting     = true;
        $testEnvironment = 'testing';
        $app = require_once __DIR__ . '/../../bootstrap/start.php';
        $app->boot();
        $path = Config::get('database.connections.sqlite.database');
        if (file_exists($path)) {
            unlink($path);
        }
        touch($path);
        Artisan::call('migrate:install');
        FactoryMuffin::loadFactories(__DIR__ . '/../../tests/factories');
    }
    /**
     * @AfterSuite
     */
    public static function tearDown() {
        echo "- - - - - - Tear it Down! - - - - - - ";
        $path = Config::get('database.connections.sqlite.database');
        unlink($path);
    }
    /**
     * @BeforeScenario
     */
    public static function refreshDatabase() {
        //Artisan::call('migrate:refresh');
    }
    /**
     * @Given /^the response json should have a "([^"]*)" key$/
     */
    public function theResponseJsonShouldHaveAKey($key_name)
    {
        PHPUnit_Framework_Assert::assertArrayHasKey($key_name, $this->response->json());
    }
    /**
     * @Given /^the response json's "([^"]*)" key should be of type "([^"]*)"$/
     */
    public function theResponseJsonSKeyShouldBeOfType($key_name, $desired_type)
    {
        PHPUnit_Framework_Assert::assertAttributeInternalType($desired_type, $key_name, (object) $this->response->json());
    }
    /**
     * @Given /^there are (\d+) "([^"]*)"s$/
     */
    public function thereAreSomeNumberOfModel($num, $model_name)
    {
        FactoryMuffin::seed($num, $model_name);
    }
    /**
     * @Given /^the "([^"]*)" with id (\d+) has attributes:$/
     */
    public function theWithIdHasAttributes($model_name, $model_id, \Behat\Gherkin\Node\PyStringNode $jsonString)
    {
        $attributes = json_decode($this->replacePlaceHolder($jsonString->getRaw()), true);
        $model_name::findOrFail($model_id)->update($attributes);
    }



    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {

        $this->requestUrl = "http://localhost:8000/books/15/delete";
        if(strtoupper($this->_restObjectMethod)){
            $response = $this->_client
                ->get($this->_requestUrl.'?'.http_build_query((array)$this->_restObject))
                ->send();
            echo $response;
        }
        echo $arg1;

    }

}
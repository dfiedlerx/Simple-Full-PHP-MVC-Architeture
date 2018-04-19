<?php namespace Core\Tools\Database;

use PDO;
use PDOStatement;

/**
 * Class DatabaseCase
 * @package Core\Tools\Database
 */
class DatabaseCase
{

    protected $databaseConnection;
    private $inTransation;

    public function __construct(PDO $databaseConnection) {

        $this->databaseConnection = $databaseConnection;
        $this->inTransation = false;

    }

    public function beginTransation () {

        if (!$this->inTransation) {

            $this->databaseConnection->beginTransaction();

        }

        $this->inTransation = true;

    }

    public function commit() {

        if ($this->inTransation) {

            $this->databaseConnection->commit();

        }

        $this->inTransation = false;

    }

    public function rollBack() {

        if ($this->inTransation) {

            $this->databaseConnection->rollBack();

        }

        $this->inTransation = false;

    }

    protected function prepare (string $prepareString, array $prepareOptions = []) : PDOStatement {

        return $this->databaseConnection->prepare($prepareString, $prepareOptions);

    }

}
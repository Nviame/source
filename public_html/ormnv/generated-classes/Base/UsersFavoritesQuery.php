<?php

namespace Base;

use \UsersFavorites as ChildUsersFavorites;
use \UsersFavoritesQuery as ChildUsersFavoritesQuery;
use \Exception;
use \PDO;
use Map\UsersFavoritesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users_favorites' table.
 *
 *
 *
 * @method     ChildUsersFavoritesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersFavoritesQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildUsersFavoritesQuery orderByIdFavorite($order = Criteria::ASC) Order by the id_favorite column
 * @method     ChildUsersFavoritesQuery orderByFavorite($order = Criteria::ASC) Order by the favorite column
 *
 * @method     ChildUsersFavoritesQuery groupById() Group by the id column
 * @method     ChildUsersFavoritesQuery groupByIdUser() Group by the id_user column
 * @method     ChildUsersFavoritesQuery groupByIdFavorite() Group by the id_favorite column
 * @method     ChildUsersFavoritesQuery groupByFavorite() Group by the favorite column
 *
 * @method     ChildUsersFavoritesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersFavoritesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersFavoritesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersFavorites findOne(ConnectionInterface $con = null) Return the first ChildUsersFavorites matching the query
 * @method     ChildUsersFavorites findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsersFavorites matching the query, or a new ChildUsersFavorites object populated from the query conditions when no match is found
 *
 * @method     ChildUsersFavorites findOneById(int $id) Return the first ChildUsersFavorites filtered by the id column
 * @method     ChildUsersFavorites findOneByIdUser(int $id_user) Return the first ChildUsersFavorites filtered by the id_user column
 * @method     ChildUsersFavorites findOneByIdFavorite(int $id_favorite) Return the first ChildUsersFavorites filtered by the id_favorite column
 * @method     ChildUsersFavorites findOneByFavorite(boolean $favorite) Return the first ChildUsersFavorites filtered by the favorite column *

 * @method     ChildUsersFavorites requirePk($key, ConnectionInterface $con = null) Return the ChildUsersFavorites by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersFavorites requireOne(ConnectionInterface $con = null) Return the first ChildUsersFavorites matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersFavorites requireOneById(int $id) Return the first ChildUsersFavorites filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersFavorites requireOneByIdUser(int $id_user) Return the first ChildUsersFavorites filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersFavorites requireOneByIdFavorite(int $id_favorite) Return the first ChildUsersFavorites filtered by the id_favorite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsersFavorites requireOneByFavorite(boolean $favorite) Return the first ChildUsersFavorites filtered by the favorite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsersFavorites[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsersFavorites objects based on current ModelCriteria
 * @method     ChildUsersFavorites[]|ObjectCollection findById(int $id) Return ChildUsersFavorites objects filtered by the id column
 * @method     ChildUsersFavorites[]|ObjectCollection findByIdUser(int $id_user) Return ChildUsersFavorites objects filtered by the id_user column
 * @method     ChildUsersFavorites[]|ObjectCollection findByIdFavorite(int $id_favorite) Return ChildUsersFavorites objects filtered by the id_favorite column
 * @method     ChildUsersFavorites[]|ObjectCollection findByFavorite(boolean $favorite) Return ChildUsersFavorites objects filtered by the favorite column
 * @method     ChildUsersFavorites[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersFavoritesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersFavoritesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\UsersFavorites', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersFavoritesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersFavoritesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersFavoritesQuery) {
            return $criteria;
        }
        $query = new ChildUsersFavoritesQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsersFavorites|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsersFavoritesTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersFavoritesTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsersFavorites A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `id_user`, `id_favorite`, `favorite` FROM `users_favorites` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsersFavorites $obj */
            $obj = new ChildUsersFavorites();
            $obj->hydrate($row);
            UsersFavoritesTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildUsersFavorites|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_favorite column
     *
     * Example usage:
     * <code>
     * $query->filterByIdFavorite(1234); // WHERE id_favorite = 1234
     * $query->filterByIdFavorite(array(12, 34)); // WHERE id_favorite IN (12, 34)
     * $query->filterByIdFavorite(array('min' => 12)); // WHERE id_favorite > 12
     * </code>
     *
     * @param     mixed $idFavorite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterByIdFavorite($idFavorite = null, $comparison = null)
    {
        if (is_array($idFavorite)) {
            $useMinMax = false;
            if (isset($idFavorite['min'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_FAVORITE, $idFavorite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idFavorite['max'])) {
                $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_FAVORITE, $idFavorite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_ID_FAVORITE, $idFavorite, $comparison);
    }

    /**
     * Filter the query on the favorite column
     *
     * Example usage:
     * <code>
     * $query->filterByFavorite(true); // WHERE favorite = true
     * $query->filterByFavorite('yes'); // WHERE favorite = true
     * </code>
     *
     * @param     boolean|string $favorite The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function filterByFavorite($favorite = null, $comparison = null)
    {
        if (is_string($favorite)) {
            $favorite = in_array(strtolower($favorite), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsersFavoritesTableMap::COL_FAVORITE, $favorite, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsersFavorites $usersFavorites Object to remove from the list of results
     *
     * @return $this|ChildUsersFavoritesQuery The current query, for fluid interface
     */
    public function prune($usersFavorites = null)
    {
        if ($usersFavorites) {
            $this->addUsingAlias(UsersFavoritesTableMap::COL_ID, $usersFavorites->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users_favorites table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersFavoritesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersFavoritesTableMap::clearInstancePool();
            UsersFavoritesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersFavoritesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersFavoritesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersFavoritesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersFavoritesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersFavoritesQuery

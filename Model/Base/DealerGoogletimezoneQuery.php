<?php

namespace DealerGoogleTimeZone\Model\Base;

use \Exception;
use \PDO;
use DealerGoogleTimeZone\Model\DealerGoogletimezone as ChildDealerGoogletimezone;
use DealerGoogleTimeZone\Model\DealerGoogletimezoneQuery as ChildDealerGoogletimezoneQuery;
use DealerGoogleTimeZone\Model\Map\DealerGoogletimezoneTableMap;
use Dealer\Model\Dealer;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'dealer_googletimezone' table.
 *
 *
 *
 * @method     ChildDealerGoogletimezoneQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDealerGoogletimezoneQuery orderByDealerId($order = Criteria::ASC) Order by the dealer_id column
 * @method     ChildDealerGoogletimezoneQuery orderByTimezone($order = Criteria::ASC) Order by the timezone column
 * @method     ChildDealerGoogletimezoneQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDealerGoogletimezoneQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildDealerGoogletimezoneQuery orderByVersion($order = Criteria::ASC) Order by the version column
 * @method     ChildDealerGoogletimezoneQuery orderByVersionCreatedAt($order = Criteria::ASC) Order by the version_created_at column
 * @method     ChildDealerGoogletimezoneQuery orderByVersionCreatedBy($order = Criteria::ASC) Order by the version_created_by column
 *
 * @method     ChildDealerGoogletimezoneQuery groupById() Group by the id column
 * @method     ChildDealerGoogletimezoneQuery groupByDealerId() Group by the dealer_id column
 * @method     ChildDealerGoogletimezoneQuery groupByTimezone() Group by the timezone column
 * @method     ChildDealerGoogletimezoneQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDealerGoogletimezoneQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildDealerGoogletimezoneQuery groupByVersion() Group by the version column
 * @method     ChildDealerGoogletimezoneQuery groupByVersionCreatedAt() Group by the version_created_at column
 * @method     ChildDealerGoogletimezoneQuery groupByVersionCreatedBy() Group by the version_created_by column
 *
 * @method     ChildDealerGoogletimezoneQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDealerGoogletimezoneQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDealerGoogletimezoneQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDealerGoogletimezoneQuery leftJoinDealer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dealer relation
 * @method     ChildDealerGoogletimezoneQuery rightJoinDealer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dealer relation
 * @method     ChildDealerGoogletimezoneQuery innerJoinDealer($relationAlias = null) Adds a INNER JOIN clause to the query using the Dealer relation
 *
 * @method     ChildDealerGoogletimezoneQuery leftJoinDealerGoogletimezoneVersion($relationAlias = null) Adds a LEFT JOIN clause to the query using the DealerGoogletimezoneVersion relation
 * @method     ChildDealerGoogletimezoneQuery rightJoinDealerGoogletimezoneVersion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DealerGoogletimezoneVersion relation
 * @method     ChildDealerGoogletimezoneQuery innerJoinDealerGoogletimezoneVersion($relationAlias = null) Adds a INNER JOIN clause to the query using the DealerGoogletimezoneVersion relation
 *
 * @method     ChildDealerGoogletimezone findOne(ConnectionInterface $con = null) Return the first ChildDealerGoogletimezone matching the query
 * @method     ChildDealerGoogletimezone findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDealerGoogletimezone matching the query, or a new ChildDealerGoogletimezone object populated from the query conditions when no match is found
 *
 * @method     ChildDealerGoogletimezone findOneById(int $id) Return the first ChildDealerGoogletimezone filtered by the id column
 * @method     ChildDealerGoogletimezone findOneByDealerId(int $dealer_id) Return the first ChildDealerGoogletimezone filtered by the dealer_id column
 * @method     ChildDealerGoogletimezone findOneByTimezone(string $timezone) Return the first ChildDealerGoogletimezone filtered by the timezone column
 * @method     ChildDealerGoogletimezone findOneByCreatedAt(string $created_at) Return the first ChildDealerGoogletimezone filtered by the created_at column
 * @method     ChildDealerGoogletimezone findOneByUpdatedAt(string $updated_at) Return the first ChildDealerGoogletimezone filtered by the updated_at column
 * @method     ChildDealerGoogletimezone findOneByVersion(int $version) Return the first ChildDealerGoogletimezone filtered by the version column
 * @method     ChildDealerGoogletimezone findOneByVersionCreatedAt(string $version_created_at) Return the first ChildDealerGoogletimezone filtered by the version_created_at column
 * @method     ChildDealerGoogletimezone findOneByVersionCreatedBy(string $version_created_by) Return the first ChildDealerGoogletimezone filtered by the version_created_by column
 *
 * @method     array findById(int $id) Return ChildDealerGoogletimezone objects filtered by the id column
 * @method     array findByDealerId(int $dealer_id) Return ChildDealerGoogletimezone objects filtered by the dealer_id column
 * @method     array findByTimezone(string $timezone) Return ChildDealerGoogletimezone objects filtered by the timezone column
 * @method     array findByCreatedAt(string $created_at) Return ChildDealerGoogletimezone objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildDealerGoogletimezone objects filtered by the updated_at column
 * @method     array findByVersion(int $version) Return ChildDealerGoogletimezone objects filtered by the version column
 * @method     array findByVersionCreatedAt(string $version_created_at) Return ChildDealerGoogletimezone objects filtered by the version_created_at column
 * @method     array findByVersionCreatedBy(string $version_created_by) Return ChildDealerGoogletimezone objects filtered by the version_created_by column
 *
 */
abstract class DealerGoogletimezoneQuery extends ModelCriteria
{

    // versionable behavior

    /**
     * Whether the versioning is enabled
     */
    static $isVersioningEnabled = true;

    /**
     * Initializes internal state of \DealerGoogleTimeZone\Model\Base\DealerGoogletimezoneQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\DealerGoogleTimeZone\\Model\\DealerGoogletimezone', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDealerGoogletimezoneQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDealerGoogletimezoneQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \DealerGoogleTimeZone\Model\DealerGoogletimezoneQuery) {
            return $criteria;
        }
        $query = new \DealerGoogleTimeZone\Model\DealerGoogletimezoneQuery();
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
     * @return ChildDealerGoogletimezone|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = DealerGoogletimezoneTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DealerGoogletimezoneTableMap::DATABASE_NAME);
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
     * @return   ChildDealerGoogletimezone A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT ID, DEALER_ID, TIMEZONE, CREATED_AT, UPDATED_AT, VERSION, VERSION_CREATED_AT, VERSION_CREATED_BY FROM dealer_googletimezone WHERE ID = :p0';
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
            $obj = new ChildDealerGoogletimezone();
            $obj->hydrate($row);
            DealerGoogletimezoneTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildDealerGoogletimezone|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
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
    public function findPks($keys, $con = null)
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
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $keys, Criteria::IN);
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
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $id, $comparison);
    }

    /**
     * Filter the query on the dealer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDealerId(1234); // WHERE dealer_id = 1234
     * $query->filterByDealerId(array(12, 34)); // WHERE dealer_id IN (12, 34)
     * $query->filterByDealerId(array('min' => 12)); // WHERE dealer_id > 12
     * </code>
     *
     * @see       filterByDealer()
     *
     * @param     mixed $dealerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByDealerId($dealerId = null, $comparison = null)
    {
        if (is_array($dealerId)) {
            $useMinMax = false;
            if (isset($dealerId['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::DEALER_ID, $dealerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dealerId['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::DEALER_ID, $dealerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::DEALER_ID, $dealerId, $comparison);
    }

    /**
     * Filter the query on the timezone column
     *
     * Example usage:
     * <code>
     * $query->filterByTimezone('fooValue');   // WHERE timezone = 'fooValue'
     * $query->filterByTimezone('%fooValue%'); // WHERE timezone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $timezone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByTimezone($timezone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($timezone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $timezone)) {
                $timezone = str_replace('*', '%', $timezone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::TIMEZONE, $timezone, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query on the version column
     *
     * Example usage:
     * <code>
     * $query->filterByVersion(1234); // WHERE version = 1234
     * $query->filterByVersion(array(12, 34)); // WHERE version IN (12, 34)
     * $query->filterByVersion(array('min' => 12)); // WHERE version > 12
     * </code>
     *
     * @param     mixed $version The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByVersion($version = null, $comparison = null)
    {
        if (is_array($version)) {
            $useMinMax = false;
            if (isset($version['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION, $version['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($version['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION, $version['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION, $version, $comparison);
    }

    /**
     * Filter the query on the version_created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedAt('2011-03-14'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt('now'); // WHERE version_created_at = '2011-03-14'
     * $query->filterByVersionCreatedAt(array('max' => 'yesterday')); // WHERE version_created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $versionCreatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedAt($versionCreatedAt = null, $comparison = null)
    {
        if (is_array($versionCreatedAt)) {
            $useMinMax = false;
            if (isset($versionCreatedAt['min'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION_CREATED_AT, $versionCreatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($versionCreatedAt['max'])) {
                $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION_CREATED_AT, $versionCreatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION_CREATED_AT, $versionCreatedAt, $comparison);
    }

    /**
     * Filter the query on the version_created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByVersionCreatedBy('fooValue');   // WHERE version_created_by = 'fooValue'
     * $query->filterByVersionCreatedBy('%fooValue%'); // WHERE version_created_by LIKE '%fooValue%'
     * </code>
     *
     * @param     string $versionCreatedBy The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByVersionCreatedBy($versionCreatedBy = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($versionCreatedBy)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $versionCreatedBy)) {
                $versionCreatedBy = str_replace('*', '%', $versionCreatedBy);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(DealerGoogletimezoneTableMap::VERSION_CREATED_BY, $versionCreatedBy, $comparison);
    }

    /**
     * Filter the query by a related \Dealer\Model\Dealer object
     *
     * @param \Dealer\Model\Dealer|ObjectCollection $dealer The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByDealer($dealer, $comparison = null)
    {
        if ($dealer instanceof \Dealer\Model\Dealer) {
            return $this
                ->addUsingAlias(DealerGoogletimezoneTableMap::DEALER_ID, $dealer->getId(), $comparison);
        } elseif ($dealer instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DealerGoogletimezoneTableMap::DEALER_ID, $dealer->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDealer() only accepts arguments of type \Dealer\Model\Dealer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dealer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function joinDealer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dealer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Dealer');
        }

        return $this;
    }

    /**
     * Use the Dealer relation Dealer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Dealer\Model\DealerQuery A secondary query class using the current class as primary query
     */
    public function useDealerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDealer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dealer', '\Dealer\Model\DealerQuery');
    }

    /**
     * Filter the query by a related \DealerGoogleTimeZone\Model\DealerGoogletimezoneVersion object
     *
     * @param \DealerGoogleTimeZone\Model\DealerGoogletimezoneVersion|ObjectCollection $dealerGoogletimezoneVersion  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function filterByDealerGoogletimezoneVersion($dealerGoogletimezoneVersion, $comparison = null)
    {
        if ($dealerGoogletimezoneVersion instanceof \DealerGoogleTimeZone\Model\DealerGoogletimezoneVersion) {
            return $this
                ->addUsingAlias(DealerGoogletimezoneTableMap::ID, $dealerGoogletimezoneVersion->getId(), $comparison);
        } elseif ($dealerGoogletimezoneVersion instanceof ObjectCollection) {
            return $this
                ->useDealerGoogletimezoneVersionQuery()
                ->filterByPrimaryKeys($dealerGoogletimezoneVersion->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDealerGoogletimezoneVersion() only accepts arguments of type \DealerGoogleTimeZone\Model\DealerGoogletimezoneVersion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DealerGoogletimezoneVersion relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function joinDealerGoogletimezoneVersion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DealerGoogletimezoneVersion');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'DealerGoogletimezoneVersion');
        }

        return $this;
    }

    /**
     * Use the DealerGoogletimezoneVersion relation DealerGoogletimezoneVersion object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \DealerGoogleTimeZone\Model\DealerGoogletimezoneVersionQuery A secondary query class using the current class as primary query
     */
    public function useDealerGoogletimezoneVersionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDealerGoogletimezoneVersion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DealerGoogletimezoneVersion', '\DealerGoogleTimeZone\Model\DealerGoogletimezoneVersionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDealerGoogletimezone $dealerGoogletimezone Object to remove from the list of results
     *
     * @return ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function prune($dealerGoogletimezone = null)
    {
        if ($dealerGoogletimezone) {
            $this->addUsingAlias(DealerGoogletimezoneTableMap::ID, $dealerGoogletimezone->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dealer_googletimezone table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DealerGoogletimezoneTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DealerGoogletimezoneTableMap::clearInstancePool();
            DealerGoogletimezoneTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildDealerGoogletimezone or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildDealerGoogletimezone object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DealerGoogletimezoneTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DealerGoogletimezoneTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        DealerGoogletimezoneTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DealerGoogletimezoneTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(DealerGoogletimezoneTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(DealerGoogletimezoneTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(DealerGoogletimezoneTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(DealerGoogletimezoneTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(DealerGoogletimezoneTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildDealerGoogletimezoneQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(DealerGoogletimezoneTableMap::CREATED_AT);
    }

    // versionable behavior

    /**
     * Checks whether versioning is enabled
     *
     * @return boolean
     */
    static public function isVersioningEnabled()
    {
        return self::$isVersioningEnabled;
    }

    /**
     * Enables versioning
     */
    static public function enableVersioning()
    {
        self::$isVersioningEnabled = true;
    }

    /**
     * Disables versioning
     */
    static public function disableVersioning()
    {
        self::$isVersioningEnabled = false;
    }

} // DealerGoogletimezoneQuery

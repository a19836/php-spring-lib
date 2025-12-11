# PHP Spring Lib

> Original Repos:   
> - PHP Spring Lib: https://github.com/a19836/phpspringlib/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP Spring Lib** is a library that brings core concepts of the Java Spring ecosystem into PHP, using XML-based bean configuration.   
It includes **ODI (Object Dependency Injection)**, **iBatis-style SQL mapping**, and **Hibernate-inspired ORM**, all configured through XML files.   
With this XML-style library, you can create your own XML bean definitions that map directly to PHP classes and other things.   

The goal of this library is to provide a PHP architecture similar to Java Spring, enriched with Beans-style ODI, iBatis-style query mappings and Hibernate-like ORM behavior, enabling PHP developers to create decoupled, modular, and scalable applications.   

To see a working example, open [index.php](index.php) on your server.

---

## Purpose

This library demonstrates how to recreate:

- **Spring ODI** (dependency injection via XML beans)
- **iBatis** (SQL mapping through XML)
- **Hibernate ORM** (object mapping and persistence logic through XML)

in a PHP environment, providing a structured and enterprise-style architecture.

---

## Tutorials

- [ODI – Object Dependency Injection](examples/odi/)
- [Extending Spring ODI](examples/odi/services.php)
- [Spring iBatis](examples/ibatis/)
- [Extending Spring iBatis](examples/ibatis/services.php)
- [Spring Hibernate](examples/hibernate/)
- [Extending Spring Hibernate](examples/hibernate/services.php)

---

## Usage

### ODI Usage Example

```php
//init bean factory
$BeanFactory = new BeanFactory();
$BeanFactory->init(array(
    "file" => __DIR__ . "/examples/odi/assets/beans.xml"
));
$BeanFactory->initObjects();

//call bean objects
$BeanObj = $BeanFactory->getObject("MyBeanId");

//call methods defined in the correspondent classes of the bean object
$BeanObj->foo();
```

More examples [here](examples/odi/index.php).

---

### iBatis Usage Example

```php
//init DB connection
$DBBroker = new MySQLDBBroker($host, $username, $password, $db_name);

//init iBatis engine
$SQLClient = new IBatisClient();
$SQLClient->setRDBBroker($DBBroker);
$SQLClient->loadXML(__DIR__ . "/examples/ibatis/assets/item.xml");

//call an iBatis query and execute it
$query = $SQLClient->getQuery("select", "select_item");
$result = $SQLClient->execQuery($query, array("item_id" => 1));

$ItemTest = $result[0];
$id = $ItemTest->getId();
$title = $ItemTest->getTitle();
```

More examples [here](examples/ibatis/index.php).

---

### Hibernate Usage Example

```php
//init DB connection
$DBBroker = new MySQLDBBroker($host, $username, $password, $db_name);

//init Hibernate engine
$SQLClient = new HibernateClient();
$SQLClient->setRDBBroker($DBBroker);
$SQLClient->loadXML(__DIR__ . "/examples/hibernate/assets/item_subitem.xml");

//call a Hibernate object
$ItemObj = $SQLClient->getHbnObj("ItemObj");
$result = $ItemObj->findById(1);
$results = $ItemObj->find();
```

More examples [here](examples/hibernate/index.php).

---

## Available Methods

### ODI Methods

```php
$BeanFactory = new BeanFactory();
$BeanFactory->setCacheRootPath( sys_get_temp_dir() . "/cache/spring/" ); //set cache to be faster

$data = array(
	"external_vars" => null, //optional associative array with key-value items
	"file" => "bean.xml", //file path with xml beans
	"settings" => null, //optional array with associative arrays inside, with the following keys: "import", "bean", "var" and "function".
);
$BeanFactory->init($data); //init factory based in $data
$BeanFactory->add($data); //add to factory based in $data
$BeanFactory->reset(); //clean saved data

$BeanFactory->getSettingsFromFile($file_path); //return settings after parsing xml file
$BeanFactory->getBeansFromSettings($settings, &$sort_elements = false); //return beans after parsing xml file

$BeanFactory->initObjects(); //init all parsed objects
$BeanFactory->initObject($bean_name, $launch_exception = true); //init a specific object
$BeanFactory->initFunction($function, $launch_exception = true); //init a specific function

$BeanFactory->addBeans($beans); //add new beans
$BeanFactory->getBeans(); //get parsed beans
$BeanFactory->getBean($bean_name); //get a specific beans

$BeanFactory->addObjects($objs); //add new objects
$BeanFactory->getObjects(); //get initialized objects
$BeanFactory->getObject($obj_name); //get a specific initialized object

$BeanFactory->setCacheRootPath($dir_path); //set cache folder path, so next time it does not need to parse the xml file
$BeanFactory->setCacheHandler(XmlSettingsCacheHandler $XmlSettingsCacheHandler); //set a different cache engine
```

### iBatis Methods

```php
$SQLClient = new IBatisClient();
$SQLClient->setRDBBroker($DBBroker);
$SQLClient->setCacheRootPath( sys_get_temp_dir() . "/cache/spring/ibatis/" ); //set cache to be faster

$SQLClient->loadXML($obj_path, $external_vars = false);
$query = $SQLClient->getQuery($query_type, $query_id);
$result = $SQLClient->execQuery($query, $parameters, $options = null);
$sql = $SQLClient->getQuerySQL($query, $parameters, $options = null);
$result = $SQLClient->getFunction($function_name, $parameters, $options = null);
$result = $SQLClient->getData($sql, $options = null);
$status = $SQLClient->setData($sql, $options = null);
$result = $SQLClient->getSQL($sql, $options = null);
$status = $SQLClient->setSQL($sql, $options = null);
$id = $SQLClient->getInsertedId($options = null);
$status = $SQLClient->insertObject($table_name, $attributes, $options = null);
$status = $SQLClient->updateObject($table_name, $attributes, $conditions, $options = null);
$status = $SQLClient->deleteObject($table_name, $conditions, $options = null);
$result = $SQLClient->findObjects($table_name, $attributes, $conditions, $options = null);
$total = $SQLClient->countObjects($table_name, $conditions, $options = null);
$result = $SQLClient->findRelationshipObjects($table_name, $rel_elm, $parent_conditions, $options = null);
$total = $SQLClient->countRelationshipObjects($table_name, $rel_elm, $parent_conditions, $options = null);
$max = $SQLClient->findObjectsColumnMax($table_name, $attribute_name, $options = null);
```

### Hibernate Methods

```php
$SQLClient = new HibernateClient();
$SQLClient->setRDBBroker($DBBroker);
$SQLClient->setCacheLayer($MyHibernateCache); //set cache to be faster

$SQLClient->loadXML($obj_path, $external_vars = false);
$obj = $SQLClient->getHbnObj($obj_name, $module_id, $service_id, $options = false);

//OBJET METHODS
$obj->insert($data, &$ids = false, $options = false);
$obj->insertAll($data, &$statuses = false, &$ids = false, $options = false);
$obj->update($data, $options = false);
$obj->updateAll($data, &$statuses = false, $options = false);
$obj->insertOrUpdate($data, &$ids = false, $options = false);
$obj->insertOrUpdateAll($data, &$statuses = false, &$ids = false, $options = false);
$obj->updateByConditions($data, $options = false);
$obj->updatePrimaryKeys($data, $options = false);
$obj->delete($data, $options = false);
$obj->deleteAll($data, &$statuses = false, $options = false);
$obj->deleteByConditions($data, $options = false);
$obj->findById($ids, $data = array(), $options = false);
$obj->find($data = array(), $options = false);
$obj->count($data = array(), $options = false);
$obj->findRelationships($parent_ids, $options = false);
$obj->findRelationship($rel_name, $parent_ids, $options = false);
$obj->countRelationships($parent_ids, $options = false);
$obj->countRelationship($rel_name, $parent_ids, $options = false); 

//SAME METHODS THAN ON IBATIS
$obj->callQuerySQL($query_type, $query_id, $parameters = false);
$obj->callQuery($query_type, $query_id, $parameters = false, $options = false);

$obj->callInsertSQL($query_id, $parameters = false);
$obj->callInsert($query_id, $parameters = false, $options = false);

$obj->callUpdateSQL($query_id, $parameters = false);
$obj->callUpdate($query_id, $parameters = false, $options = false);

$obj->callDeleteSQL($query_id, $parameters = false);
$obj->callDelete($query_id, $parameters = false, $options = false);

$obj->callSelectSQL($query_id, $parameters = false);
$obj->callSelect($query_id, $parameters = false, $options = false);

$obj->callProcedureSQL($query_id, $parameters = false);
$obj->callProcedure($query_id, $parameters = false, $options = false);

//SAME METHODS THAN ON DB BROKER
$obj->getData($sql, $options = false);
$obj->setData($sql, $options = false);
$obj->getSQL($sql, $options = false);
$obj->setSQL($sql, $options = false);
$obj->getInsertedId($options = false);
$obj->getFunction($function_name, $parameters = false, $options = false);

//SOME GETTERS METHODS
$obj->getCacheLayer();
$obj->getObjName();
$obj->getTableName();
$obj->getExtendClassName();
$obj->getExtendClassPath();
$obj->getIds();
$obj->getParameterClass();
$obj->getParameterMap();
$obj->getResultClass();
$obj->getResultMap();
$obj->getTableAttributes();
$obj->getManyToOne();
$obj->getManyToMany();
$obj->getOneToMany();
$obj->getOneToOne();
$obj->getQueries();
$obj->getPropertiesToAttributes();
$obj->getModuleId();
$obj->getServiceId();
```


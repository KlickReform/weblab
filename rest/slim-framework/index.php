<?php

    // Import the Slim library and register Slim's autoloader
    require 'Slim/Slim.php';
    Slim\Slim::registerAutoloader();

    // Instantiate a new Slim application
    $app = new Slim\Slim();
    
    /**
     * On GET /planets
     * Fetch a list of all planets or search a planet by name
     */
    $app->get('/planets', function() use($app) {
        $req = Slim\Slim::getInstance()->request();
        $name = $req->get('name');
        $dbcon = getConnection();
        try {                
            if($name != null) {
                $sql = "SELECT * FROM planet WHERE name LIKE :name ORDER BY name";
                $stmt = $dbcon->prepare($sql);
                $query = "%".$name."%";
                $stmt->bindParam("name", $query);
                $stmt->execute();                
            } else {
                $sql = "SELECT * FROM planet ORDER BY name";
                $stmt = $dbcon->query($sql);
            }
            $planets = $stmt->fetchAll(PDO::FETCH_OBJ);
            $dbcon = null;
            returnAsJSON($planets,$app);          
        } catch(PDOException $e) {
            printError($e->getMessage(),500,$app);
        }
    });

    /**
     * On GET /planets/:query
     * Fetch the data of a single planet by id or name
     */
    $app->get('/planets/:query', function($query) use($app) {
        $sql = "SELECT * FROM planet WHERE id=:query OR name=:query";
        try {
            $dbcon = getConnection();
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam("query", $query);
            $stmt->execute();
            $planet = $stmt->fetchObject();
            $dbcon = null;
            returnAsJSON($planet,$app);
        } catch(PDOException $e) {
            printError($e->getMessage(),500,$app);
        }
    });
    
    /**
     * On POST /planets
     * Create a new Planet
     */
    $app->post('/planets', function() use($app) {
        $request = Slim\Slim::getInstance()->request();
        $planet = json_decode($request->getBody());
        $sql = "INSERT INTO planet (name, region, physical_class, diameter, capital, description) VALUES (:name, :region, :physical_class, :diameter, :capital, :description)";
        try {
            $dbcon = getConnection();
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam("name", $planet->name);
            $stmt->bindParam("region", $planet->region);
            $stmt->bindParam("physical_class", $planet->physical_class);
            $stmt->bindParam("diameter", $planet->diameter);
            $stmt->bindParam("capital", $planet->capital);
            $stmt->bindParam("description", $planet->description);
            $stmt->execute();
            $planet->id = $dbcon->lastInsertId();
            $planet->picture = 'default.jpg';
            $dbcon = null;
            returnAsJSON($planet,$app);
        } catch(PDOException $e) {
            printError($e->getMessage(),500,$app);
        }       
    });
    
    /**
     * On PUT /planets/:id
     * Update the data of an existing planet
     */
    $app->put('/planets/:id', function($id) use($app) {
        $request = Slim\Slim::getInstance()->request();
        $body = $request->getBody();
        $planet = json_decode($body);
        $sql = "UPDATE planet SET name=:name, region=:region, physical_class=:physical_class, diameter=:diameter, capital=:capital, description=:description WHERE id=:id";
        try {
            $dbcon = getConnection();
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam("name", $planet->name);
            $stmt->bindParam("region", $planet->region);
            $stmt->bindParam("physical_class", $planet->physical_class);
            $stmt->bindParam("diameter", $planet->diameter);
            $stmt->bindParam("capital", $planet->capital);
            $stmt->bindParam("description", $planet->description);
            $stmt->bindParam("id", $id);
            $stmt->execute();
            if($stmt->rowCount() == 0) {
                printError("Planet not found",404,$app);                
            } else {                
                returnAsJSON($planet,$app);
            }                        
            $dbcon = null;            
        } catch(PDOException $e) {
            printError($e->getMessage(),500,$app);
        }
    });
    
    /**
     * On DELETE /planets/:id
     * Delete an existing planet
     */
    $app->delete('/planets/:id', function($id) use($app) {
        $sql = "DELETE FROM planet WHERE id=:id";
        try {
            $dbcon = getConnection();
            $stmt = $dbcon->prepare($sql);
            $stmt->bindParam("id", $id);
            $stmt->execute();            
            if($stmt->rowCount() == 0) {
                printError("Planet not found",404,$app);                
            } else {                
                $app->response()->status(200);
            }
            $dbcon = null;
        } catch(PDOException $e) {
            printError($e->getMessage(),500,$app);
        }
    });
    
    // Run the Service
    $app->run();        
    
    // Return a connection to the database using PHP PDO
    function getConnection() {
        $dbhost = "127.0.0.1";
        $dbuser = "root";
        $dbpass = "teatime2010";
        $dbname = "planeeto";
        $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
    
    // Return an object as JSON or return status 404 if response is empty
    function returnAsJSON($planets,$app) {
        if($planets) {
            echo json_encode(array('planets' => $planets));
        } else {
            $app->response()->status(404);
        }
    }
    
    // In case of an internal server error print out an explanation and return 505
    function printError($message,$code,$app) {
        echo '{"error":{"message":'. $message .'}}';
        $app->response()->status($code);
    }
  
?>
<?php
/**
 * taskdboard
 * @version 1.0.0
 */

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;



/**
 * GET getMyTeam
 * Summary: Afiseaza utilizatorii care depind de adminul cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/adminTeam/{idAdmin}', function($request, $response, $args) {
            $return_data = [];
            
            $body = $request->getParsedBody();

            $id_admin = $args['idAdmin'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query = "SELECT * FROM users WHERE idAdmin='$id_admin';";

            $result = mysqli_query($db, $query);

            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                array_push($return_data, $name);
            }

            $response->withJson($return_data);
            return $response;
            });

/**
 * GET getAdminName
 * Summary: Afiseaza pagina principala pentru adminul cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/homeAdmin/{idAdmin}', function($request, $response, $args) {
            
            
            $body = $request->getParsedBody();
            $response->write('How about implementing getTeams as a GET method ?');
            return $response;
            });

/**
 * GET getProjList
 * Summary: Afiseaza situatia proiectului pentru adminul cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/projectList/{idAdmin}', function($request, $response, $args) {
            $return_data = [];
            
            $body = $request->getParsedBody();

            $id_admin = $args['idAdmin'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query = "SELECT * FROM tasks WHERE idUser='$id_admin';";

            $result = mysqli_query($db, $query);

            while ($row = mysqli_fetch_array($result)) {
                $task = [];
                $task_id = $row['idTask'];
                $name = $row['name'];
                $status = $row['status'];

                $task['id'] = $task_id;
                $task['name'] = $name;
                $task['status'] = $status;

                array_push($return_data, $task);
            }

            $response->withJson($return_data);
            return $response;
            });

/**
 * GET getUserName
 * Summary: Afiseaza pagina principala pentru userul cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/homeUser/{idUser}', function($request, $response, $args) {
            
            
            $body = $request->getParsedBody();
            $response->write('How about implementing getTeams as a GET method ?');
            return $response;
            });

/**
 * GET getTasks
 * Summary: Afiseaza taskurile userului cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/myTasks/{idUser}', function($request, $response, $args) {
            $return_data = [];
            
            $body = $request->getParsedBody();

            $id_user = $args['idUser'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query = "SELECT * FROM users WHERE idUser='$id_user';";

            $result = mysqli_query($db, $query);

            $row = mysqli_fetch_array($result);

            $id_admin = $row['idAdmin'];

            $query = "SELECT * FROM tasks WHERE idUser='$id_admin';";

            $result = mysqli_query($db, $query);

            while ($row = mysqli_fetch_array($result)) {
                $task = [];
                $task_id = $row['idTask'];
                $name = $row['name'];
                $status = $row['status'];

                $task['id'] = $task_id;
                $task['name'] = $name;
                $task['status'] = $status;

                array_push($return_data, $task);
            }

            $response->withJson($return_data);
            return $response;
            });


/**
 * GET getTeam
 * Summary: Afiseaza membrii echipei userului cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->GET('/myTeam/{idUser}', function($request, $response, $args) {
            $return_data = [];
            
            $body = $request->getParsedBody();
            
            $id_user = $args['idUser'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query = "SELECT * FROM users WHERE idUser='$id_user';";

            $result = mysqli_query($db, $query);

            $row = mysqli_fetch_array($result);

            $id_admin = $row['idAdmin'];

            $query = "SELECT * FROM users WHERE idAdmin='$id_admin';";

            $result = mysqli_query($db, $query);

            while ($row = mysqli_fetch_array($result)) {
                $user = [];
                $id_user = $row['idUser'];
                $name = $row['name'];

                $user['id'] = $id_user;
                $user['name'] = $name;
                
                array_push($return_data, $user);
            }
            
            $response->withJson($return_data);
            return $response;
            });

/**
 * POST addTask
 * Summary: Adauga un task pentru userul cu ID-ul x
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->POST('/addTask/{idUser}', function($request, $response, $args) {
            
            
            $body = $request->getParsedBody();

            $task_id = $body['task_id'];
            $user_id = $args['idUser'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query_text = "UPDATE tasks SET idUser='$user_id' WHERE idTask='$task_id';";

            mysqli_query($db, $query_text);

            $response->write('Done');
            return $response;
            });

/**
 * PUT startTask
 * Summary: Actualizam starea unui task in started
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->PUT('/startTask/{idTask}', function($request, $response, $args) {
            
            
            $body = $request->getParsedBody();

            $task_id = $args['idTask'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query_text = "UPDATE tasks SET status='Started' WHERE id='$task_id';";

            mysqli_query($db, $query_text);

            $response->write('Done');
            return $response;
            });

/**
 * PUT finishTask
 * Summary: Actualizam starea unui task in finished
 * Notes: 
 * Output-Formats: [application/xml, application/json]
 */
$app->PUT('/finishTask/{idTask}', function($request, $response, $args) {
            
            
            $body = $request->getParsedBody();

            $task_id = $args['idTask'];

            $db = mysqli_connect("localhost", "root", "", "taskdb");

            $query_text = "UPDATE tasks SET status='Finished' WHERE id='$task_id';";

            mysqli_query($db, $query_text);

            $response->write('Done');
            return $response;
            });



$app->run();

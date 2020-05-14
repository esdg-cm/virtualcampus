<?php
require __DIR__.DS.'__AdminController.php';

class StudentController extends __AdminController
{
    /**
     * gestion des "etudiants coté administration"
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $content = $this->view('/admin/student/index')->get();

        exit(json_encode([
            'content' => $content
        ]));
    }

    public function add()
    {


        if ($this->request->is('post')) {


            $data = $this->request->data;
            $data['type_utilisateur'] = 'etudiant';
            $result = $this->api->post('user/create', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        

        $result = $this->api->post('user/readstudent');
        $result = json_decode($result);

        $data['users'] = $result->results;

        $result = $this->api->post('classes/read');
        $result = json_decode($result);

        $data['classes'] = $result->results;

        $content = $this->view('/admin/student/create',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/student'),
            'content' => $content
        ]));
    }

    public function detail()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $content = $this->view('detail')->get();

        exit(json_encode([
            'content' => $content
        ]));
    }

    public function editAdmin($id_utilisateur)
    {

        if ($this->request->is('post')) {


            $data = $this->request->data;
            $data['id_utilisateur'] = $id_utilisateur;
            $data['type_utilisateur'] = 'etudiant';

            $result = $this->api->post('user/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        

        $result = $this->api->post('user/readstudent',[],
            ['id_utilisateur' => $id_utilisateur]
        );
        $result = json_decode($result);

        $data['users'] = $result->results;

        $result = $this->api->post('classes/read');
        $result = json_decode($result);

        $data['classes'] = $result->results;


        $content = $this->view('/admin/student/edit_admin',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/student'),
            'content' => $content
        ]));
    }

    public function editStudent($id_utilisateur)
    {

        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $data['id_utilisateur'] = $id_utilisateur;
            $data['type_utilisateur'] = 'etudiant';

            $result = $this->api->post('user/put', [], $data);

            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }

            exit($result->message);
        }

        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        

        $result = $this->api->post('user/readstudent',[],
            ['id_utilisateur' => $id_utilisateur]
        );
        $result = json_decode($result);

        $data['users'] = $result->results;

        $result = $this->api->post('classes/read');
        $result = json_decode($result);

        $data['classes'] = $result->results;


        $content = $this->view('/admin/student/edit_student',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/student'),
            'content' => $content
        ]));
    }

}

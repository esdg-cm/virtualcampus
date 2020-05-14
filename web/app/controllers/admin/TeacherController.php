<?php
require __DIR__.DS.'__AdminController.php';

class TeacherController extends __AdminController
{
    /**
     * Gestion des planning
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }
        $result = $this->api->post('user/readteacher');
        $result = json_decode($result);

        $data['users'] = $result->results;

        $content = $this->view('/admin/teacher/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/teacher'),
            'content' => $content
        ]));
    }

    public function add()
    {


        if ($this->request->is('post')) {


            $data = $this->request->data;
            $data['type_utilisateur'] = 'professeur';

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

        

        $result = $this->api->post('user/readteacher');
        $result = json_decode($result);

        $data['users'] = $result->results;


        $content = $this->view('/admin/teacher/create',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/teacher'),
            'content' => $content
        ]));
    }

    public function editAdmin($id_utilisateur)
    {


        if ($this->request->is('post')) {


            $data = $this->request->data;
            $data['id_utilisateur'] = $id_utilisateur;
            $data['type_utilisateur']= 'professeur';
            var_dump($data);
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

        

        $result = $this->api->post('user/readteacher',[],
            ['id_utilisateur' => $id_utilisateur]
        );
        $result = json_decode($result);

        $data['users'] = $result->results;


        $content = $this->view('/admin/teacher/edit_admin',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/teacher'),
            'content' => $content
        ]));
    }

    public function editTeacher($id_utilisateur)
    {


        if ($this->request->is('post')) {


            $data = $this->request->data;
            $data['id_utilisateur'] = $id_utilisateur;
            $data['type_utilisateur']= 'professeur';
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

        

        $result = $this->api->post('user/readteacher',[],
            ['id_utilisateur' => $id_utilisateur]
        );
        $result = json_decode($result);

        $data['users'] = $result->results;


        $content = $this->view('/admin/teacher/edit_teacher',$data)->get();


        exit(json_encode([
            'js' => js_url('admin/teacher'),
            'content' => $content
        ]));
    }

    public function detail($id_utilisateur)
    {
        $data['id_utilisateur']=$id_utilisateur;

        $result = $this->api->post('user/read', [], [
            'id_utilisateur' => $id_utilisateur
        ]);
        $result = json_decode($result);
        $data['users'] = $result->results;


        $this->view('/admin/teacher/detail',$data)->render();
    }

}
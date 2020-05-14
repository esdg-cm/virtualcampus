<?php
require __DIR__.DS.'__AdminController.php';

class SemesterController extends __AdminController
{
    /**
     * Gestion des semestres
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('semestres/readAllInfo');
        $result = json_decode($result);
        
        $data['semestres'] = $result->results;


        $content = $this->view('/admin/education/semester/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/semester'),
            'content' => $content
        ]));
    }

    public function add()
    {

        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $result = $this->api->post('semestres/create', [], $data);

            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }


        $result = $this->api->post('semestres/read');
        $result = json_decode($result);

        $data['semestres'] = $result->results;

        $result = $this->api->post('niveaux/read');
        $result = json_decode($result);
        
        $data['niveaux'] = $result->results;


        $this->view('/admin/education/semester/create',$data)->render();
    }


    public function edit($id_semester)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_semestre']=$id_semester;
            $result = $this->api->post('semestres/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('semestres/read', [], [
            'id_semestre' => $id_semester
        ]);
        $result = json_decode($result);
        $data['semestres'] = $result->results;

        $result = $this->api->post('niveaux/read');
        $result = json_decode($result);
        
        $data['niveaux'] = $result->results;

        $this->view('/admin/education/semester/edit',$data)->render();
    }

    public function delete()
    {
        $this->view('/admin/education/semester/delete')->render();
    }

    public function detail($id_semester)
    {
        $data['id_semestre']=$id_semester;

        $result = $this->api->post('semestres/readAllInfo', [], [
            'id_semestre' => $id_semester
        ]);
        $result = json_decode($result);
        $data['semestres'] = $result->results;


        $this->view('/admin/education/semester/detail',$data)->render();
    }

}
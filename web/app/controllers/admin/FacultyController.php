<?php
require __DIR__.DS.'__AdminController.php';

class FacultyController extends __AdminController
{
    /**
     * Gestion des filières
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('filieres/read');
        $result = json_decode($result);

        $data['filieres'] = $result->results;

        $content = $this->view('/admin/establishment/faculty/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/faculty'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $result = $this->api->post('filieres/create', [], $data);
        
            $result = json_decode($result);


            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }


        $result = $this->api->post('filieres');
        $result = json_decode($result);

        $data['filieres'] = $result->results;


        $this->view('/admin/establishment/faculty/create',$data)->render();
    }


    public function edit($id_filiere)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_filiere']=$id_filiere;
            
            $result = $this->api->post('filieres/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('filieres/read', [], [
            'id_filiere' => $id_filiere
        ]);
        $result = json_decode($result);
        $data['filieres'] = $result->results;

        $this->view('/admin/establishment/faculty/edit',$data)->render();
    }

    public function delete($id_filiere)
    {
        $this->view('/admin/establishment/faculty/delete',$data)->render();
    }

}
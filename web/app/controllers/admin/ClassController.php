<?php
require __DIR__.DS.'__AdminController.php';

class ClassController extends __AdminController
{
    /**
     * Gestion des classes
     *
     * @author ESDG
     */
    public function index()
    {

        $result = $this->api->post('classes/readAllInfo');

        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = json_decode($result);

        $data['classes'] = $result->results;

        $content = $this->view('/admin/establishment/class/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/class'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $result = $this->api->post('classes/create', [], $data);
            
            $result = json_decode($result);


            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('classes/read');
        $result = json_decode($result);

        $data['classes'] = $result->results;

        $result = $this->api->post('centres/read');
        $result = json_decode($result);

        $data['centres'] = $result->results;

        $result = $this->api->post('niveaux/read');
        $result = json_decode($result);

        $data['niveaux'] = $result->results;


        $result = $this->api->post('filieres/read');
        $result = json_decode($result);

        $data['filieres'] = $result->results;


        $this->view('/admin/establishment/class/create',$data)->render();
    }


    public function edit($id_class)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_classe']=$id_class;
            $result = $this->api->post('classes/put', [], $data);
            
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('classes/read', [], [
            'id_classe' => $id_class
        ]);
        $result = json_decode($result);
        $data['classes'] = $result->results;

        $result = $this->api->post('centres/read');
        $result = json_decode($result);

        $data['centres'] = $result->results;

        $result = $this->api->post('niveaux/read');
        $result = json_decode($result);

        $data['niveaux'] = $result->results;


        $result = $this->api->post('filieres/read');
        $result = json_decode($result);

        $data['filieres'] = $result->results;

        $this->view('/admin/establishment/class/edit',$data)->render();
    }

    public function delete($id_class)
    {
        $this->view('/admin/establishment/class/delete',$data)->render();
    }

}
<?php
require __DIR__.DS.'__AdminController.php';

class LevelController extends __AdminController
{
    /**
     * Gestion des niveaux
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('niveaux/read');
        $result = json_decode($result);

        $data['niveaux'] = $result->results;

        $content = $this->view('/admin/establishment/level/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/level'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $result = $this->api->post('niveaux/create', [], $data);
            $result = json_decode($result);


            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }


        $result = $this->api->post('niveaux');
        $result = json_decode($result);

        $data['niveaux'] = $result->results;


        $this->view('/admin/establishment/level/create',$data)->render();
    }


    public function edit($id_niveau)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_niveau']=$id_niveau;
            
            $result = $this->api->post('niveaux/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('niveaux/read', [], [
            'id_niveau' => $id_niveau
        ]);
        $result = json_decode($result);
        $data['niveaux'] = $result->results;

        $this->view('/admin/establishment/level/edit',$data)->render();
    }

    public function delete($id_niveau)
    {
        $this->view('/admin/establishment/level/delete',$data)->render();
    }

}
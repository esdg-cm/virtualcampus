<?php
require __DIR__.DS.'__AdminController.php';

class UeController extends __AdminController
{
    /**
     * Gestion des ue
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('ue/readAllInfo');
        
        $result = json_decode($result);
        
        $data['ue'] = $result->results;

        $content = $this->view('/admin/education/ue/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/ue'),
            'content' => $content
        ]));
    }

    public function add()
    {

        if ($this->request->is('post')) {

            $data = $this->request->data;
            
            $result = $this->api->post('ue/create', [], $data);
            
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

        $result = $this->api->post('ue/readAllInfo');
        $result = json_decode($result);

        $data['ue'] = $result->results;
        $result = $this->api->post('filieres/read');
        $result = json_decode($result);

        $data['filieres'] = $result->results;


        $this->view('/admin/education/ue/create',$data)->render();
    }


    public function edit($id_ue)
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_ue']=$id_ue;
            $result = $this->api->post('ue/put', [], $data);
            
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('ue/readAllInfo', [], [
            'id_ue' => $id_ue
        ]);
        $result = json_decode($result);
        $data['ue'] = $result->results;

        $result = $this->api->post('semestres/read');
        $result = json_decode($result);
        $data['semestres'] = $result->results;

        $this->view('/admin/education/ue/edit',$data)->render();
    }

    public function delete()
    {
        $this->view('/admin/education/ue/delete')->render();
    }

    public function detail($id_ue)
    {
        $data['id_ue']=$id_ue;
        $result = $this->api->post('matieres/readAllInfo', [], [
            'id_ue' => $id_ue
        ]);
        $result = json_decode($result);

        $data['ue'] = $result->results;


        $this->view('/admin/education/ue/detail',$data)->render();
    }

}
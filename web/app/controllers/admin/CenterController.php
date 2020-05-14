<?php
require __DIR__.DS.'__AdminController.php';

class CenterController extends __AdminController
{
    /**
     * Gestion des centres
     *
     * @author ESDG
     */
    public function index()
    {
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('centres/read');
        $result = json_decode($result);
        
        $data['centres'] = $result->results;

        $content = $this->view('/admin/establishment/center/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/center'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['tel_responsable']=$data['indicatif'].$data['tel_responsable'];
            
            $result = $this->api->post('centres/create', [], $data);
            
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }


        $result = $this->api->post('centres');
        $result = json_decode($result);

        $data['centres'] = $result->results;


        $this->view('/admin/establishment/center/create',$data)->render();
    }


    public function edit($id_center)
    {

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_centre']=$id_center;
            $result = $this->api->post('centres/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('centres/read', [], [
            'id_centre' => $id_center
        ]);
        $result = json_decode($result);
        $data['centres'] = $result->results;

        $this->view('/admin/establishment/center/edit',$data)->render();
    }

    public function delete()
    {
        $this->view('/admin/establishment/center/delete')->render();
    }

    public function detail()
    {
        $this->view('/admin/establishment/center/detail')->render();
    }

}
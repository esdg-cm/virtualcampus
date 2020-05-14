<?php
require __DIR__.DS.'__AdminController.php';

class HourlyController extends __AdminController
{
    /**
     * Gestion des tranches horaires
     *
     * @author ESDG
     */
    
    public function index(){
        if(! $this->request->is('ajax')) {
            return $this->layout->launch();
        }

        $result = $this->api->post('tranches_horaires/read');
        $result = json_decode($result);

        $data['hourlies'] = $result->results;

        $content = $this->view('/admin/education/hourly/index',$data)->get();

        exit(json_encode([
            'js' => js_url('admin/hourly'),
            'content' => $content
        ]));
    }

    public function add()
    {
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $result = $this->api->post('tranches_horaires/create', [], $data);
        
            $result = json_decode($result);


            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('tranches_horaires/read');
        $result = json_decode($result);
        
        $data['hourlies'] = $result->results;

        $this->view('/admin/education/hourly/create',$data)->render();
    }

    public function edit($id_hourly)
    {

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $data['id_tranche']=$id_hourly;
            $result = $this->api->post('tranches_horaires/put', [], $data);
            $result = json_decode($result);

            if($result->success === true) {
                echo '<ok>';
            }
            else {
                echo '<error>';
            }
            exit($result->message);
        }

        $result = $this->api->post('tranches_horaires/read', [], [
            'id_tranche' => $id_hourly
        ]);
        $result = json_decode($result);
        $data['hourlies'] = $result->results;

        $this->view('/admin/education/hourly/edit',$data)->render();
    }

}